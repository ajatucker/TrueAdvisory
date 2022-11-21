<?php
require_once('database.php');

$id = filter_input(INPUT_POST, 'id');
$message = filter_input(INPUT_POST, 'message');
$discussionID = filter_input(INPUT_POST, 'discussionID');

if ($message == null || $id ==null ) {
    $error_message = "Enter a message";
} else {


    // Add the user into the database
    $queryCreateUser = "INSERT INTO `messages` (`id`, `discussionID`, `message`) VALUES(:id, :discussionID, :message)";
    $statement = $db->prepare($queryCreateUser);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':message', $message);
    $statement->bindValue(':discussionID', $discussionID);
    $statement->execute();
    $statement->closeCursor();
    header('Location: ../userDiscussion.php');
}
?>