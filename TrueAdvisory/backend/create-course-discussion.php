<?php
require_once('database.php');
$dept = filter_input(INPUT_POST, 'dept');
$cid = filter_input(INPUT_POST, 'c-id');
$cname = filter_input(INPUT_POST, 'c-name');
$desc = filter_input(INPUT_POST, 'desc');

if ($cid == null || $cid == false || $desc == null || $desc == false) 
{
    $error_message = "Invalid data. Check all fields and try again.";
    header('Location: ../newCoursePage.php');
} else 
{
    Add course into the database
    $queryCreateCourse = "INSERT INTO `courses` (`courseID`, `courseName`, `department`, `description`)  VALUES (:cid, :cname, :dept, :desc)";
    $statementC = $db->prepare($queryCreateCourse);
    $statementC->bindValue(':cid', $cid);
    $statementC->bindValue(':cname', $cname);
    $statementC->bindValue(':dept', $dept);
    $statementC->bindValue(':desc', $desc);
    $statementC->execute();
    $statementC->closeCursor();

     $dname = 'Discuss';
     $dname .= $cname;
    // $did = $cid;

    $queryCreateD = "INSERT INTO `discussions` (`courseID`, `discussionName`)  VALUES (:cid, :dname)";
    $statementD = $db->prepare($queryCreateD);
    $statementD->bindValue(':cid', $cid);
    //$statementD->bindValue(':did', $did);
    $statementD->bindValue(':dname', $dname);
    $statementD->execute();
    $statementD->closeCursor();

    header('Location: ../admininfo.php');
}
?>