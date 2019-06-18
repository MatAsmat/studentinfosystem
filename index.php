<!-- ขั้นตอนที่ 9 -->
<?php

    session_start();

    require 'connect.php';
    require 'functions.php';

    if(isset($_POST['login'])) {
        $uname = clean($_POST['username']); //เกี่ยวข้องกับ file function.php
        $pword = clean($_POST['password']);
        //สร้างตัวแปร query ใหม่
        $query = "SELECT * FROM students WHERE username = '$uname' AND password = '$pword'";
        //สร้างตัวแปร result ใหม่
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];

            header("location: profile.php");
            exit;
        } else {
            $_SESSION['errprompt'] = 'Wrong username or password.';
        }
    }

    if(!isset($_SESSION['username'], $_SESSION['password'])) { //ปีกกาปิดต่อด้านล่าง

?>

<!-- ขั้นตอนที่ 1 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Student Information System</title>
    
    <!-- (1) include link -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

</head>
<body>
    <!-- (3) include php -->
    <?php include 'header.php'; ?> <!--ดึงโค้ดจาก header มาทำงานใน index -->
    
    <section class="center-text">
        <strong>Log in</strong>
        
        <div class="login-form box-center">
        <!-- ถ้ามี successprompt, errprompt จะทำงานตรงนี้ จาก functions.php-->
            <?php

                if(isset($_SESSION['prompt'])) {
                    showPrompt();
                }

                if(isset($_SESSION['errprompt'])) {
                    showError();
                }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required >
                </div>
                
                <a href="register.php">Need an account ?</a>
                <input class="btn btn-primary" type="submit" name="login" value="Log In">
            </form>   
            
        </div>
    </section>
    
    <!-- (2) include file javascript-->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

<?php

    } else {
        header("location: profile.php");
        exit;
    }

    unset($_SESSION['prompt']);
    unset($_SESSION['errprompt']);

    mysqli_close($con);

?>