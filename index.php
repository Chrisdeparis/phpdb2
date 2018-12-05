<html>
<head><title>DB Testing</title></head>
<body>

<?php
//db2 express c (v10.5)
$database = "database";
$user = "db";
$password = "password";

$conn = db2_connect($database, $user, $password);

if($conn) {
echo "DB2 Connection succeeded.<br/>";
}
    else{
    exit("failed".db2_conn_errormsg());
    }


$sql = "select 'JUNK', apple, banana, orange, cake, grapes, egg from 
kitchen";

//db2_execute executes a sql statement that was prepared by db2_prepare
if($stmt){
    $result = db2_execute($stmt);
    if(!$result){
        echo "exec errormsg: " .db2_stmt_errormsg($stmt);
        }
    echo '<table>';
while($row = db2_fetch_array($stmt)) {
    echo '<tr>';
    echo '<td>' . $row['apple'] . '</td>';
    echo '<td>' . $row['banana'] . '</td>';
    echo '<td>' . $row['orange'] . '</td>';
    echo '<td>' . $row['cake'] . '</td>';
    echo '<td>' . $row['grapes'] . '</td>';
    echo '<td>' . $row['egg'] . '</td>';
    echo '</tr>';   
}
echo '</table>';
}else {
echo "exec errormsg: ".db2_stmt_errormsg($stmt);
}
db2_close($conn);

?>
<?php
function print_r2($val){
        echo '<table>';
    print_r($val);
    echo '</table>';
    }

    ?> 

</body>
</html>