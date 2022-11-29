<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

$u= $_POST['course-c-uid'];
$c= $_POST['course-c-cid'];

$queryUserListCourse = 'INSERT INTO usercourselist (id, courseID) VALUES (:u, :c)';
$statementUser = $db->prepare($queryUserListCourse);
$statementUser->bindValue(':u', $u);
$statementUser->bindValue(':c', $c);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();

header('Location: ../userCoursesPage.php');

?>