<!-- ขั้นตอนที่ 13 -->
<?php 

    session_start();

    require 'connect.php';
    require 'functions.php';

    if(isset($_POST['register'])) {
        // clean จาก file functions.php
        $uname = clean($_POST['username']);
        $pword = clean($_POST['password']);
        $studno = clean($_POST['studentno']);
        $fname = clean($_POST['firstname']);
        $lname = clean($_POST['lastname']);
        $course = clean($_POST['course']);
        $yrlevel = clean($_POST['yrlevel']);

        $query = "SELECT username FROM students WHERE username = '$uname'";
        $result = mysqli_query($con, $query); //con มาจาก file connect.php
        // (1) เช็ค if ตัวแรง
        if(mysqli_num_rows($result) == 0) {
            $query = "SELECT studentno FROM students WHERE studentno = '$studno'";
            $result = mysqli_query($con, $query);
            // (2)
            if(mysqli_num_rows($result) == 0) {
                $query = "INSERT INTO students (username, password, studentno, firstname, lastname, course, yrlevel, date_joined)
                            VALUES ('$uname', '$pword', '$studno', '$fname', '$lname', '$course', '$yrlevel', NOW())";
                // (3)
                if(mysqli_query($con, $query)) {
                    $_SESSION['prompt'] = "Account registered. You can now login.";
                    header("location: index.php");
                    exit;
                // (3)
                } else {
                    die("Error with the query");
                }
            // (2)
            } else {
                $_SESSION['errprompt'] = "That student number already exists.";
            }
        // (1)
        } else {
            $_SESSION['errprompt'] = "Username already exists.";
        }
    }
?>

<!-- ขั้นตอนที่ 3 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Student Information System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

</head>
<body>
    <?php include 'header.php'; ?>

    <section class="center-text">
        <strong>Register</strong>

        <div class="registration-form box-center clearfix">

        <?php
            if(isset($_SESSION['errprompt'])) {
                showError();
            }
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="row">
                    <div class="account-info col-sm-6">
                        <fieldset>
                            <legend>Account Info</legend>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username (must be unique)" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" require>
                            </div>

                        </fieldset>  
                    </div> 
                    <!-- acount-info -->
                    <div class="personal-info col-sm-6">
                        <fieldset>
                            <legend>Personal Info</legend>

                            <div class="form-group">
                                <label for="studentno">Student Number</label>
                                <input type="text" class="form-control" name="studentno" placeholder="Student Number (must be unique)" required>
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
                        </fieldset>
                    </div>
                </div>
                <a href="index.php">Go Back</a>
                <input class="btn btn-primary" type="submit" name="register" value="Register">
            </form>

        </div>
    </section>

    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    unset($_SESSION['errprompt']);
    mysqli_close($con);
?>
