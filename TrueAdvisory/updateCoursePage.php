<?php
require_once('./backend/database.php');

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ./signin.html');
	exit;
}
if ($_SESSION['adminPrivileges'] != 1) {
	header('Location: ./site.php');
	exit;
}

$ucid = filter_input(INPUT_GET, 'update_cid');

$courseStmt = $db->prepare('SELECT * FROM courses WHERE courseID=:ucid');
$courseStmt->bindValue(':ucid', $ucid);
$courseStmt->execute();
$uCourse = $courseStmt->fetch();
$courseStmt->closeCursor();

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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea#tiny',
        max_height: 215,
        max_width: 1200
            ,plugins: [
            'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
            'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
            'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist checklist outdent indent | removeformat | code table help'
      })
    </script>
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
                        <li>
                            <a href="#">CIS 350</a>
                        </li>
                        <li>
                            <a href="#">CIS 427</a>
                        </li>
                        <li>
                            <a href="#">CIS 450</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#discussionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Discussions</a>
                    <ul class="collapse list-unstyled" id="discussionSubmenu">
                        <li>
                            <a href="#">Discuss CIS 350</a>
                        </li>
                        <li>
                            <a href="#">Discuss CIS 427</a>
                        </li>
                        <li>
                            <a href="#">Discuss CIS 450</a>
                        </li>
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
            <h5 class="course">
                Course Identifier: <?=$ucid ?>
            </h5>
            <form action="./backend/update-course.php" method="POST" id="update-course-form">
                <div class="course">
                    <div style= "width: 50%;">
                        <h3 style="text-align:center;">
                            <input type="hidden" class="form-control" name="cid" value="<?= $ucid ?>">
                            <input type="text" class="form-control" name="n_dept" value="<?=$uCourse['department'] ?>">
                            <input type="text" class="form-control" name="n_c_name" value="<?=$uCourse['courseName'] ?>">
                        </h3>
                    </div>
                    <input type="textarea" class="form-control" style = "height: 100px;" name="n_desc" value="<?=$uCourse['description'] ?>">
                    <br>                   
                </div>
                <div class="center btn-padding">
                    <input type="submit" name="submit" id="submit" class="btn btn-default" value="Update Course"/>
                </div>
                
            </form>
            <userCredits class = "center">Powered by the University of Michigan - Dearborn and Learning in CIS 435</credits>

          
        </div>
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