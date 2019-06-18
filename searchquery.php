<!-- ขั้นตอนที่ 18 -->
<!-- ยังไม่สมบูรณ์ต้องทำ javascript เพิ่ม ใน main.js -->
<?php
    require 'connect.php';
    require 'functions.php';

    $s = clean($_GET['s']);

    $query = "SELECT studentno, firstname, lastname, course, yrlevel, CONCAT(firstname, ' ', lastname) as fullname 
                FROM students WHERE CONCAT(firstname, ' ', lastname) LIKE '".$s."%' OR lastname LIKE '".$s."%' ORDER BY date_joined DESC LIMIT 5";
    // (1)
    if($result = mysqli_query($con, $query)) {
        // (2)
        if(mysqli_num_rows($result) == 0) {
            echo "<ul><li class='none'>No results to display</li></ul>";
        } else {
            echo "<ul>";

            while($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<span class='name'>".$row['fullname']."</span>";

                echo "<div class='details'>";

                echo "<span><strong>#: </strong>".$row['studentno']."</span>";
                echo "<span><strong>course: </strong>".$row['course']."</span>";
                echo "<span><strong>yr level: </strong>".$row['yrlevel']."</span>";

                echo "</div></li>";
            }

            echo "</ul>";

        }
        // (1)    
    } else {
        die("Error with the query");
    }

    mysqli_close($con);

?>
