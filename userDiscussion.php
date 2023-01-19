<?php
require_once('./backend/database.php');
require_once('./backend/informationQuery.php');
// We need to use sessions, so you should always start sessions using the below code.

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


$discussion_id = filter_input(INPUT_GET, 'discussion_id', FILTER_VALIDATE_INT);
if ($discussion_id == NULL || $discussion_id == FALSE) {
    $discussion_id = 00;
}

$discussion_name = filter_input(INPUT_GET, 'discussionName');

$queryAllCategoriesDiscussions = 'SELECT * FROM discussions WHERE discussionID = :discussion_id';
$statementDiscussions = $db->prepare($queryAllCategoriesDiscussions);
$statementDiscussions->bindValue(':discussion_id', $discussion_id);
$statementDiscussions->execute();
$discussions = $statementDiscussions->fetch();
$statementDiscussions->closeCursor();

$message_id = filter_input(INPUT_GET, 'messageID', FILTER_VALIDATE_INT);
if ($message_id == NULL || $message_id == FALSE) {
    $message_id = 0;
}

$queryAllCategoriesMessages = 'SELECT * FROM messages WHERE discussionID = :discussion_id';
$discuss = $db->prepare($queryAllCategoriesMessages);
$discuss->bindValue(':discussion_id', $discussion_id);
$discuss->execute();
$message = $discuss->fetchAll();
$discuss->closeCursor();

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

    <script src="https://cdn.tiny.cloud/1/h4q44g5dcbtjoz0xm3jwlzejtvv39ixmrzziivdtex66c6ke/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea#message',

        max_height: 275,
        max_width: 1200
            ,plugins: [
            'textcolor','a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
            'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
            'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
            ],
            toolbar: 'forecolor backcolor| undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
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
                <li>
                    <a href="userprofileinfo.php">Your Home</a>
                    <a href="#courseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Course List</a>
                    <ul class="collapse list-unstyled" id="courseSubmenu">
                    <?php foreach ($currCourse as $course) : ?>
                            <a href="userCoursesPage.php">
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
                                <a href="userDiscussion.php?discussion_id=<?php echo $discuss['discussionID']?>">
                                <?php echo $discuss['courseID'];?>
                            </a>
                            <?php endforeach; ?>
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
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="menu w-100 order-1 order-md-0">
                        <ul>
                        <li><a href="">True Advisory</a></li>
                          <li><?php if(isset($_SESSION['loggedin']))
                                        {if($_SESSION['adminPrivileges'] == 1)
                                            {echo "<a href='admininfo.php'>Home</a>";}
                                        else if($_SESSION['adminPrivileges'] == 0 || $_SESSION['adminPrivileges'] == 2)
                                        {echo "<a href='userprofileinfo.php'>Home</a>";}
                                        }
                                        
                                    else{ echo '<a href="index.html">Home</a>';
                                        }?></li>
                          <li><a href="classes.php">Courses</a></li>
                          <li><a href="discussions.php">Discussions</a></li>
                          <li><a href="tutors.php">Tutoring</a></li>
                          <li><a href="aboutUs.php">About</a></li>
                          <li><a href="otherResources.php">Resources</a></li>
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
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <div class="container-fluid bootstrap snippets bootdey.com " style = " max-width: auto; width: 95%;  margin-left: auto; margin-right: auto; margin-bottom: 50px;"">
            <div class="row " >
                <div class="col-md-18"  >
                 <!-- start:chat room -->
                    <div class="box ">
                         <div class="chat-room rounded"  style = "height: 1200px;" >
                        
                   
                        <!-- start:aside tengah chat room -->
                        
                            <div class="chat-room-head">
                                <h3><?php echo $discussions['discussionName'];?></h3>
                                <form action="#" class="pull-right position">
                                                                    </form>
                            </div>
                            <div class = "scroll" id='div1'>
                                <?php
                                    foreach ($message as $messageType){
                                        $findID = $messageType['id'];

                                        $stmt = $db->prepare('SELECT name FROM user WHERE id=?');
                                        $stmt->execute([$findID]);
                                        $_SESSION['name'] = $stmt->fetchColumn();

                                        
                                        echo "<div class='group-rom'><div class='first-part odd'>".$_SESSION['name']."</div>
                                        <div class='second-part'>".$messageType['message']."</div>";
                                        
                                        if ($messageType['id'] == $_SESSION['id'] || $_SESSION['adminPrivileges'] == 1 || $_SESSION['tutorPrivileges'] == 1){
                                            echo '
                                            <form method="POST" action = "./backend/remove-message.php" id ="deleteForm">
                                                <div class="input-group-append">
                                                    <input type="hidden" id="cid" name="cid" value='.$messageType["messageID"].'>
                                                    <input type="hidden" id="aid" name="aid" value='.$messageType["discussionID"].'>
                                                    <input type="submit" name="remove-course-submit" id="Btn" class="btn delete" value="Remove"/>
                                                </div>
                                            </form>
                                            ';
                                        }
                                        echo "</div>";
                                        
                                     } 
                                ?>
                                <div id='displayData1'></div>
                            </div>
                            <footer>
                                <form action="./backend/messageSend.php" id="sendMessage" class="form" method="POST">
                                    <div class="chat-txt">
                                        <textarea type="text" name="message" id="message" class="form-control" value=''></textarea>
                                    </div>
                                    
                                    <input type="hidden" id="discussionID" name="discussionID" value=<?php echo $discussions['discussionID']; ?> />
                                    <input type="hidden" id="id" name="id" value=<?php echo $user['id']; ?> />
                                    
                                                                                                     
                                    <input type="hidden" id="name" name="name" value=<?php echo $user['name']; ?> />       
                                    <button type="submit"
                                            name="send" 
                                            id="send" 
                                            class="btn send">Send</button>
                                </form>
                            </footer>
                        
                        <!-- end:aside tengah chat room -->
                        </div>
                    </div>
                    <!-- end:chat room -->
                </div>
                </div>
            </div>
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
<!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>;
<script>

