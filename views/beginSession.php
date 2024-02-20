<?php
require_once '/Programs/xampp/htdocs/developmentScheduler/Core/db.php';
//Εισαγωγή user_id και role στο SESSION. 




    $userIdRole = $db->showUserIdRole($_POST['username']);





dd($_POST);
session_start();
$_SESSION['user_id'] = $userIdRole['user_id'];
$_SESSION['role'] = $userIdRole['role'];
dd($_SESSION); 

header('location: task-lists.php');
exit();