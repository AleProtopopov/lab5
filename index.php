<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="get1.php" method="get">
        <label for="lessons">Група: </label>
        <select name="Group" id="Group">
        <?php
        include("connect.php");
        $select = "SELECT `title` FROM `groups`";
        foreach($dbh->query($select)as $row)
        {
            echo "<option value='$row[0]'>$row[0]</option>";
        }
        ?>
        </select>
        <input type="submit" value="Go">
    </form>
    <form action="get2.php" method="get">
        <label for="lessons">Викладач: </label>
        <select name="Teach" id="Teach">
        <?php
        $select = "SELECT `name` FROM `teacher`";
        foreach($dbh->query($select)as $row)
        {
            echo "<option value='$row[0]'>$row[0]</option>";
        }
        ?>
        </select>
        <input type="submit" value="Go">
    </form> 
    <form action="get3.php" method="get">
        <label for="lessons">Аудіторія: </label>
        <select name="Aud" id="Aud">
        <?php
        $select = "SELECT DISTINCT `auditorium` FROM `lesson`";
        foreach($dbh->query($select)as $row)
        {
            echo "<option value='$row[0]'>$row[0]</option>";
        }
        ?>
        </select>
        <input type="submit" value="Go">
    </form>
</body>
</html>