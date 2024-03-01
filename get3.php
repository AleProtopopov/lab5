<?php
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
    echo "<table border='1'>";
    echo "<thead><tr><th>auditorium</th><th>name</th><th>title</th><th>week_day</th>
    <th>lesson_number</th><th>disciple</th><th>type</th></thead>";
    foreach($res as $row)
    {
        echo"<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>
        <td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td></tr>";
    }
    echo "</table>";
}
catch(PDOException $ex) {
    echo $ex->getMessage();
}
$dbh = null;