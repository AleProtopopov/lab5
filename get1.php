<?php
$Group = $_GET["Group"];
include("connect.php");

try {
    $sqlSelect = "SELECT DISTINCT title, name, week_day, lesson_number, auditorium, disciple, type FROM `lesson` l 
    inner join `lesson_groups` lg on l.ID_Lesson = lg.FID_Lesson2 inner join `groups` g on lg.FID_Groups = g.ID_Groups 
    inner join `lesson_teacher` lt on l.ID_Lesson = lt.FID_Lesson1 inner join `teacher` t on lt.FID_Teacher = t.ID_Teacher
    WHERE title= :group";
    $stmt = $dbh->prepare($sqlSelect);
    $stmt->execute(array(':group'=>$Group));
    $res = $stmt->fetchAll();
    echo "<table border='1'>";
    echo "<thead><tr><th>title</th><th>name</th><th>week_day</th>
    <th>lesson_number</th><th>auditorium</th><th>disciple</th><th>type1</th></thead>";
    foreach($res as $row)
    {
        echo"<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>
        <td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td></tr>";
    }
}
catch(PDOException $ex) {
    echo $ex->getMessage();
}
$dbh = null;