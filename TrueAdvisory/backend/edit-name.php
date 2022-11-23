<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

$editname = filter_input(INPUT_POST, 'edit-name');


$queryUpdateUser = 'UPDATE user SET name=:editname WHERE id = :sessionid';
$statementNameUser = $db->prepare($queryUpdateUser);
$statementNameUser->bindValue(':sessionid', $_SESSION['id']);
$statementNameUser->bindValue(':editname', $editname);
$statementNameUser->execute();
$user = $statementNameUser->fetch();
$statementNameUser->closeCursor();
if($_SESSION['adminPrivileges'] == 1)
{
	header('Location: ../admininfo.php');
}
else
{
	header('Location: ../userprofileinfo.php');
}

?>