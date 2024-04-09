<?php
    include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        const ajax = new XMLHttpRequest();

        function get1() {
            let Group = document.getElementById("Group").value;
            ajax.open("GET","get1.php?Group="+Group);
            ajax.onreadystatechange = processData;
            ajax.send();
        }
        
        function get2() {
            let Teach = document.getElementById("Teach").value;
            ajax.open("GET","get2.php?Teach="+Teach);
            ajax.onreadystatechange = processData2;
            ajax.send();
        }

        function get3() {
            let Aud = document.getElementById("Aud").value;
            ajax.open("GET","get3.php?Aud="+Aud);
            ajax.onreadystatechange = processData3;
            ajax.send();
        }

        function processData() {
            if(ajax.readyState===4)
                if(ajax.status===200){
                console.log(ajax.response);
                document.getElementById("res").innerHTML = ajax.response;
                }
        }

        function processData2() {
            if(ajax.readyState===4)
                if(ajax.status===200){
                console.log(ajax.response);
                let res = JSON.parse(ajax.response);
                console.log(res);
                let get2table = "<table border='1'><thead><tr><th>title</th><th>name</th><th>week_day</th><th>lesson_number</th><th>auditorium</th><th>disciple</th><th>type1</th></thead>"
                for (let i=0;i<res.length;i++) {
                    get2table+="<tr><td>" + res[i].name + "</td><td>" + res[i].title + "</td><td>" + res[i].week_day + "</td><td>" + res[i].lesson_number + "</td><td>" + res[i].auditorium + "</td><td>" + res[i].disciple + "</td><td>" + res[i].type + "</td></tr>"
                }
                get2table+="</table>";
                console.log(get2table);
                document.getElementById("res2").innerHTML = get2table;
                }
        }

        function processData3() {
            if(ajax.readyState===4)
                if(ajax.status===200){
                    let res = ajax.responseXML.getElementsByTagName("row");

                let get3table = "<table border='1'><thead><tr><th>title</th><th>name</th><th>week_day</th><th>lesson_number</th><th>auditorium</th><th>disciple</th><th>type1</th></thead>"
                for (let i = 0; i < res.length; i++) {
                get3table += "<tr><td>" + res[i].getElementsByTagName("title")[0].textContent + "</td><td>" + res[i].getElementsByTagName("name")[0].textContent + "</td><td>" + res[i].getElementsByTagName("week_day")[0].textContent + "</td><td>" + res[i].getElementsByTagName("lesson_number")[0].textContent + "</td><td>" + res[i].getElementsByTagName("auditorium")[0].textContent + "</td><td>" + res[i].getElementsByTagName("disciple")[0].textContent + "</td><td>" + res[i].getElementsByTagName("type")[0].textContent + "</td></tr>";
                }
                get3table+="</table>";
                console.log(get3table);
                document.getElementById("res3").innerHTML = get3table;
                }
        }
    </script>
</head>
<body>
    <label for="lessons">Група: </label>
    <select name="Group" id="Group">
        <?php
        $select = "SELECT `title` FROM `groups`";
        foreach($dbh->query($select)as $row)
        {
            echo "<option value='$row[0]'>$row[0]</option>";
        }
        ?>
    </select>
    <input type="button" value="Get!" onclick="get1()">
    <div id="res">
    </div>

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
    <input type="button" value="GetJSON!" onclick="get2()">
    <div id="res2">
    </div>

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
    <input type="button" value="GetXML!" onclick="get3()">
    <div id="res3">
    </div>
</body>
</html>