<?php

include_once("config.php");
$conn = database_connect();

function executeQueryWithAutoParams($conn, $injectableSql)
{

    // function allows you to put variables inside sql without using place holders,
    // while still being protected from sql injection


    preg_match_all('/\$(\w+)/', $injectableSql, $VariableNames);
    $variableNames = $VariableNames[1];
    $sql = preg_replace('/\$\w+/', "?", $injectableSql);

    if (count($variableNames) == 0) {
        throw new InvalidArgumentException(
            "Error: No variables in SQL. Use single quotes! SQL: $injectableSql"
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

$num = 1;
$sql = 'SELECT * FROM tables WHERE 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num and 1 = $num';

$startTime2 = microtime(true);
print_r(executeQueryWithAutoParams($conn, $sql));
$endTime2 = microtime(true);
$elapsedTime2 = ($endTime2 - $startTime2) * 1000;
echo "Elapsed time for list2: " . number_format($elapsedTime2, 5) . " ms\n";
file_put_contents("autoparam.txt", number_format($elapsedTime2, 5) . ",", FILE_APPEND);












$num = 1;
$sql = "SELECT * FROM tables WHERE 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ? and 1 = ?";


$startTime2 = microtime(true);
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii", $num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num,$num);
$stmt->execute();
print_r($stmt->get_result()->fetch_all(MYSQLI_ASSOC));
$stmt->close();
$conn->close();
$endTime2 = microtime(true);
$elapsedTime2 = ($endTime2 - $startTime2) * 1000;
echo "Elapsed time for list2: " . number_format($elapsedTime2, 5) . " ms\n";
file_put_contents("manually.txt", number_format($elapsedTime2, 5) . ",", FILE_APPEND);










function getAverage(array $numbers) {
    if (empty($numbers)) {
        return 0;
    }
    return round(array_sum($numbers) / count($numbers), 5);
}

$autoparam = explode(",", file_get_contents("autoparam.txt"));
$autoparam = array_map('floatval', $autoparam);

$manually = explode(",", file_get_contents("manually.txt"));
$manually = array_map('floatval', $manually);


echo "<br>";

echo "autoparam: " . getAverage($autoparam) . " ms";
echo "<br>";
echo "manual: " . getAverage($manually) . " ms";