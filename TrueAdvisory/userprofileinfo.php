<?php
require_once('./backend/informationQuery.php');
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
                    <a href="userprofileinfo.php">Your Home</a>
                    <a href="#courseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Course List</a>
                    <ul class="collapse list-unstyled" id="courseSubmenu">
                    <?php foreach ($currCourse as $course) : ?>
                            <a href="classes.php">
                                <?php echo $course['courseID'];?>        
                            </a>
                            <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <a href="#discussionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Discussions</a>
                    <ul class="collapse list-unstyled" id="discussionSubmenu">
                        <li>
                            <?php foreach ($currDiscussions as $discuss) : ?>
                            <a href="userDiscussion.php?discussion_id=courseID">
                                <?php echo $discuss['courseID'];?>
                            </a>
                            <?php endforeach; ?>
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
                                    Email: <?=$email?>
                                </h5>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                
                             </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-sm-6">
                            <form action="./backend/request-admin.php" method="POST" id="req-admin-form">
                                    <input type="submit" name="req-admin" id="req-admin" class="btn btn-default" value="Admin Request"/>
                            </form>
                            </div>
                            <div class="col-sm-6">
                            <form action="./backend/request-tutor.php" method="POST" id="req-tutor-form">
                                    <input type="submit" name="req-tutor" id="req-tutor" class="btn btn-default" value="Tutor Request"/>
                            </form>
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
                                        <h3 class="center">You're Tutoring</h3>
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