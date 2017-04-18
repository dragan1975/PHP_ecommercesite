<aside>
        <?php
        if(isset($_SESSION['user_id']) AND is_admin()){
            include 'inc/widgets/admin.php';
        }else if(isset($_SESSION['user_id'])){
            include 'inc/widgets/loggedin.php';
        }else if(isset($_GET['widget']) == 'register'){
            include 'inc/widgets/register.php';
        }else if(isset($_SESSION['active_status']) and $_SESSION['active_status'] == 0){
            include 'inc/widgets/unactivated.php';
        }
        else{
            include 'inc/widgets/login.php';
        }
        ?>
</aside>