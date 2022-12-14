<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = '141.215.80.154';
$DATABASE_USER = 'group5';
$DATABASE_PASS = 'iROUJ@qm6Mz';
$DATABASE_NAME = 'group5_db';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['email'], $_POST['password'])) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password field!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password, tutorPrivileges, adminPrivileges FROM user WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	// If the username exists
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password, $tutorPrivileges, $adminPrivileges);
		$stmt->fetch();
		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		//password_verify($_POST['password'], $password)
		//$_POST['password'] === $password
		if (password_verify($_POST['password'], $password)) {
			// Verification success! User has loggedin!
			// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['id'] = $id;
			$_SESSION['tutorPrivileges'] = $tutorPrivileges;
			$_SESSION['adminPrivileges'] = $adminPrivileges;
			if($_SESSION['adminPrivileges'] == 1)
			{
				header('Location: ../admininfo.php');
			}
			else
			{
				header('Location: ../userprofileinfo.php');
			}
		} else {
			echo 'Incorrect password!';
		}
	} else {
		echo 'Incorrect username!';
	}
	$stmt->close();
} else {
	echo 'Could not prepare statement!';
}
?>