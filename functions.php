<!-- ขั้นตอนที่ 11 -->
<?php
    //สร้างฟังก์ชั่นคลีน
    function clean($data) {
        $data = trim($data);
        $data = stripslashes($data);

        return $data;
    }

    function showPrompt() {
        echo "<div class='alert alert-success'>".$_SESSION['prompt']."</div>";
    }

    function showError() {
        echo "<div class='alert alert-danger'>".$_SESSION['errprompt']."</div>";
    }
?>
