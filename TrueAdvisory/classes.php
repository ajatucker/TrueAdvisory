<?php
require('./backend/database.php');
session_start();

$course_id = filter_input(INPUT_GET, 'courseID', FILTER_VALIDATE_INT);
if ($course_id == NULL || $course_id == FALSE) {
    $course_id = 1;
}

if (!isset ($_GET['page']) ) {  

  $page_number = 1;  

} else {  

  $page_number = $_GET['page'];  

}

$limit = 4;  
// get the initial page number
$initial_page = ($page_number-1) * $limit; 

$getAllCourses = 'SELECT * FROM courses';  
$statementCourseList = $db->prepare($getAllCourses);
$statementCourseList->execute();
$courses = $statementCourseList->fetchAll();
$statementCourseList->closeCursor();
// get the result
 $total_course_rows = $statementCourseList->rowCount(); 
// get the required number of pages
$total_course_pages = ceil($total_course_rows / $limit);  

$getQueryCourse = "SELECT * FROM courses LIMIT " . $initial_page . ',' . $limit;  
$resultCourse = $db->prepare($getQueryCourse);    
$resultCourse->execute(); 
$currCourse = $resultCourse->fetchAll();
$resultCourse->closeCursor();

// Get ID


    //display the retrieved result on the webpage  

    // while ($row = mysqli_fetch_array($result)) {  

    //     echo $row['ID'] . ' ' . $row['Country'] . '</br>';  

    // }  
 
// Get all discussions
#$queryAllCategories = 'SELECT * FROM discussions';
// $statement2 = $db->prepare($queryAllCategories);
// $statement2->execute();
// $discussions = $statement2->fetchAll();
// $statement2->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>True Advisory - Courses</title>

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
                      <img src="Images/UMDLOGO.png" alt="UMD logo" class=" umdlogo">
                      <ul>
                      <li><a href="site.php">True Advisory</a></li>
                      <?php if(isset($_SESSION['loggedin'])){ ?>
                            <li><a href="userprofileinfo.php">Home</a></li>
                        <?php }else{ ?>
                          <li><a href="site.php">Home</a></li>
                        <?php } ?></b></li>
                          <li><a href="classes.php">Courses</a></li>
                          <li><a href="discussions.php">Discussions</a></li>
                          <li><a href="tutors.php">Tutoring</a></li>
                          <li><a href="aboutUs.html">About</a></li>
                          <li><a href="otherResources.html">Resources</a></li>
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
            
            <h1>TRUE ADVISORY COURSES</h1>
            <div class="containera">   
              <div class="contentBox right">
                <img src="Images/classespic.png" alt="" style="width:288px;height:355px;margin-top:20px; margin-left: 100px">
                <div class="hehe">
                  <h3>Have you been frustrated trying to find information on a class you're considering registering for? &lrm;</h3>
                  <br>
                  <br>
                  <br>
                  <p>Look no further - True Advisory Course views can help you access basic course information and overviews to make better enrollment decisions. Each course page, other than featuring a course overview, will display a list of tutors and a link to the class discussion. This information should be relatively up-to-date.  
                    Students can request information updates often that way information is as up-to-date as possible. To become an arbiter of information for the site, you must request admin access to help keep the site updated for future students.  
                    Have any issues with the information provided in the course overview? Request to change it, and the admins will be notified. They will review the information and add any additional information at their discretion.</p>
                  <p> Please note that admins have the discretion to delete accounts to punish bad behavior and bad actors. While this is a self-moderating community, any activity going against proper conduct as is defined by the University may result in the deletion of your account.</p>
                  </div>
              </div>
            </div>
              <p style= "font-weight: 800;">Want to view available courses at the University of Michigan - Dearborn? View the course listing below or get started now!</p>
            <div class="btns">
              <button><a href="signup.php">Get Started</a></button>
            </div>
            <credits class="center">Powered by the University of Michigan - Dearborn and Learning in CIS 435</credits>
        </div>
    </div>
            <div class="album ">
            <div class="container" style = "margin-top: 20px; margin-bottom: 40px; padding: 60px;">
              <div class="row">
                <?php foreach ($currCourse as $course) : ?>
                <div class="col-md-3">
                  <div class="card mb-4 box-shadow">
                    <img src="Images/schoolpics_03.png" alt="Card image cap" style="width:240px;height:240px;">
                    <div class="card-body">
                      <p class="card-text"><?php echo $course['courseName'];?></p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-outline-secondary">
                              <a href="userCoursesPage.php?course_id=<?php echo $course['courseID'];?>" >View</a>
                            </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <?php endforeach; ?>
                  
              </div>
              <?php for($page_number = 1; $page_number<= $total_course_pages; $page_number++) {  
                echo '<a href = "classes.php?page=' . $page_number . '">' . $page_number . ' </a>';  }    
                ?>
                <br>
                <?php 
                        if(isset($_SESSION['adminPrivileges']) && $_SESSION['adminPrivileges'] == 1)
                        {
                            echo '<button type="button" class="btn btn-sm btn-outline-secondary">
                            <a href="newCoursePage.php">Add course</a>
                            </button>';
                        }
                    
                        ?>
                
              </div>
            </div>
          </div>
  </body>
</html>