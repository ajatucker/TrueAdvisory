<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>True Advisory - About Us</title>

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
            <h1>ABOUT US</h1>

            <div class="containera">
              
              <div class="aboutBox right">
                  <img src="./images/Alexis.HEIC" alt="Alexis Picture" class="center" style = "border-radius:5%;">
                  <div class="hehe">
                    <h3>Alexis Tucker</h3>
                  
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                      ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                       In quos asperiores odio animi accusantium aliquid. Ex, voluptate.Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                       ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                        In quos asperiores odio animi accusantium aliquid. Ex, voluptate.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                        ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                         In quos asperiores odio animi accusantium aliquid. Ex, voluptate.
                         Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                         ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                          In quos asperiores odio animi accusantium aliquid. Ex, voluptate.
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                          ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                           In quos asperiores odio animi accusantium aliquid. Ex, voluptate.</p>
                    </div>
              </div>

              <div class="line"></div>

              <div class="aboutBox left">
                  <img src="./images/Omar.jpg" alt="Andrew Picture" class="center" style = "border-radius:5%;">
                  <div class="hehe">
                    <h3>Andrew Pearson</h3>
                  
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                      ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                       In quos asperiores odio animi accusantium aliquid. Ex, voluptate.Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                       ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                        In quos asperiores odio animi accusantium aliquid. Ex, voluptate.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                        ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                         In quos asperiores odio animi accusantium aliquid. Ex, voluptate.
                         Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                         ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                          In quos asperiores odio animi accusantium aliquid. Ex, voluptate.
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                          ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                           In quos asperiores odio animi accusantium aliquid. Ex, voluptate.</p>
                    </div>
              </div>

              <div class="line"></div>

              <div class="aboutBox right">
                <img src="./images/Alexis.HEIC" alt="Jacquelyn Picture" class="center" style = "border-radius:5%;">
                <div class="hehe">
                  <h3>Jacquelyn Dutzy</h3>
                
                <p>As a front-end developer for True Advisory,  I worked on making the HTML/CSS for the site.  As our group was creating our idea for
		our site, I took into consideration the design for this type of a project. I organized all the
		pages based on our needs for the project.  I wanted the site to be easy to read and styled to represent the U of M Dearborn
		colors.  Along with creating the HTML/CSS for our site, I also assisted in getting our site working with our database. I hope you
		enjoy our site and see the practical use that students will have for this type of service. &lrm;</p>
                  </div>
            </div>

            <div class="line"></div>

            <div class="aboutBox left">
                <img src="./images/Omar.jpg" alt="Omar Picture" class="center" style = "border-radius:5%;">
                <div class="hehe">
                  <h3>Omar Alabdali</h3>
                
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                    ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                     In quos asperiores odio animi accusantium aliquid. Ex, voluptate.Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                     ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                      In quos asperiores odio animi accusantium aliquid. Ex, voluptate.
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                      ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                       In quos asperiores odio animi accusantium aliquid. Ex, voluptate.
                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                       ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                        In quos asperiores odio animi accusantium aliquid. Ex, voluptate.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum delectus harum quisquam v
                        ero fuga in saepe iste reprehenderit aspernatur? Dolorem, quibusdam?
                         In quos asperiores odio animi accusantium aliquid. Ex, voluptate.</p>
                </div>
            </div>
          </div>
            
          <div class="line"></div>

          <credits class="center">Powered by the University of Michigan - Dearborn and Learning in CIS 435</credits>

            
        
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


