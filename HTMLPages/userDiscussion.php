<?php
require('database.php');
// Get ID
$discussion_id = filter_input(INPUT_GET, 'discussion_id', FILTER_VALIDATE_INT);
if ($discussion_id == NULL || $discussion_id == FALSE) {
    $discussion_id = 00;
}

$discussion_name = filter_input(INPUT_GET, 'discussionName');


// Get all users
$queryAllCategories = 'SELECT * FROM discussions';
$statementMessage = $db->prepare($queryAllCategories);
$statementMessage->execute();
$discussions = $statementMessage->fetch();
$statementMessage->closeCursor();


$message_id = filter_input(INPUT_GET, 'messageID', FILTER_VALIDATE_INT);
if ($message_id == NULL || $message_id == FALSE) {
    $message_id = 0;
}

// Get all users
$queryAllCategories2 = 'SELECT * FROM messages';
$statement3 = $db->prepare($queryAllCategories2);
$statement3->execute();
$message = $statement3->fetchAll();
$statement3->closeCursor();



// // Get products for selected category
// $queryProducts = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
// $statement3 = $db->prepare($queryProducts);
// $statement3->bindValue(':category_id', $category_id);
// $statement3->execute();
// $products = $statement3->fetchAll();
// $statement3->closeCursor();
// ?>

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
    <link rel="stylesheet" href="styles.css">

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
                    <a href="#">Your Home</a>
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
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" class="download">Sign in</a>
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
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        &ZeroWidthSpace;<i class="fas fa-align-justify"></i>
                    </button>

                    <div class="menu">
                        <ul>
                            <li><a href="site.html">True Advisory</a></li>
                            <li><a href="site.html">Home</a></li>
                            <li><a href="#">Courses</a></li>
                            <li><a href="#">Discussions</a></li>
                            <li><a href="#">Tutoring</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Other Resources</a></li>
                        </ul>
                        <ul>
                            <li><b><a href="signin.html" class="login_button">Login</a></b></li>
                        </ul>
                        </div> 
                </div>
            </nav>
            <div class="center">
                <h3>
                    <?php echo $discussions['discussionName'];?>
                </h3>
            </div>
            <form action="/action_page.php">
                <?php foreach ($message as $messageType)?>
                <div class="course">
                        <?php echo $messageType['message'];?>
                </div>
                <?php endforeach; ?>
                <div class="center btn-padding">
                    <button type="button" class="btn btn-default">Add New Comment</button> 
                </div>
            </form>

    
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