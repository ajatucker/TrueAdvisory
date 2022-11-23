<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

$editpassword = filter_input(INPUT_POST, 'edit-pw');
$editpassword = password_hash($editpassword, PASSWORD_DEFAULT);


$queryUpdateUser = 'UPDATE user SET password=:editpassword WHERE id = :sessionid';
$statementPWUser = $db->prepare($queryUpdateUser);
$statementPWUser->bindValue(':sessionid', $_SESSION['id']);
$statementPWUser->bindValue(':editpassword', $editpassword);
$statementPWUser->execute();
$user = $statementPWUser->fetch();
$statementPWUser->closeCursor();
if($_SESSION['adminPrivileges'] == 1)
{
	header('Location: ../admininfo.php');
}
else
{
	header('Location: ../userprofileinfo.php');
}


?>