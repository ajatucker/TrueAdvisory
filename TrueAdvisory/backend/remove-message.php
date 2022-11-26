<?php
require_once('database.php');

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}

//$u= $_POST['uid'];
$c= $_POST['cid'];
$a= $_POST['aid'];

$queryUserCourse = 'DELETE FROM messages WHERE messageID = :c';
$statementUser = $db->prepare($queryUserCourse);
//$statementUser->bindValue(':u', $u);
$statementUser->bindValue(':c', $c);
//$statementUser->bindValue(':a', $a);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();


header('Location: ../userDiscussion.php?discussion_id='.$a);

?>