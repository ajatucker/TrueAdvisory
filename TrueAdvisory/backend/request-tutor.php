<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

$tutorPriv = filter_input(INPUT_POST, 'req-tutor');


$queryUser = 'UPDATE user SET tutorPrivileges=2 WHERE id = :sessionid';
$statementUser = $db->prepare($queryUser);
$statementUser->bindValue(':sessionid', $_SESSION['id']);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();
header('Location: ../userprofileinfo.php');

?>