<?php
include_once 'core/init.php';
include 'inc/temp/master/master_top.php';
if(isset($_POST['username']) and isset($_POST['password'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if(!empty($username) AND !empty($password)){
 //prostor za rad - pocetak    
       
       if(user_exists($username, $password) === false){
            $errors[] = "Nepostojeći korisnik. Da li ste se registrovali?";
       }else if($_SESSION['userInfo']['active'] == 0){
            $_SESSION['active_status'] = 0;
            header('Location: index.php');
			//u ovom dijelu nakon redirekcije na naslovnu stranu, utvrdjuj se da li je korisnik 0,1,2 i shodno tome mu se dalje otvaraju widget-i i eventualno admin dio sajta 
       }else if ($_SESSION['userInfo']['active'] == 1){
            $_SESSION['user_id'] = $_SESSION['userInfo']['user_id'];
            header('Location: index.php');
       }else if ($_SESSION['userInfo']['active'] == 2){
            $_SESSION['user_id'] = $_SESSION['userInfo']['user_id'];
            $_SESSION['admin'] = true;
            header('Location: index.php');
       }
    
    
//prostor za rad - kraj
    }else{
        $errors[] = 'Morate proslediti korisničko ime i lozinku.';
    }
}else{
    $errors[] = 'Sva polja moraju biti prosleđena.';
}
if(isset($errors)){
    ?>
    <img src="img/error.png" style="height: 70px"/>
    <h1>Neuspešno logovanje!</h1>
	<!-- caka za brzi prikaz u listama -->
    <ul><li><?php echo implode('</li><li>', $errors) ?></li></ul>
    
    
    <?php
    };
include 'inc/temp/master/master_footer.php'; ?>