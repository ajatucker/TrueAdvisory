<?php
require('./backend/database.php');
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
            
        <h1>TRUE ADVISORY TUTORS</h1>
        <img src="Images/schoolpics_163.png" alt="Graduation cap" class=" mb-4 classordisimg center" style="width:166px;height:200px; border-radius:10%;">
        <p>
          <p>Are you a tutor, or someone who likes to help others?
        </p>
        <div class="line"></div>
        <p>True Advisory allows students to connect with tutors directly and/or help other students within class discussions. Tutors are encouraged to join to help provide students more official help than can be received by other students. However, the student body is more than welcome to join in on the assistance. Everyone is here for the same goal - to succeed in their classes, and the more, the merrier!
        </p>
        <p>Please note that admins have the discretion to delete accounts to punish bad behavior and bad actors. While this is a self-moderating community, any activity going against proper conduct as is defined by the University may result in the deletion of your account.
        </p>
          <p>Want to become a tutor now? Get started, and apply for tutor privileges!</p>
        <div class="line"></div>
        <div class="center">
          <h2>Available Tutors</h2>
          <ul>
            <li><a href="#">Frida Kahlo - ART 201 - fridakahlo@email</a></li>
            <li><a href="#">Muhammad Ali - MATH 201 - muhammadali@email</a></li>
            <li><a href="#">Bruno Mars - MATH 250 - brunomars@email</a></li>
            <li><a href="#">Anna Williams - CIS 200 - annawilliams@email</a></li>
          </ul>
        </div>
        <div class="btns">
              <button>Get Started</button>
            </div>
          </div>
        </div>
          <div class="album py-5 bg-light">
            <div class="container">
              <div class="row">
                <?php foreach ($currTutors as $tutor) : ?>
                <div class="col-md-3">
                  <div class="card mb-4 box-shadow">
                    <div class="card-body">
                      <img src="Images/schoolpics_161.png" alt="Card image tutors" style="width:166px;height:200px;">
                      <p class="card-text">
                        <?php echo $tutor['name'];?>
                        <?php echo $tutor['email'];?>
                      </p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-outline-secondary">
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
                  echo '<a href = "tutors.php?page=' . $page_number . '">' . $page_number . ' </a>';  }    
              ?>
            </div>
          </div>
   
                <!-- Page Content Holder -->
              <div id="content">
                  <footer>Powered by the University of Michigan - Dearborn and learning in CIS 435</footer>
              </div>
            
  </body>
</html>