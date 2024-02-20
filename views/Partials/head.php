<?php
require_once '/Programs/xampp/htdocs/developmentScheduler/functions.php';
session_start();
dd($_SESSION); 
dd(parse_url($_SERVER['REQUEST_URI'])['path']);
//'Ελεγχος συνδεδεμένου χρήστη. Αν δεν υπάρχει ο χρήστης μεταφέρεται στην σελίδα login.php.
// Από εκεί μπορεί να κάνει είσοδο ή να μεταφερθεί στην σελίδα sign-up-form.php για να εγγραφή
if(empty($_SESSION)){
    if(parse_url($_SERVER['REQUEST_URI'])['path']==='/developmentScheduler/views/task-lists.php'){
        header('location: login.php');
        exit();
    }else if(parse_url($_SERVER['REQUEST_URI'])['path']==='/developmentScheduler/views/teams.php'){
        header('location: login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Development Scheduler</title>
    <!--The width property will control the size of the viewport. initial-scale=1.0 means the initial zoom scale is 100% 
    user-scalable=yes means we allow the user to zoom-in zoom-out.-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=yes">
    <meta name="This platform has developed to coordinate tasks of a team of developers.">
    <meta http-equiv="Nikos Papageorgiou" content="NP development team">
    <title>Development Scheduler</title>
    <link rel="icon" href="../assets/gear.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="./Partials/style.css" rel="stylesheet">
</head>