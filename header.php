<!-- ขั้นตอนที่ 12 ใส่ phpทั้งหมด ด้านล่าง -->

<!-- ขั้นตอนที่ 2 -->
<nav class="navbar navbar-default">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display   -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Student information System</a>
        </div>

        <!-- Collect the nav link, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <?php

                if(isset($_SESSION['username'], $_SESSION['password'])) { //ปีกกาาิดต่อด้านล่าง
            ?>

            <form class="navbar-form navbar-right" action="searchresult.php" method="get">
                <div class="search-area">
                    <div class="form-group">
                        <div class="search-wrap">
                            <label for="searchbox" class="sr-only">Search:</label>
                            <input type="text" class="form-control" name="searchbox" id="searchbox" placeholder="Search student name here" required autocomplete="off">
                            <div class="search-results hide"></div>
                        </div>
                    </div>
                    <input type="submit" name="search" id="search-btn" value="Search" class="btn btn-default">
                </div>
                <div class="welcome"><?php echo "Welcome, <a href='profile.php'>".$_SESSION['username']."</a>! "; ?></div>
                <a href="logout.php">Log Out <span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>
            </form>
            <?php
            //หากยังไม่ได้ login ก็ให้แสดง not logged in.
                } else {
                    echo "<span class='not-logged'>Not logged in.</span>";
                }
            ?>
        </div>
   </div> <!-- container-->
</nav>