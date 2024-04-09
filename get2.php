<?php
$group = $_GET["Teach"];
include("connect.php");

try {
    $sqlSelect = "SELECT DISTINCT name, title, week_day, lesson_number, auditorium, disciple, type FROM `lesson` l 
    inner join `lesson_groups` lg on l.ID_Lesson = lg.FID_Lesson2 inner join `groups` g on lg.FID_Groups = g.ID_Groups 
    inner join `lesson_teacher` lt on l.ID_Lesson = lt.FID_Lesson1 inner join `teacher` t on lt.FID_Teacher = t.ID_Teacher
    WHERE name = :group";
    $stmt = $dbh->prepare($sqlSelect);
    $stmt->execute(array(':group'=>$group));
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($res);
}
catch(PDOException $ex) {
    echo $ex->getMessage();
}
$dbh = null;