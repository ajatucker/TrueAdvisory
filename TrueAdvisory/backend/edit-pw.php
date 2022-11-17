<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

//$user_id = $_SESSION['id'];
//$email = $_SESSION['email'];
//$major = $_SESSION['major'];

$editpassword = filter_input(INPUT_POST, 'edit-pw');
$editpassword = password_hash($editpassword, PASSWORD_DEFAULT);


$queryUser = 'UPDATE user SET password=:editpassword WHERE id = :sessionid';
$statementUser = $db->prepare($queryUser);
$statementUser->bindValue(':sessionid', $_SESSION['id']);
$statementUser->bindValue(':editpassword', $editpassword);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();
header('Location: ../userprofileinfo.php');

// $userListStmt = $db->prepare('SELECT courseID FROM usercourselist WHERE id = :user_id');
// $userListStmt->bindValue(':user_id', $user_id);
// $userListStmt->execute();
// $course = $statementUser->fetch();
// $userListStmt->closeCursor();
?>