<?php
require_once('database.php');

$dept = filter_input(INPUT_POST, 'n_dept');
$cid = filter_input(INPUT_POST, 'cid');
$cname = filter_input(INPUT_POST, 'n_c_name');
$desc = filter_input(INPUT_POST, 'n_desc');

if ($cid == null || $desc == null) 
{
    $error_message = "Invalid data. Check all fields and try again.";
    header('Location: ../updateCoursePage.php');
} else 
{
    //Add course into the database
    $queryCreateCourse = "UPDATE courses SET courseName=:cname, department=:dept, description=:desc, needUpdate=0 WHERE courseID=:cid";
    $statementC = $db->prepare($queryCreateCourse);
    $statementC->bindValue(':cid', $cid);
    $statementC->bindValue(':cname', $cname);
    $statementC->bindValue(':dept', $dept);
    $statementC->bindValue(':desc', $desc);
    $statementC->execute();
    $statementC->closeCursor();

     $dname = 'Discuss';
     $dname .= $cname;
    $did = $cid;

    $queryCreateD = "UPDATE discussions SET discussionName=:dname WHERE courseID=:did";
    $statementD = $db->prepare($queryCreateD);
    //$statementD->bindValue(':cid', $cid);
    $statementD->bindValue(':did', $did);
    $statementD->bindValue(':dname', $dname);
    $statementD->execute();
    $statementD->closeCursor();

    header('Location: ../admininfo.php');
}
?>