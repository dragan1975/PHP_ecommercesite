<?php
$_GET['widget']='register';
include_once 'core/init.php';
include 'inc/temp/master/master_top.php';
if(is_loggedin() || is_unactivated()) header ('Location: index.php');
	// ovo je cest nacin rjesavanja obaveznih polja, nesto kao bijela lista
    $required_fields = array('username','password','passwordA','first_name','last_name','email');
    foreach($required_fields as $field){
        if(!isset($_POST[$field]) || empty(trim($_POST[$field]))){
            switch($field){
                case 'username': $f = 'Korisničko ime'; break;
                case 'password': $f = 'Lozinka'; break;
                case 'passwordA': $f = 'Ponovi lozinku'; break;
                case 'first_name': $f = 'Ime'; break;
                case 'last_name': $f = 'Prezime'; break;
                case 'email': $f = 'E-mail adresa'; break;                
            }
            $errors[] = 'Polje <b>' . $f . '</b> mora biti upisano.';
        }else{
			//kreiraj mi promjenjivu (prvi $) koja se zove kao vrijednost polja ($field)
            $$field = trim($_POST[$field]);
        }
    }
    
    if(isset($username)){
        if(username_exists($username)) $errors[] = 'Korisničko ime već postoji u bazi. Odaberite drugo.';
        if(strlen($username) < 5) $errors[] = 'Korisničko ime mora imati najmanje 5 karaktera.';
        if(!ctype_alnum($username)) $errors[] = 'Korisničko ime može sadržati samo slova i brojeve.';
    }
    if(isset($first_name)){
        if(strlen($first_name) < 3) $errors[] = 'Ime mora imati najmanje 3 karaktera.';
        if(!ctype_alpha($first_name)) $errors[] = 'Ime mora sadržati samo slova.';
    }
    if(isset($last_name)){
        if(strlen($last_name) < 3) $errors[] = 'Prezime mora imati najmanje 3 karaktera.';
        if(!ctype_alpha($last_name)) $errors[] = 'Prezime mora sadržati samo slova.';
    }
    if(isset($password) && isset($passwordA)){
        if(strlen($password) < 6) $errors[] = 'Lozinka mora imati najmanje 6 karaktera.';
        if($password !== $passwordA) $errors[] = 'Lozinke se ne poklapaju';
    }
    if(isset($email)){
        if(email_exists($email)) $errors[] = 'Već postoji korisnik sa ovom E-mail adresom.';
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Unesite validnu E-mail adresu.';
    }
    
    if(count($errors) == 0){
        if(register_new_user($username, $password, $first_name, $last_name, $email)){
            $_SESSION['active_status'] = 0;
            header('Location: index.php');
        }else{
            $errors[] = 'Došlo je do greške prilikom registracije. Obratite se tehničkoj podršci.';
        }
    }

if(isset($errors)){
    ?>
    <img src="img/error.png" style="height: 70px"/>
    <h1>Registracija neuspešna!</h1>
    <ul><li><?php echo implode('</li><li>', $errors) ?></li></ul>
    
    
    <?php
    }else{
        header('Location: index.php');
        };
include 'inc/temp/master/master_footer.php'; ?>