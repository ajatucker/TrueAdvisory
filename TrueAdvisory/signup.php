<?php
require_once('database.php');
$name = filter_input(INPUT_POST, 'name');
$password = filter_input(INPUT_POST, 'pass');
$major = filter_input(INPUT_POST, 'major');
$email = filter_input(INPUT_POST, 'email');

if ($username == null || $username == false || $password == null
                         || $email == null || $major == null
                         || $password == false ) {
    $error_message = "Invalid data. Check all fields and try again.";
} else {

    // Add the user into the database
    $query = "INSERT INTO `user` (`email`, `name`, `password`, `major`) VALUES (:email, :name, :pass, :major)";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':pass', $password);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':major', $major);
    $statement->execute();
    $statement->closeCursor();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="signupandsignin/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
   
    <div class="wrapper">
        <div id="content">
            <nav class="navbar navbar-expand-lg rounded">
            <div class="container-fluid">
              <div class="menu">
                <div class="row">
                  <div class="col-xs-1">
                    <img src="Images/UMDLOGO.png" alt="UMD logo" class=" umdlogo">
                    <ul>
                      <li><a href="#">True Advisory</a></li>
                        <li><a href="site.html">Home</a></li>
                        <li><a href="classes.html">Courses</a></li>
                        <li><a href="discussions.html">Discussions</a></li>
                        <li><a href="tutors.html">Tutoring</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Other Resources</a></li>
                      <li><b><a href="signin.html" class="login_button">Login</a></b></li>
                    </ul>
                </div>
                </div>
              </div>
            </div>
          </nav>
        
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign Up</h2>
                        <form action="./backend/register-form.php" class="form" method="POST">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="major"><i class="zmdi zmdi-email"></i></label>
                                <input type="major" name="major" id="major" placeholder="Your Major"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re_pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group form-button">
                                    <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sign up image"></figure>
                        <a href="signin.html" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
</body>
</html>