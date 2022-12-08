<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}
if($_SESSION['adminPrivileges'] == 1)
{
    $c= $_POST['dc-cid'];
    
    $queryUserCourse = 'DELETE FROM courses WHERE courseID = :c';
    $statementUser = $db->prepare($queryUserCourse);
    $statementUser->bindValue(':c', $c);
    $statementUser->execute();
    $user = $statementUser->fetch();
    $statementUser->closeCursor();
}

header('Location: ../classes.php');

?>