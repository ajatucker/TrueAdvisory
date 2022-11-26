<?php
require_once('./backend/database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ./signin.html');
	exit;
}

$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
//$major = $_SESSION['major'];

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$queryUser = 'SELECT * FROM user WHERE id = :user_id';
$statementUser = $db->prepare($queryUser);
$statementUser->bindValue(':user_id', $user_id);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();


$discussion_id = filter_input(INPUT_GET, 'discussion_id', FILTER_VALIDATE_INT);
if ($discussion_id == NULL || $discussion_id == FALSE) {
    $discussion_id = 00;
}

$discussion_name = filter_input(INPUT_GET, 'discussionName');

$queryAllCategoriesDiscussions = 'SELECT * FROM discussions';
$statementDiscussions = $db->prepare($queryAllCategoriesDiscussions);
$statementDiscussions->execute();
$discussions = $statementDiscussions->fetch();
$statementDiscussions->closeCursor();

/*$user_list = filter_input(INPUT_GET, 'name');

$queryAllCategoriesUserList = 'SELECT * FROM user';
$statementUserList = $db->prepare($queryAllCategoriesUserList);
$statementUserList->execute();
$userList = $statementUserList->fetch();
$statementUserList->closeCursor();*/

$message_id = filter_input(INPUT_GET, 'messageID', FILTER_VALIDATE_INT);
if ($message_id == NULL || $message_id == FALSE) {
    $message_id = 0;
}

$queryAllCategoriesMessages = 'SELECT * FROM messages';
$statementMessages = $db->prepare($queryAllCategoriesMessages);
$statementMessages->execute();
$message = $statementMessages->fetchAll();
$statementMessages->closeCursor();

$course_id = filter_input(INPUT_GET, 'courseID');
if ($course_id == NULL || $course_id == FALSE) {
    $course_id = '0';
}
    
$courseStmt = $db->prepare('SELECT * FROM courses WHERE courseID=:course_id');
$courseStmt->bindValue(':course_id', $course_id);
$courseStmt->execute();
$thisCourse = $courseStmt->fetchAll();
$courseStmt->closeCursor();

$courseTutorsStmt = $db->prepare('SELECT name, email FROM user WHERE id=(SELECT id FROM usercourselist WHERE (courseID=:course_id) AND (doesTutor=1))');
$courseTutorsStmt->bindValue(':course_id', $course_id);
$courseTutorsStmt->execute();
$theseTutors = $courseTutorsStmt->fetchAll();
$courseTutorsStmt->closeCursor();


$userListStmt = $db->prepare('SELECT courseID FROM usercourselist WHERE id = :user_id');
$userListStmt->bindValue(':user_id', $user_id);
$userListStmt->execute();
$currCourse = $userListStmt->fetchAll();
$userListStmt->closeCursor();

$userTutoringStmt = $db->prepare( 'SELECT * FROM courses WHERE courseID =(SELECT courseID FROM usercourselist WHERE (id = :user_id)  AND (doesTutor = 1))');
$userTutoringStmt->bindValue(':user_id', $user_id);
$userTutoringStmt->execute();
$currTutoring = $userTutoringStmt->fetchAll();
$userTutoringStmt->closeCursor();

$sbDiscussStmt = $db->prepare('SELECT * FROM usercourselist WHERE id = :user_id');
$sbDiscussStmt->bindValue(':user_id', $user_id);
$sbDiscussStmt->execute();
$currDiscussions = $sbDiscussStmt->fetchAll();
$sbDiscussStmt->closeCursor();

?>