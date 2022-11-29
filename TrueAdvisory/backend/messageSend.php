<?php
require_once('database.php');

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: signin.html');
	exit;
}

$user_id = $_SESSION['id'];
$email = $_SESSION['email'];

$queryUser = 'SELECT * FROM user WHERE id = :user_id';
$statementUser = $db->prepare($queryUser);
$statementUser->bindValue(':user_id', $user_id);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();

$id = filter_input(INPUT_POST, 'id');
$message = filter_input(INPUT_POST, 'message');
$discussionID = filter_input(INPUT_POST, 'discussionID');

if ($message == null || $id ==null || preg_match_all('/^\s*$/', $message) == 1) {
    $error_message = "Enter a message";
    http_response_code( 406 ); 
    echo json_encode( [ 'msg' => $errors ] );
} 
else {
    $findID = $id;
    $stmt = $db->prepare('SELECT name FROM user WHERE id=?');
    $stmt->execute([$findID]);
    $_SESSION['name'] = $stmt->fetchColumn();

    // Add the user into the database
    $queryCreateUser = "INSERT INTO `messages` (`id`, `discussionID`, `message`) VALUES(:id, :discussionID, :message)";
    $statement = $db->prepare($queryCreateUser);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':message', $message);
    $statement->bindValue(':discussionID', $discussionID);
    $statement->execute();
    $statement->closeCursor();

    header('Location: ../userDiscussion.php?discussion_id='.$discussionID);


}
?>