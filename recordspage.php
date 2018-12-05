<?php
session_start();
$page = $_GET["page"];
$pagesize = 50;

$db = "SAMPLE";
$user = "agung";
$passwd = "abc123";
$conn = db2_connect($db, $user, $passwd);

if ($_SESSION["countrecord"] == "") {
    $sqlcount = "select count(*) as cnt from employee
    inner join empprojact on employee.empno = empprojact.empno
    inner join project on empprojact.projno = project.projno
    inner join act on empprojact.actno = act.actno
    inner join department on employee.workdept=department.deptno";

    $stmt = db2_prepare($conn, $sqlcount);
    $result = db2_execute($stmt);
    $countrecord = 0;
    if ($result) {
        $rowcount = db2_fetch_array($stmt);
        $countrecord = $rowcount[0];
    }
    $_SESSION["countrecord"] = $countrecord;
}

if ((int)$_SESSION["countrecord"] > 0) {
    $pagecount = ceil($_SESSION["countrecord"] / $pagesize);
    if ($page == "") {
        $page = 1;
    } elseif ((int)$page > (int)$pagecount) {
        $page = $pagecount;
    }
    $recnumst = ($page - 1) * $pagesize + 1;
    $recnumen = $recnumst + ($pagesize - 1);

    $sql = "select * from (select firstnme, lastname, deptname, projname, actdesc,row_number() over() as rn from employee
    inner join empprojact on employee.empno = empprojact.empno
    inner join project on empprojact.projno = project.projno
    inner join act on empprojact.actno = act.actno
    inner join department on employee.workdept = department.deptno) as tables where rn between " . $recnumst . " and " . $recnumen;

    $stmt = db2_prepare($conn, $sql);
    $result = db2_execute($stmt);
    if ($result) {
        while ($row = db2_fetch_array($stmt)) {
            echo "$row[0] $row[1] $row[2] $row[3] $row[4]<br>";
        }
    }
}
db2_close($conn);