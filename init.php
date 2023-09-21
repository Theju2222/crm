<?php
session_start();
include 'config.php';
define('HOST', $host);
define('USER', $username);
define('PASSWORD', $password);
define('DATABASE', $database);
require 'class/Database.php';
require 'class/Users.php';
require 'class/Time.php';
require 'class/Tickets.php';
require 'class/Department.php';
require 'class/Department1.php';
require 'class/Department2.php';
require 'class/Type.php';
require 'class/Subtype.php';
require 'class/Time1.php';


$database = new Database;
$users = new Users;
$time = new Time;
$time1 = new Time1;

$department = new Department;
$department1 = new Department1;
$department2 = new Department2;
$type = new Type;
$subtype = new Subtype;



$tickets = new Tickets;
?>
