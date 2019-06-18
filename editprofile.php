<!-- ขั้นตอนที่ 15 -->
<?php

    session_start();

    require 'connect.php';
    require 'functions.php';
    // เช็คว่าอัพเดตส่งมาไหม
    if(isset($_POST['update'])) {
        $fname = clean($_POST['firstname']);
        $lname = clean($_POST['lastname']);
        $course = clean($_POST['course']);
        $yrlevel = clean($_POST['yrlevel']);

        $query = "UPDATE students SET firstname = '$fname', lastname = '$lname', course = '$course', yrlevel = '$yrlevel'
                    WHERE id = '".$_SESSION['userid']."'";

        if($result = mysqli_query($con, $query)) {
            $_SESSION['prompt'] = "Profile Updated";
            header("location: profile.php");
            exit;
        } else {
            die("Error with the query");
        }
    }
    if(isset($_SESSION['username'], $_SESSION['password'])) {

?>
<!-- ขั้นตอนที่ 5 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile - Student Information System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

</head>
<body>
    <?php include 'header.php'; ?>

   <section>
        <div class="container">
            <strong class="title">Edit Profile</strong>
            
            <div class="edit-form box-left clearfix">
                <form action="" method="post">
                    <div class="from-group">
                        <label>Student No:</label>
                        <!-- include sql -->
                        <?php 
                            $query = "SELECT studentno FROM students WHERE id = '".$_SESSION['userid']."'";
                            $result = mysqli_query($con, $query);
                            $row = mysqli_fetch_row($result);

                            echo "<p>".$row[0]."</p>";
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>

                        <select name="course" class="form-control">
                            <option value="medicine">Faculty of Medicine</option>
                            <option value="science">Faculty of Science</option>
                            <option value="engineering">Faculty Engineering</option>
                            <option value="architecture">Faculty of Architecture</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="yrlevel">Year Level</label>

                        <select name="yrlevel" class="form-control"><!--control ขึ้นบรรทัดใหม่-->
                            <option>1st year</option>
                            <option>2nd year</option>
                            <option>3rd year</option>
                            <option>4th year</option>
                        </select>
                    </div>
                    <div class="form-footer">
                        <a href="profile.php">Go Back</a>
                        <input class="btn btn-primary "type="submit" name="update" value="Update Profile">
                    </div>
                </form>
            </div>
        </div>
   </section>

    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>

<?php

    } else {
        header("location: profile.php");
    }

    mysqli_close($con);

?>

