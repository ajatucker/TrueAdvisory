<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>True Advisory - Home</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="./styles/styles.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<body>
   
    <div class="wrapper">
        <div id="content">
             <nav class="navbar navbar-expand-lg rounded">
              <div class="container-fluid">
                <div class="menu">
                  <div class="row">
                    <div class="col-xs-1">
                      <img src="images/UMDLOGO.png" alt="UMD logo" class=" umdlogo">
                      <ul>
                       <li><a href="">True Advisory</a></li>
                          <li><?php if(isset($_SESSION['loggedin']))
                                        {if($_SESSION['adminPrivileges'] == 1)
                                            {echo "<a href='admininfo.php'>Home</a>";}
                                        else if($_SESSION['adminPrivileges'] == 0 || $_SESSION['adminPrivileges'] == 2)
                                        {echo "<a href='userprofileinfo.php'>Home</a>";}
                                        }

                                    else{ echo '<a href="index.html">Home</a>';
                                        }?></li>                          <li><a href="classes.php">Courses</a></li>
                          <li><a href="discussions.php">Discussions</a></li>
                          <li><a href="tutors.php">Tutoring</a></li>
                          <li><a href="aboutUs.php">About</a></li>
                          <li><a href="otherResources.php">Resources</a></li>
                        <li><b style="position:absolute; right:0;top:1;margin-right: 80px; margin-left:40px"><?php if(isset($_SESSION['loggedin'])){ ?>
                          <a class="login_button" href=".\backend\logout.php" >Sign Out</a>
                        <?php }else{ ?>
                          <a class="login_button" href="signin.html">Sign In</a>
                        <?php } ?></b></li>
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
                        <form action="./backend/register.php" class="form" method="POST">
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