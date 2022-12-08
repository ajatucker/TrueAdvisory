<?php
require_once('database.php');
require_once('informationQuery.php');

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

$u= filter_input(INPUT_POST,'a-course-c-uid');
$c= filter_input(INPUT_POST,'a-course-c-cid');
$d= filter_input(INPUT_POST,'a-course-c-did');

$queryUserListCourse = "INSERT INTO `usercourselist` (`doesTutor`, `courseID`, `id`, `discussionID`)  VALUES (0, :c, :u, :d)";
$statementUserList = $db->prepare($queryUserListCourse);
$statementUserList->bindValue(':u', $u);
$statementUserList->bindValue(':c', $c);
$statementUserList->bindValue(':d', $d);
//header('Location: ../classes.php');
$statementUserList->execute();
$user = $statementUserList->fetch();
$statementUserList->closeCursor();

header('Location: ../classes.php');

?>