<?php
function executeQueryWithAutoParams($conn, $injectableSql)
{

    // function allows you to put variables inside sql without using place holders,
    // while still being protected from sql injection


    preg_match_all('/\$(\w+)/', $injectableSql, $VariableNames);
    $variableNames = $VariableNames[1];
    $sql = preg_replace('/\$\w+/', "?", $injectableSql);

    if (count($variableNames) == 0) {
        throw new InvalidArgumentException(
            "Error: No variables in SQL. Use single quotes. SQL: $injectableSql"
        );
    }

    $variableValues = [];
    foreach ($variableNames as $varname) {
        if (!array_key_exists($varname, $GLOBALS)) {
            throw new InvalidArgumentException(
                "Error: Undefined variable: '$varname' in SQL: $injectableSql"
            );
        }
        $variableValues[] = $GLOBALS[$varname];
    }

    $stmt = $conn->prepare($sql);
    $types = str_repeat("s", count($variableValues));
    $stmt->bind_param($types, ...$variableValues);
    $stmt->execute();

    if (preg_match('/^\s*SELECT/i', $injectableSql)) {
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }
    $affectedRows = $stmt->affected_rows;
    $stmt->close();
    return $affectedRows > 0;
}
