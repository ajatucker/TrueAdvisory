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

$getAllDiscussions = 'SELECT * FROM discussions';  
$statementDiscussionList = $db->prepare($getAllDiscussions);
$statementDiscussionList->execute();
$discussions = $statementDiscussionList->fetchAll();
$statementDiscussionList->closeCursor();
// get the result
 $total_rows = $statementDiscussionList->rowCount(); 
// get the required number of pages
$total_pages = ceil($total_rows / $limit);  

$getQueryDiscussions = "SELECT * FROM discussions LIMIT " . $initial_page . ',' . $limit;  
$resultDiscussions = $db->prepare($getQueryDiscussions);    
$resultDiscussions->execute(); 
$currDiscussions = $resultDiscussions->fetchAll();
$resultDiscussions->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>True Advisory - Discussions</title>

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
                      <li><a href="#">True Advisory</a></li>
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
            <h1>TRUE ADVISORY DISCUSSIONS</h1>
            <div class="containera">
                <div class="contentBox left">
                  <img src="images/discussionspic.png" alt="Discussions icon" style="width:464px;height:338px; margin: 10px; margin-right: 100px;">
                  <div class="hehe">
                    <h3>Have you been trying to get assistance for a class, but there were no tutors available?</h3>
                    <br>
                    <br>
                    <br>
                    <p>True Advisory Discussions are a great way to stay connected with your classmates, tutors, and TAs outside of the classroom. This provides more opportunities to ask questions outside of class and have more direct interaction with tutors and TAs for your courses. 
                    You can search for classes you are currently enrolled in and join conversations with your classmates.
                    Missing deadlines or never getting answers to your questions should be a thing of the past. </p>
                  </div>
                </div>
              </div>
              <p style= "font-weight: 800;">Want to join in on the discussion? View the active class discussions below or get started now!</p>
              <div class="btns">
                <button><a href="signup.php">Get Started</a></button>
              </div>
              <credits class="center">Powered by the University of Michigan - Dearborn and Learning in CIS 435</credits>
            </div>
          </div>
          <div class="album ">
            <div class="container" style = "margin-top: 20px; margin-bottom: 40px; padding: 60px;">
              <div class="row">
                <?php foreach ($currDiscussions as $discussion) : ?>
                  
                    <div class="col-md-3" style = "margin-top: 20px">
                      <div class="card mb-4 box-shadow">
                        <?php if (str_contains ($discussion['courseID'], "CIS")) 
                        { ?>
                        <img src="images/CIS.png"  class = "center" alt="CIS icon" style="width:240px;height:240px;">
                        <?php
                        }
                        ?>
                         <?php if (str_contains ($discussion['courseID'], "MATH")) 
                        { ?>
                        <img src="images/MATH.png" class = "center" alt="Math icon" style="width:240px;height:240px;">
                        <?php
                        }
                        ?>
                         <?php if (str_contains ($discussion['courseID'], "ACC")) 
                        { ?>
                        <img src="images/ACC.png" class = "center" alt="Accounting icon" style="width:240px;height:240px;">
                        <?php
                        }
                        ?>
                         <?php if (str_contains ($discussion['courseID'], "ENGR")) 
                        { ?>
                        <img src="images/ENG.png" class = "center" alt="Eng icon" style="width:240px;height:240px;">
                        <?php
                        }
                        ?>
                         <?php if (str_contains ($discussion['courseID'], "CHEM")) 
                        { ?>
                        <img src="images/CHEM.png" class = "center" alt="Chem icon" style="width:240px;height:240px;">
                        <?php
                        }
                        ?>
                         <?php if (str_contains ($discussion['courseID'], "COMP")) 
                        { ?>
                        <img src="images/COMP.png" class = "center" alt="Writing icon" style="width:240px;height:240px;">
                        <?php
                        }
                        ?>
                   


                        <div class="card-body">
                          <p class="card-text center" style = " text-align: center" ><?php echo $discussion['discussionName'];?></p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group center" style = "margin-top: 10px">
                              <button type="button" class="btn btn-sm btn-outline-secondary center">
                                  <a href="userDiscussion.php?discussion_id=<?php echo $discussion['discussionID'];?>" >View</a>
                                </button>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
              </div>
 
              <?php for($page_number = 1; $page_number<= $total_pages; $page_number++) {  
                  echo '<a style = "text-decoration:none; color: inherit" href = "discussions.php?page=' . $page_number . '">' . $page_number . ' </a>';  }    
              ?>
            </div>
          </div> 
  </body>
</html>
