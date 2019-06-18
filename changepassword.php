<!-- ขั้นตอนที่ 16 -->
<?php

    session_start();

    require 'connect.php';
    require 'functions.php';

    if(isset($_POST['update'])) {
        $oldpass = clean($_POST['oldpass']);
        $newpass = clean($_POST['newpass']);
        $confirmpass = clean($_POST['confirmpass']);

        $query = "SELECT password FROM students WHERE password = '$oldpass'";
        $result = mysqli_query($con, $query);
        // (1)
        if(mysqli_num_rows($result) > 0) {

            // (2)
            if($newpass == $confirmpass) {
                $query = "UPDATE students SET password = '$newpass' WHERE id = '".$_SESSION['userid']."'";
                
                // (3)
                if($result = mysqli_query($con, $query)) {
                    $_SESSION['prompt'] = "Password updated."; //prompt สีเขียว
                    $_SESSION['password'] = $newpass;
                    header("location: profile.php");
                    exit;
                // (3)    
                } else {
                    die("Error with the query");
                }
           
                // (2)
            } else { //รหัสใหม่กับยืนยันรหัสใหม่ไม่ตรงกัน
                $_SESSION['errprompt'] = "The new password you entered doesn't match.";
            }

        // (1)
        } else { //ใส่รหัสเก่าผิด
            $_SESSION['errprompt'] = "You've entered a wrong old password.";
        }
    }
    // หากมีการเปลี่ยน ชื่อ รหัส ก็จะทำงาน html changepassword ทั้งหมด
    if(isset($_SESSION['username'], $_SESSION['password'])) {

?>

<!-- ขั้นตอนที่ 6 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password - Student Information System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

</head>
<body>
    <?php include 'header.php'; ?>

    <section>
        <div class="container">
            <strong class="title">Change Password</strong>
        </div>

        <div class="edit-form box-left clearfix">

            <?php
                if(isset($_SESSION['errprompt'])) {
                    showError();
                }
            ?>
            
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-group">
                    <label for="oldpass">Old Password</label>
                    <input type="password" class="form-control" name="oldpass" placeholder="Old Password" required>
                </div>

                 <div class="form-group">
                    <label for="newpass">New Password</label>
                    <input type="password" class="form-control" name="newpass" placeholder="New Password" required>
                </div>

                 <div class="form-group">
                    <label for="confirmpass">Comfirm Password</label>
                    <input type="password" class="form-control" name="confirmpass" placeholder="Comfirm Password" required>
                </div>

                 <div class="form-footer">
                    <a href="profile.php">Go Back</a>
                    <input class="btn btn-primary" type="submit"  name="update" value="Update Password">
                </div>
            </form>
        </div>
    </section>
    
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>

<!-- แต้ถ้าไม่มี -->
<?php

    } else {
        header("location: profile.php");
    }

    unset($_SESSION['errprompt']);
    mysqli_close($con); //ปิดการเชื่อมต่อฟังก์ชั่น con

?>

