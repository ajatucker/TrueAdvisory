<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

$c= $_POST['course-c-cid'];
    
$queryCourse = 'UPDATE course SET needUpdate=1 WHERE courseID = :c';
$statementCourse = $db->prepare($queryCourse);
$statementCourse->bindValue(':c', $c);
$statementCourse->execute();
$course = $statementCourse->fetch();
$statementCourse->closeCursor();

header('Location: ../userCoursesPage.php');

?>