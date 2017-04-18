<?php
function articles_data($brend_id = null){
    global $pdo;
    
    if(isset($brend_id)){
        $arg_num = func_num_args();
        $arg_arr = func_get_args();
        $id = $brend_id;
        
        unset($arg_arr[0]);
    
        $col = implode(', ', $arg_arr);
        
        $sql = "SELECT $col FROM articles WHERE brend_id = :id";
    }else{
        $sql = "SELECT * FROM articles LEFT JOIN brends ON articles.brend_id = brends.brend_id";
    }
    
    $query = $pdo->prepare($sql);
    $query->bindParam(":id", $id);
    $query->execute();
    if($query->rowCount() > 0){
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

function articles_data_type($type){
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM articles WHERE article_type = :type");
    $query->bindParam(":type", $type);
    $query->execute();
    if($query->rowCount() > 0){
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

function article_data($article_id){
    global $pdo;
    $query = $pdo->prepare('SELECT * FROM articles  LEFT JOIN brends ON articles.brend_id = brends.brend_id WHERE article_id = :id');
    $query->bindParam(':id', $article_id);
    $query->execute();
    if($query->rowCount() == 1){
        return $query->fetch(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

function remove_article($id){
    global $pdo;
    $query = $pdo->prepare('DELETE FROM articles WHERE article_id = :id');
    $query->bindParam(':id', $id);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function change_article_action($id, $action){
    global $pdo;
    $query = $pdo->prepare('UPDATE articles SET article_action = :action WHERE article_id = :id');
    $query->bindParam(':action', $action);
    $query->bindParam(':id', $id);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function select_brends(){
    global $pdo;
    if($query = $pdo->query('SELECT * FROM brends')){
        return $query->fetchAll(PDO::FETCH_OBJ);
    }else{
        return false;
    }
}
//ovo je moja dodata funkcija koja vraca nazive brendova u formi numerickog niza (upotreba PDO::FETCH_COLUMN parametra)
function select_brends_names(){
	global $pdo;
	return $query = $pdo->query('SELECT brend_name FROM brends')->fetchAll(PDO::FETCH_COLUMN);
}
//funkcija koja bi trebala vracati id i name u form key, value
function select_brends_names_and_ids(){
	global $pdo;
	return $query = $pdo->query('SELECT brend_id,brend_name FROM brends')->fetchAll(PDO::FETCH_KEY_PAIR);
}

function update_article($article_id, $article_name, $article_price, $article_lager, $article_type, $brend_id, $article_description){
    global $pdo;
    $query = $pdo->prepare('UPDATE articles SET article_name = :a_name, article_price = :a_price, article_lager = :a_lager, article_type = :a_type, brend_id = :b_id, article_description = :a_description WHERE article_id = :a_id');
    $query->bindParam(':a_name', $article_name);
    $query->bindParam(':a_price', $article_price);
    $query->bindParam(':a_lager', $article_lager);
    $query->bindParam(':a_type', $article_type);
    $query->bindParam(':b_id', $brend_id);
    $query->bindParam(':a_description', $article_description);
    $query->bindParam(':a_id', $article_id);
        
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function add_new_article($article_name, $article_price, $article_lager, $article_type, $brend_id, $article_description){
    global $pdo;
    $query = $pdo->prepare('INSERT INTO articles(article_name, article_price, article_lager, article_type, article_description, brend_id) VALUES (:a_name, :a_price, :a_lager, :a_type, :a_description, :b_id)');
    $query->bindParam(':a_name', $article_name);
    $query->bindParam(':a_price', $article_price);
    $query->bindParam(':a_lager', $article_lager);
    $query->bindParam(':a_type', $article_type);
    $query->bindParam(':a_description', $article_description);
    $query->bindParam(':b_id', $brend_id);
        
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function article_buy($article_id, $user_id){
    global $pdo;
    $cart_code = get_cart_code($user_id);
    $query = $pdo->prepare('INSERT INTO carts (article_id, user_id, cart_code) VALUES (:a_id, :u_id, :cart_code)');
    $query->bindParam(':a_id', $article_id);
    $query->bindParam(':u_id', $user_id);
    $query->bindParam(':cart_code', $cart_code);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function get_cart($user_id){
    global $pdo;
    $query = $pdo->prepare('SELECT articles.article_id, articles.article_name, articles.article_price
                           FROM articles LEFT JOIN carts
                           ON articles.article_id = carts.article_id
                           WHERE carts.user_id = :user_id AND cart_user_status = 0');
    $query->bindParam(':user_id', $user_id);
    if($query->execute()){
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

function cart_article_drop($article_id, $user_id){
    global $pdo;
    $query = $pdo->prepare('DELETE FROM carts WHERE article_id = :a_id AND user_id = :u_id AND cart_user_status = 0');
    $query->bindParam(':a_id', $article_id);
    $query->bindParam(':u_id', $user_id);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function cart_close($user_id){
    global $pdo;
    $query = $pdo->prepare('UPDATE carts SET cart_user_status = 1 WHERE user_id = :u_id AND cart_user_status = 0');
    $query->bindParam(':u_id', $user_id);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function get_cart_code($user_id){
    global $pdo;
    $query = $pdo->prepare("SELECT DISTINCT cart_code FROM carts WHERE user_id = :u_id AND cart_user_status = 0");
    $query->bindParam(':u_id', $user_id);
    $query->execute();
    if($query->rowCount() > 0){
        $rez = $query->fetch(PDO::FETCH_ASSOC);
        return $rez['cart_code']; 
    }else{
        return date("ymdhis") . rand(0, 1000);
    }
}

function get_open_cart_code(){
     global $pdo;
     $query = $pdo->query("SELECT * FROM open_cart_code");
    if($query->rowCount() > 0){
        return $query->fetchAll(PDO::FETCH_ASSOC); 
    }else{
        return false;
    }
}

function get_closed_cart_code(){
     global $pdo;
     $query = $pdo->query("SELECT * FROM closed_cart_code");
    if($query->rowCount() > 0){
        return $query->fetchAll(PDO::FETCH_ASSOC); 
    }else{
        return false;
    }
}

function get_cart_by_code($cart_code){
    global $pdo;
    $cart_code = (string)$cart_code;
    $query = $pdo->prepare("SELECT carts.user_id, carts.article_id, users.first_name, users.last_name, articles.article_name, articles.article_price
                           FROM carts LEFT JOIN users
                           ON carts.user_id = users.user_id
                           LEFT JOIN articles
                           ON carts.article_id = articles.article_id
                           WHERE carts.cart_code = :cart_code");
    $query->bindParam(':cart_code', $cart_code);
    $query->execute();
    if($query->rowCount() > 0){
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

function cart_admin_close($cart_code){
    $cart_code = (string)$cart_code;
    global $pdo;
    $query = $pdo->prepare("UPDATE carts SET cart_admin_status = 1 WHERE cart_code = :cart_code");
    $query->bindParam(':cart_code', $cart_code);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function cart_delete($cart_code){
    global $pdo;
    $query = $pdo->prepare('DELETE FROM carts WHERE cart_code = :cart_code');
    $query->bindParam(':cart_code', $cart_code);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function comments($article_id){
    global $pdo;
    $query = $pdo->prepare("SELECT comments.comment_id, comments.comment, comments.time, users.first_name
                           FROM comments LEFT JOIN users
                           ON comments.user_id = users.user_id
                           WHERE article_id = :a_id");
    $query->bindParam(':a_id', $article_id);
    $query->execute();
    if($query->rowCount() > 0){
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }else{
        return false;
    }
}

function insert_comment($user_id, $article_id, $comment){
    global $pdo;
    $query = $pdo->prepare('INSERT INTO comments (user_id, article_id, comment) VALUES (:u_id, :a_id, :comment)');
    $query->bindParam(':u_id', $user_id);
    $query->bindParam(':a_id', $article_id);
    $query->bindParam(':comment', $comment);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}

function delete_comment($id){
    global $pdo;
    $query = $pdo->prepare('DELETE FROM comments WHERE comment_id = :id');
    $query->bindParam(':id', $id);
    if($query->execute()){
        return true;
    }else{
        return false;
    }
}
?>