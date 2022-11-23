<?php
require_once('./backend/database.php');
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: signin.html');
	exit;
}

$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
//$major = $_SESSION['major'];

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$queryUser = 'SELECT * FROM user WHERE id = :user_id';
$statementUser = $db->prepare($queryUser);
$statementUser->bindValue(':user_id', $user_id);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();


$userListStmt = $db->prepare('SELECT courseID FROM usercourselist WHERE id = :user_id');
$userListStmt->bindValue(':user_id', $user_id);
$userListStmt->execute();
$currCourse = $userListStmt->fetchAll();
$userListStmt->closeCursor();

$userTutoringStmt = $db->prepare('SELECT courseID FROM usercourselist WHERE (id = :user_id)  AND (doesTutor = 1)');
$userTutoringStmt->bindValue(':user_id', $user_id);
$userTutoringStmt->execute();
$currTutoring = $userTutoringStmt->fetchAll();
$userTutoringStmt->closeCursor();

$sbDiscussStmt = $db->prepare('SELECT * FROM discussions WHERE courseID=(SELECT courseID FROM usercourselist WHERE (id = :user_id))');
$sbDiscussStmt->bindValue(':user_id', $user_id);
$sbDiscussStmt->execute();
$currDiscussions = $sbDiscussStmt->fetchAll();
$sbDiscussStmt->closeCursor();

#$sbTutorStmt = $db->prepare('SELECT * FROM user WHERE id=(SELECT id FROM usercourselist WHERE (id = :user_id))');

$tutorRequestStmt = $db->prepare('SELECT * FROM user WHERE tutorPrivileges=2');
$tutorRequestStmt->execute();
$tRequests = $tutorRequestStmt->fetchAll();
$tutorRequestStmt->closeCursor();

$adminRequestStmt = $db->prepare('SELECT * FROM user WHERE adminPrivileges=2');
$adminRequestStmt->execute();
$aRequests = $adminRequestStmt->fetchAll();
$adminRequestStmt->closeCursor();

$courseRequestStmt = $db->prepare('SELECT * FROM courses WHERE needUpdate=1');
$courseRequestStmt->execute();
$cRequests = $courseRequestStmt->fetchAll();
$courseRequestStmt->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>True Advisory - User Home</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="./styles/styles.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="./backend/functions.js"></script>
</head>

