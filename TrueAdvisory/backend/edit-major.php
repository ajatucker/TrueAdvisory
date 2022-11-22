<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

$editmajor = filter_input(INPUT_POST, 'edit-new-major');


$queryUpdateUser = 'UPDATE user SET major = :editmajor WHERE id = :sessionid';
$statementMajorUser = $db->prepare($queryUpdateUser);
$statementMajorUser->bindValue(':sessionid', $_SESSION['id']);
$statementMajorUser->bindValue(':editmajor', $editmajor);
$statementMajorUser->execute();
$user = $statementMajorUser->fetch();
$statementMajorUser->closeCursor();
if($_SESSION['adminPrivileges'] == 1)
{
	header('Location: ../admininfo.php');
}
else
{
	header('Location: ../userprofileinfo.php');
}

?>