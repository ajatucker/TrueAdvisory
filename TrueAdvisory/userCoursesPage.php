<?php
require('./backend/informationQuery.php');
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
                <li class="active">
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
                        <?php foreach ($currDiscussions as $discuss) : ?>
                            <a href="userDiscussion.php?discussion_id=<?php echo $discuss['discussionID']?>">
                                <?php echo $discuss['courseID'];?>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="userContent" style ="background-color: white;">
            <nav class="navbar navbar-expand-lg rounded">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span>&ZeroWidthSpace;</span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        &ZeroWidthSpace;<i class="fas fa-align-justify"></i>
                    </button>

                    <div class="menu w-100 order-1 order-md-0">
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
                          <li><a href="#">About</a></li>
                          <li><a href="#">Resources</a></li>
                        </ul>
                        <ul>
                        <li><b><?php if(isset($_SESSION['loggedin'])){ ?>
                              <a class="login_button" href=".\backend\logout.php" >Sign Out</a>
                            <?php }else{ ?>
                              <a class="login_button" href="signin.html">Sign In</a>
                            <?php } ?></b></li>
                        </ul>
                        </div> 
                </div>
            </nav>
            <form action="/action_page.php">
                <div class="course">
                    <div class="center">

                        <h3 style="text-align:center;">
                            <?php echo $user_course_id?> <br> <?php echo $thisCourse['courseName']?>
                        </h3>
                    </div>
                        <?php echo $thisCourse['description']?>
                    <br>
                    <div>
                      <p style ="color: black; font-weight: 600; text-align: left; padding-left: 20px; margin-bottom: 3px;">Tutors:</p>
                      <ul>
                        <?php foreach ($theseTutors as $t) : ?>
                          <li >
                              <a href="#"> 
                                <?php 
                                    if(empty($theseTutors))
                                    {
                                        echo "There are no tutors for this course.";
                                    }
                                    else
                                    {

                                        echo $t['name']; echo $t['email'];
                                    }
                                        ?>
                                </a>
                          </li>
                          <?php endforeach; ?>
                      </ul>

                    </div>
        
                    </div>
                    <div class="row">
                        <div class="center btn-padding">
                        
                        <div class="col-sm-3">
                        <button type="button" class="btn btn-default">
                            <a href="userDiscussion.php?discussion_id=<?php echo $user_course_id;?>" value="View <? $user_course_id ?> Discussion"></a>
                        </button>
                        <form action="./backend/add-courselist.php" method="POST" id="add-to-courselist-form">
                            <div class="input-group-append">
                                <input type="hidden" id="course-c-uid" name="course-c-uid" value="<?$_SESSION['id'] ?>">
                                <input type="hidden" id="course-c-cid" name="course-c-cid" value="<?$user_course_id ?>">
                                <input type="submit" name="submit" id="submit" class="btn btn-default" value="Add to Course List"/>
                            </div>
                        </form>
                        <form action="./backend/request-course-update.php" method="POST" id="request-update-form">
                            <div class="input-group-append">
                                <input type="hidden" id="course-c-cid" name="course-c-cid" value="<? $user_course_id ?>">
                                <input type="submit" name="submit" id="submit" class="btn btn-default" value="Update Course"/>
                            </div>
                        </form>
                      <?php 
                        if($_SESSION['tutorPrivileges'] == 1)
                        {
                        ?>
                       
                            <form action="./backend/add-tutor.php" method="POST" id="add-tutoring-form">
                            <div class="input-group">
                                <input type="hidden" id="tutor-uid" name="tutor-c-uid" value="<?=$_SESSION['id'] ?>">
                                <input type="hidden" id="tutor-cid" name="tutor-c-cid" value="<?=$user_course_id ?>">
                                <input type="submit" name="submit" id="submit" class="btn btn-default" value="Add to Tutor List"/>
                            </div>
                            </form>
                        
                    <?php 
                        }
                        if($_SESSION['adminPrivileges'] == 1)
                        {
                    ?>      
                            
                                <button type="button" class="btn btn-default">
                                    <a href="updateCoursePage.php?update_cid=<?=$user_course_id?>">
                                    Update <? $user_course_id ?> Course
                                    </a>
                                 </button>
     

                            <form action="./backend/delete-course.php" method="POST" id="delete-course-form">
                                <div class="input-group-append">
                                    <input type="hidden" id="dc-cid" name="dc-cid" value="<?=$user_course_id ?>">
                                    <input type="submit" name="submit" id="submit" class="btn btn-default" value="Delete Course"/>
                                </div>
                            </form>
                        
                        <?php
                        }
                        ?>
                    </div>
                </div>
            

                
        </div>
        <userCredits class = "center">Powered by the University of Michigan - Dearborn and Learning in CIS 435</credits>

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