<?php
require_once('database.php');
$name = filter_input(INPUT_POST, 'name');
$password = filter_input(INPUT_POST, 'pass');
$checkPass = filter_input(INPUT_POST, 're_pass');
$major = filter_input(INPUT_POST, 'major');
$email = filter_input(INPUT_POST, 'email');

if ($username == null || $username == false || $password == null || $email == null || $password != $checkPass ) 
{
    $error_message = "Invalid data. Check all fields and try again.";
    header('Location: ../signup.php');
} else 
{
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Add the user into the database
    $queryCreateUser = "INSERT INTO `user` (`email`, `name`, `password`, `major`)  VALUES (:email, :name, :password, :major)";
    $statement = $db->prepare($queryCreateUser);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':major', $major);
    $statement->execute();
    $statement->closeCursor();

    header('Location: ../signin.html');
}
?>