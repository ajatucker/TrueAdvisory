<?php
require('./backend/database.php');
// Get ID
$discussion_id = filter_input(INPUT_GET, 'discussionID', FILTER_VALIDATE_INT);
if ($discussion_id == NULL || $discussion_id == FALSE) {
    $discussion_id = 1;
}
 
// Get all users
$queryAllCategories = 'SELECT * FROM discussions';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$discussions = $statement2->fetchAll();
$statement2->closeCursor();
 
// // Get products for selected category
// $queryProducts = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
// $statement3 = $db->prepare($queryProducts);
// $statement3->bindValue(':category_id', $category_id);
// $statement3->execute();
// $products = $statement3->fetchAll();
// $statement3->closeCursor();
// 
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

            <h1>TRUE ADVISORY DISCUSSIONS</h1>
            <img src="Images/discussionspic.png" alt="UMD logo" class="classordisimg center">
            <p>
              <p>Have you been trying to get assistance for a class, but there were no tutors available?
            </p>
            <div class="line"></div>
            <p>True Advisory Discussions are a great way to stay connected with your classmates, tutors, and TAs outside of the classroom. This provides more opportunities to ask questions outside of class and have more direct interaction with tutors and TAs for your courses. 
            You can search for classes you are currently enrolled in and join conversations with your classmates.
            Missing deadlines or never getting answers to your questions should be a thing of the past.
            
            </p>
            <p>Want to join in on the discussion? View the active class discussions below or get started now!</p>
            <div class="btns">
              <button>Get Started</button>
            </div>
            <div class="line"></div>
          </div>
        </div>
          
          <div class="album py-5 bg-light">
            <div class="container">
   
              <div class="row">
 
              <?php foreach ($discussions as $discussion) : ?>
                <div class="col-md-4">
                  <div class="card mb-4 box-shadow">
                    <img src="Images/schoolpics_03.png" alt="Card image cap" style="width:240px;height:240px;">
                    <div class="card-body">
                      <p class="card-text"><?php echo $discussion['discussionName'];?></p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
 
                        </div>
                        <small class="text-muted">9 mins</small>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
 
              </div>
 
            </div>
          </div>
   
                <!-- Page Content Holder -->
              <div id="content">
                  <footer>Powered by the University of Michigan - Dearborn and learning in CIS 435</footer>
              </div>
            
  </body>
</html>
