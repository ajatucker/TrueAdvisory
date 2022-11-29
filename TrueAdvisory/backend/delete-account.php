<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}
$uid= $_POST['my-uid'];
    
$queryUserCourse = 'DELETE FROM user WHERE id = :uid';
$statementUser = $db->prepare($queryUserCourse);
$statementUser->bindValue(':uid', $uid);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();

header('Location: ../signup.php');

?>