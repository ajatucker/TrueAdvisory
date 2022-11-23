<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

$e= $_GET['e'];

$queryUser = 'UPDATE user SET tutorPrivileges=1 WHERE email = :e';
$statementUser = $db->prepare($queryUser);
$statementUser->bindValue(':e', $e);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();


if($_SESSION['adminPrivileges'] == 1)
{
	header('Location: ../admininfo.php');
}
else
{
	header('Location: ../userprofileinfo.php');
}

?>