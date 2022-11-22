<?php
require('backend/database.php');
// Get ID
$discussion_id = filter_input(INPUT_GET, 'discussion_id', FILTER_VALIDATE_INT);
if ($discussion_id == NULL || $discussion_id == FALSE) {
    $discussion_id = 00;
}

$discussion_name = filter_input(INPUT_GET, 'discussionName');

$queryAllCategoriesDiscussions = 'SELECT * FROM discussions';
$statementDiscussions = $db->prepare($queryAllCategoriesDiscussions);
$statementDiscussions->execute();
$discussions = $statementDiscussions->fetch();
$statementDiscussions->closeCursor();

/*$user_list = filter_input(INPUT_GET, 'name');

$queryAllCategoriesUserList = 'SELECT * FROM user';
$statementUserList = $db->prepare($queryAllCategoriesUserList);
$statementUserList->execute();
$userList = $statementUserList->fetch();
$statementUserList->closeCursor();*/

$message_id = filter_input(INPUT_GET, 'messageID', FILTER_VALIDATE_INT);
if ($message_id == NULL || $message_id == FALSE) {
    $message_id = 0;
}


$queryAllCategoriesMessages = 'SELECT * FROM messages';
$statementMessages = $db->prepare($queryAllCategoriesMessages);
$statementMessages->execute();
$message = $statementMessages->fetchAll();
$statementMessages->closeCursor();

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: signin.html');
	exit;
}

$user_id = $_SESSION['id'];
$email = $_SESSION['email'];

$queryUser = 'SELECT * FROM user WHERE id = :user_id';
$statementUser = $db->prepare($queryUser);
$statementUser->bindValue(':user_id', $user_id);
$statementUser->execute();
$user = $statementUser->fetch();
$statementUser->closeCursor();

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
    <link rel="stylesheet" href="./styles/styles.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    
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
                            <li><a href="discussions.php">Discussions</a></li>
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
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="container-fluid bootstrap snippets bootdey.com " style = " max-width: auto; width: 95%;  margin-left: auto; margin-right: auto;">
            <div class="row " >
                <div class="col-md-18"  >
                 <!-- start:chat room -->
                    <div class="box">
                    <div class="chat-room rounded"  style = "height: 1400px;" >
                        
 
                        <!-- start:aside tengah chat room -->
                        <aside class="tengah-side">
                            <div class="chat-room-head">
                                <h3><?php echo $discussions['discussionName'];?></h3>
                                <form action="#" class="pull-right position">
                                    <input type="text" placeholder="Search" class="form-control search-btn ">
                                </form>
                            </div>
                            <div id = "messages">
                                <div class = "scroll">
                                    <div class="group-rom">
                                        <?php
                                            foreach ($message as $messageType){
                                                $findID = $messageType['id'];
        
                                                $stmt = $db->prepare('SELECT name FROM user WHERE id=?');
                                                $stmt->execute([$findID]);
                                                $_SESSION['name'] = $stmt->fetchColumn();

                                                echo "<div class='first-part odd'>".$_SESSION['name']."</div>";
                                                echo "<div class='second-part'>".$messageType['message']."</div>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div id = "sendMessages">
                                <form action="./backend/messageSend.php" id="sendMessage" class="form" method="POST">
                                    <div class="chat-txt">
                                        <textarea type="text" name="message" id="message" class="form-control"></textarea>
                                    </div>
                                    
                                    <input type="hidden" id="discussionID" name="discussionID" value=<?php echo $discussions['discussionID']; ?> />
                                    <input type="hidden" id="id" name="id" value=<?php echo $user['id']; ?> />
                                    <button type="submit" 
                                    style="background-color: #fccc01;" 
                                    name="send" 
                                    id="send" 
                                    class="btn send">Send</button>
                                </form>
                                <!--action="./backend/messageSend.php"-->
                            </div>
                        </aside>
                        <!-- end:aside tengah chat room -->
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
<script>
$(document).ready( function() {

    $('#send').click( function(e) {
        e.preventDefault();
        let formData = $('#sendMessage').serialize();
 
        $.ajax({
            method: "POST",
            url: './backend/messageSend.php',
            data: formData,
            success: function(response){
                console.log(response);
            },
            error: function(xhr, status, error){
                console.error(xhr);
            }
        });

    });
});
</script>
</html>