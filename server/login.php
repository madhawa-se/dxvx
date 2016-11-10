<?php

require_once "user.php";

$email = $_POST["email"];
$password = $_POST["password"];
$phone = $_POST["phone"];

$user = new User();
$user->register($email, $password, $phone);
