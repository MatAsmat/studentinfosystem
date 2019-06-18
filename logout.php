<!-- ขั้นตอนที่ 19 -->
<?php

    session_start();
    session_destroy();

    header("location: index.php");
    exit;

?>