setInterval(function() {
$("#div1").load(location.href+" #div1>*","");
}, 1000);

$(document).ready( function() {

    $('#send').submit(function(e) {
        e.preventDefault();
        //e.stopPropagation();
        let formData = $('#sendMessage').serialize();
	//formData.push({name: 'content', value: tinyMCE.get('tinymce').getContent()});
        $.ajaxSetup ({
                 cache: false
            });

        // specify the server/url you want to load data from
        
        $.ajax({
            
            method: "POST",
            url: './backend/messageSend.php',
            data: formData,
            
            success: function(formdata){
                //console.log('success');
                //$('.displayData').html(formData);
                $varmessage = $('#message').val();
                $varname = $('#name').val();
                $varmessageid = $('#messageID').val();
                $vardiscussionid = $('#discussionID').val();
                //var url = "http://trueadvisory.fall2022web.tech/userDiscussion.php?discussion_id="+$vardiscussionid;

                //var $name_use = $('<div>').text($varname);

                var rows = "<div class='group-rom'>"
                + "<div class='first-part odd'>" + $varname + "</div>"
                + "<div class='second-part'>" + $varmessage + "</div>"
                    + "<form method='POST' action = './backend/remove-message.php' id ='deleteForm'><div class='input-group-append'>" +
                        "<input type='hidden' id='uid' name='uid' value=$messageType['id']>" +
                        "<input type='hidden' id='cid' name='cid' value="+$varmessageid+">" +
                        "<input type='hidden' id='aid' name='aid' value="+$vardiscussionid+">" +  
                        "<input type='submit' name='remove-course-submit' id='Btn' class='btn btn-outline-secondary' value='Remove'/>" +
                    "</div>" + 
                "</form>"
                + "</div>";

                $('#displayData1').append(rows);


                //var $message_use = $("<div>").text($varmessage);    
                //$('#displayData2')
                    //.append($message_use);

                const inputs = document.querySelectorAll('#message');

                inputs.forEach(input => {
                    input.value = '';
                });
                
            },  

            error: function(xhr, status, error, formData){
                //console.error(xhr);

                const inputs = document.querySelectorAll('#message');

                inputs.forEach(input => {
                    input.value = '';
                });
                
            }
            

    });    
});

/*$('#Btn').click( function(e){
        e.preventDefault();
        let formData = $('#deleteForm').serialize();
        $.ajax({
                // url of the data to be delete
                method: 'POST',
                url : './backend/remove-message.php',

                type : 'DELETE',
                success : function ( data ) {
                    console.log('success');
                    $( "p" ).append( "Delete request is Success." );
                },
                error : function ( jqXhr, textStatus, errorMessage ) {
                    console.log('fail');
                    $( "p" ).append( "Delete request is Fail.");
                }

        });
    });*/

});

</script>


</html>