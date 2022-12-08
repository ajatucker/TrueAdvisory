<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

$u= $_POST['a-course-c-uid'];
$c= $_POST['a-course-c-cid'];

$queryUserListCourse = 'INSERT INTO usercourselist (id, courseID, doesTutor) VALUES (:u, :c, 0)';
$statementUser = $db->prepare($queryUserListCourse);
$statementUser->bindValue(':u', $u);
$statementUser->bindValue(':c', $c);
$statementUser->execute();
//$user = $statementUser->fetch();
$statementUser->closeCursor();

header('Location: ../classes.php');

?>