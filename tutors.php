<?php
require('./backend/database.php');
session_start();
// Get ID
$discussion_id = filter_input(INPUT_GET, 'discussionID', FILTER_VALIDATE_INT);
if ($discussion_id == NULL || $discussion_id == FALSE) {
    $discussion_id = 1;
}

if (!isset ($_GET['page']) ) {  

  $page_number = 1;  

} else {  

  $page_number = $_GET['page'];  

}

$limit = 4;  
// get the initial page number
$initial_page = ($page_number-1) * $limit; 

$getAllTutors = 'SELECT * FROM user WHERE tutorPrivileges=1';  
$statementTutorList = $db->prepare($getAllTutors);
$statementTutorList->execute();
$tutors = $statementTutorList->fetchAll();
$statementTutorList->closeCursor();
// get the result
 $total_rows = $statementTutorList->rowCount(); 
// get the required number of pages
$total_pages = ceil($total_rows / $limit);  

$getQueryTutors = "SELECT * FROM user WHERE tutorPrivileges=1 LIMIT " . $initial_page . ',' . $limit;  
$resultTutors = $db->prepare($getQueryTutors);    
$resultTutors->execute(); 
$currTutors = $resultTutors->fetchAll();
$resultTutors->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>True Advisory - Tutoring</title>

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
        <!-- Page Content Holder -->
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
          <h1>TRUE ADVISORY TUTORS</h1>
          <div class="containera">   
            <div class="contentBox right">
              <img src="images/cappic.png" alt="Graduation cap" class="classordisimg center" style="width:409px;height:301px;">
              <div class="hehe">
                <h3>Are you a tutor, or someone who likes to help others? &lrm;</h3>
                <br>
                <br>
                <br>
                <p>True Advisory allows students to connect with tutors directly and/or help other students within class discussions. Tutors are encouraged to join to help provide students more official help than can be received by other students. However, the student body is more than welcome to join in on the assistance. Everyone is here for the same goal - to succeed in their classes, and the more, the merrier!</p>
                <br>
                <br>
                <p>Please note that admins have the discretion to delete accounts to punish bad behavior and bad actors. While this is a self-moderating community, any activity going against proper conduct as is defined by the University may result in the deletion of your account.
                </p>
              </div>
            </div>
          </div>
          <p style= "font-weight: 800;">Want to become a tutor now? Get started, and apply for tutor privileges!</p>
          <div class="btns">
            <button><a href="signup.html">Get Started</a></button>
          </div>
          <credits class="center">Powered by the University of Michigan - Dearborn and Learning in CIS 435</credits>
          </div>
        </div>
          <div class="album">
            <div class="container" style = "margin-top: 20px; margin-bottom: 40px; padding: 60px;">
              <div class="row">
                <?php foreach ($currTutors as $tutor) : ?>
                <div class="col-md-3">
                  <div class="card mb-4 box-shadow">
                    <div class="card-body">
                      <img src="images/tutorpic.png" class = "center" alt="Card image tutors" style="margin-bottom: 10px">
                      <p class="card-text">
                        <?php echo $tutor['name'];?>
                        <?php echo $tutor['email'];?>
                      </p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
              </div>
 
              <?php for($page_number = 1; $page_number<= $total_pages; $page_number++) {  
                  echo '<a href = "tutors.php?page=' . $page_number . '">' . $page_number . ' </a>';  }    
              ?>
            </div>
          </div>
  </body>
</html>
