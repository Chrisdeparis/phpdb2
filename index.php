<?php 

session_start();
echo '<h1>hello world</h1>';
$_SESSION['test'] = 42;
$test = 43;
echo $_SESSION['test'];
