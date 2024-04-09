<?php
header('Content-Type: text/xml'); 
$Aud = $_GET["Aud"];
include("connect.php");

try {
    $sqlSelect = "SELECT DISTINCT auditorium, name, title, week_day, lesson_number, disciple, type FROM `lesson` l 
    inner join `lesson_groups` lg on l.ID_Lesson = lg.FID_Lesson2 inner join `groups` g on lg.FID_Groups = g.ID_Groups 
    inner join `lesson_teacher` lt on l.ID_Lesson = lt.FID_Lesson1 inner join `teacher` t on lt.FID_Teacher = t.ID_Teacher
    WHERE auditorium= :Aud";
    $stmt = $dbh->prepare($sqlSelect);
    $stmt->execute(array(':Aud'=>$Aud));
    $res = $stmt->fetchAll();
    echo '<?xml version="1.0" encoding="UTF-8" ?>';
    echo "<root>";
    foreach($res as $row)
    {
        echo"<row><auditorium>$row[0]</auditorium><name>$row[1]</name><title>$row[2]</title><week_day>$row[3]</week_day>
        <lesson_number>$row[4]</lesson_number><disciple>$row[5]</disciple><type>$row[6]</type></row>";
    }
    echo "</root>";
}
catch(PDOException $ex) {
    echo $ex->getMessage();
}
$dbh = null;