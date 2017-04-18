<?php
function user_data($user_id){
    global $pdo;
    
    $arg_num = func_num_args();
    $arg_arr = func_get_args();
    $id = $user_id;
    unset($arg_arr[0]);
    
    $col = implode(', ', $arg_arr);
    
    
    $query = $pdo->prepare("SELECT $col FROM users WHERE user_id = :id");
    $query->bindParam(":id", $id);
    $query->execute();
    if($query->rowCount() == 1){
        return $query->fetch(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

function is_admin(){
    if(isset($_SESSION['admin']) AND $_SESSION['admin'] == true){
        return true;
    }else{
        return false;
    }
}

function is_loggedin(){
    if(isset($_SESSION['user_id'])){
        return true;
    }else{
        return false;
    }
}

function is_unactivated(){
    if(isset($_SESSION['active_status']) && $_SESSION['active_status'] == 0){
        return true;
    }else{
        return false;
    }
}

function user_exists($username, $password){
    global $pdo;
    $mdPassword = md5($password);
    $query = $pdo->prepare('SELECT user_id, username, first_name, last_name, email, active FROM users WHERE username = :name AND password = :pass');
    $query->bindParam(':name', $username);
    $query->bindParam(':pass', $mdPassword);
    $query->execute();
    if($query->rowCount() == 1){
        $_SESSION['userInfo'] = $query->fetch();
        return true;
    }else{
        return false;
    }
}
function get_all_users(){
    global $pdo;
    if($query = $pdo->query('SELECT * FROM users')){
        return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
        return false;
    }
}

function get_user_details($id){
    global $pdo;
    $query = $pdo->prepare('SELECT * FROM users WHERE user_id = :id');
    $query->bindParam(':id', $id);
    $query->execute();
    if($query->rowCount() == 1){
        return $query->fetch(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

function remove_user($id){
    global $pdo;
    $query = $pdo->prepare('DELETE FROM users WHERE user_id = :id');
    $query->bindParam(':id', $id);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function change_user_active($id, $status){
    global $pdo;
    $query = $pdo->prepare('UPDATE users SET active = :status WHERE user_id = :id');
    $query->bindParam(':status', $status);
    $query->bindParam(':id', $id);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function username_exists($username){
    global $pdo;
    $query = $pdo->prepare('SELECT user_id FROM users WHERE username = :name');
    $query->bindParam(':name', $username);
    $query->execute();
    if($query->rowCount() > 0){
        return true;
    }else{
        return false;
    }
}

function email_exists($email){
    global $pdo;
    $query = $pdo->prepare('SELECT user_id FROM users WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    if($query->rowCount() > 0){
        return true;
    }else{
        return false;
    }
}

function user_active(){
    global $pdo;
    $mdPassword = md5($password);
    $query = $pdo->prepare('SELECT * FROM users WHERE username = :name AND password = :pass');
    $query->bindParam(':name', $username);
    $query->bindParam(':pass', $mdPassword);
    $query->execute();
    if($query->rowCount() == 1){
        return true;
    }else{
        return false;
    }
}

function user_count(){
    global $pdo;
    $query = $pdo->query('SELECT user_id FROM users WHERE active = 1');
    return $query->rowCount();
}

function register_new_user($username, $password, $first_name, $last_name, $email){
    global $pdo;
    $mdPassword = md5($password);
    $query = $pdo->prepare('INSERT INTO users(username, password, first_name, last_name, email) VALUES (?, ?, ?, ?, ?)');
    $query->bindParam(1, $username);
    $query->bindParam(2, $mdPassword);
    $query->bindParam(3, $first_name);
    $query->bindParam(4, $last_name);
    $query->bindParam(5, $email);
    if($query->execute()){
        return true;
    }else{
		//ovdje nije lose da se loguje greska ukoliko ima problema sa registracijom novih korisnika
        return false;
    }
}
?>