<body>
 
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>True Advisory</h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="#">Your Home</a>
                    <a href="#courseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Course List</a>
                    <ul class="collapse list-unstyled" id="courseSubmenu">
                    <?php foreach ($currCourse as $course) : ?>
                            <a href="#">
                                <?php echo $course['courseID'];?>        
                            </a>
                            <?php endforeach; ?>
                            <a href="#">CIS 350
                                                        
                            </a>
                    </ul>
                </li>
                <li>
                    <a href="#discussionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Discussions</a>
                    <ul class="collapse list-unstyled" id="discussionSubmenu">
                        <li>
                            <?php foreach ($currDiscussions as $discuss) : ?>
                            <a href="#">
                                <?php echo $discuss['courseID'];?>
                            </a>
                            <?php endforeach; ?>
                            <a href="#">Discuss CIS 350
                                                        
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#tutorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Tutors</a>
                    <ul class="collapse list-unstyled" id="tutorSubmenu">
                        <li>
                            <a href="#">Anna Smith - CIS 350</a>
                        </li>
                        <li>
                            <a href="#">MBaku - CIS 427</a>
                        </li>
                        <li>
                            <a href="#">Shigeru Miyamoto - CIS 450</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </nav>

        <!-- Page Content Holder -->
        <div id="content" style ="background-color: white;">

            <nav class="navbar navbar-expand-lg rounded">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span>&ZeroWidthSpace;</span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="menu">
                        <ul>
                        <li><a href="site.php">True Advisory</a></li>
                          <li><a href="site.php">Home</a></li>
                          <li><a href="classes.php">Courses</a></li>
                          <li><a href="discussions.php">Discussions</a></li>
                          <li><a href="tutors.php">Tutoring</a></li>
                          <li><a href="#">About</a></li>
                          <li><a href="#">Other Resources</a></li>
                        </ul>
                        <ul>
                        <li><b><?php if(isset($_SESSION['loggedin'])){ ?>
                              <a class="login_button" href=".\backend\logout.php" >logout</a>
                            <?php }else{ ?>
                              <a class="login_button" href="signin.html">login</a>
                            <?php } ?></b></li>
                        </ul>
                        </div> 
                </div>
            </nav>
            <div class="row">
                
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <p class="card-text">
                                <h5>
                                    Email: <h3><?=$email?></h3>
                                </h5>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                
                             </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <p class="card-text">
                                <h5>
                                    Name:
                                </h5>
                            </p>
                            <form action="./backend/edit-name.php" method="POST" id="edit-name-form">
                                <div class="d-flex justify-content-between align-items-center">
                                <label for="edit-name" class="input-group">
                                <input type="text" class="form-control" name="edit-name" value="<?=$user['name'] ?>">
                                    <div class="input-group-append">
                                        <input type="submit" name="name-submit" id="name-submit" class="btn btn-outline-secondary" value="Edit"/>                                                
                                    </div>
                                </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <p class="card-text">
                                <h5>
                                    Password:
                                </h5>
                            </p>
                            <form action="./backend/edit-pw.php" method="POST" id="edit-password-form">
                                <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="input-group">
                                <input type="password" class="form-control" name="edit-pw" value="******************************">
                                            <div class="input-group-append">
                                                <input type="submit" name="pw-submit" id="pw-submit" class="btn btn-outline-secondary" value="Edit"/>
                                            </div>
                                        </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <p class="card-text">
                                <h5>
                                    Majoring in:
                                </h5>
                            </p>
                            <form action="./backend/edit-major.php" method="POST" id="edit-major-form">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="edit-new-major" class="input-group">
                                            <input type="text" class="form-control" name="edit-new-major" value="<?=$user['major']?>">
                                            <div class="input-group-append">
                                                <input type="submit" name="major-submit" id="major-submit" class="btn btn-outline-secondary" value="Edit"/>
                                            </div>
                                        </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <div class="row">
                                <h3 class="center">Registered Course Listing</h3>
                            </div>
                            <?php foreach ($currCourse as $course) : ?>
                            <div class="card mb-4 box-shadow">
                                <div class="card-body">     
                                        <div class="row">
                                <h5 class="center">
                                        <h5>
                                            <?php echo $course['courseID'];?>
                                        </h5>
                                    <form action="./backend/remove-course.php" method="POST" id="delete-course-form">
                                    <div class="input-group-append">
                                        <input type="hidden" id="uid" name="uid" value="<?=$user['id'] ?>">
                                        <input type="hidden" id="cid" name="cid" value="<?=$course['courseID'] ?>">
                                        <input type="submit" name="remove-course-submit" id="remove-course-submit" class="btn btn-outline-secondary" value="Remove"/>
                                    </div>
                                    </form>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
            
                 
                        <div class="col-lg-6">
                            <div class="card mb-4 box-shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <h3 class="center">Current Tutoring List</h3>
                                    </div>
                                    <?php 
                                        if($_SESSION['tutorPrivileges'] == 0)
                                        {
                                            echo "<h5>You're not a tutor.<h5>";
                                        }
                                    ?>
                                    <?php foreach ($currTutoring as $tutor) : ?>
                                    <div class="card mb-4 box-shadow">
                                        <div class="card-body">     
                                                <div class="row">
                                                    <h5 class="center">
                                                        <h5>
                                                        <div class="col-sm-3">
                                                            <?php echo $tutor['courseID'];?>
                                                        </div>

                                                        <?php echo $tutor['courseName'];?>
                                                        </h5>
                                                        <form action="./backend/stop-tutoring.php" method="POST" id="stop-tutoring-form">
                                                        <div class="input-group-append">
                                                            <input type="hidden" id="tutor-uid" name="tutor-uid" value="<?=$user['id'] ?>">
                                                            <input type="hidden" id="tutor-cid" name="tutor-cid" value="<?=$tutor['courseID'] ?>">
                                                            <input type="submit" name="stop-submit" id="stop-submit" class="btn btn-outline-secondary" value="Remove"/>
                                                        </div>
                                                        </form>
                                                    </h5>
                                                </div>
                                            </div>     
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                <div class="row">
                <div class="col-lg-8 center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <div class="row">
                                <h3 class="center">Newly Requested Course Updates</h3>
                            </div>
                            <?php foreach ($cRequests as $c) : ?>
                            <div class="card mb-4 box-shadow">
                                <div class="card-body">     
                                        <div class="row">
                                    <div class="col-sm-3">
                                        <?php echo $c['courseID'];?>
                                    </div>
                                        <div class="col-sm-3">
                                            <?php echo $c['courseName'];?>
                                        </div>
                                        
                                        <div class="input-group-append">
                                            <button name="admin-accept" id="admin-accept" class="btn btn-outline-secondary" style="background-color:#83ff9e;">
                                                <a href="userCourses.php?course_id=<?php echo $c['courseID']?>">></a>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                </div>
            </div>
        </div>
                                </div>
                        <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                            <div class="row">
                                <h3 class="center">Incoming Admin Requests</h3>
                            </div>
                            <?php foreach ($aRequests as $a) : ?>
                                <div class="card mb-4 box-shadow">
                                    <div class="card-body">     
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <?php echo $a['name'];?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?php echo $a['email'];?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?php echo $a['major'];?>
                                        </div>
                                        <div class="input-group-append">
                                            <button name="admin-accept" id="admin-accept" class="btn btn-outline-secondary" value="Accept" style="background-color:#83ff9e;">
                                                <a href="./backend/admin-approve-request.php?e=<?php echo $a['email']?>">Approve</a>
                                            </button>
                                        </div>
                                        <div class="input-group-append">
                                            <button name="admin-reject" id="admin-reject" class="btn btn-outline-secondary" value="Reject" style="background-color:#ff8282;">
                                                <a href="./backend/admin-deny-request.php?e=<?php echo $a['email']?>">Reject</a>
                                            </button>
                                        </div>

                                    </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                </div>
            </div>
        </div>
            
                    
                        <div class="col-md-6">
                            <div class="card mb-4 box-shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <h3 class="center">Incoming Tutor Requests</h3>
                                    </div>
                                    <?php foreach ($tRequests as $t) : ?>
                                    <div class="card mb-4 box-shadow">
                                        <div class="card-body">     
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <?php echo $t['name'];?>
                                                    </div>
                                                     <div class="col-sm-3">
                                                        <?php echo $t['email'];?>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <?php echo $t['major'];?>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button name="admin-accept" id="admin-accept" class="btn btn-outline-secondary" value="Accept" style="background-color:#83ff9e;">
                                                            <a href="./backend/tutor-approve-request.php?e=<?php echo $a['email']?>">Approve</a>
                                                        </button>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button name="admin-reject" id="admin-reject" class="btn btn-outline-secondary" value="Reject" style="background-color:#ff8282;">
                                                            <a href="./backend/tutor-deny-request.php?e=<?php echo $a['email']?>">Reject</a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>     
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        
        </div>
    </div>
    <div class="footer">
        Powered by the University of Michigan - Dearborn and learning in CIS 435
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>