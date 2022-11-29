<?php
require_once('database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../signin.html');
	exit;
}
if($_SESSION['tutorPrivileges'] == 1)
{
    $u= $_POST['tutor-c-uid'];
    $c= $_POST['tutor-c-cid'];
    
    $queryUserCourse = 'UPDATE usercourselist SET doesTutor=1 WHERE id = :u AND courseID = :c';
    $statementUser = $db->prepare($queryUserCourse);
    $statementUser->bindValue(':u', $u);
    $statementUser->bindValue(':c', $c);
    $statementUser->execute();
    $user = $statementUser->fetch();
    $statementUser->closeCursor();
}


if($_SESSION['adminPrivileges'] == 1)
{
	header('Location: ../admininfo.php');
}
else
{
	header('Location: ../userprofileinfo.php');
}

?>