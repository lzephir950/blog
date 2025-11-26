<?php 

require_once(__DIR__ . '/../../config/mysql.php');

$stmt=$pdo->prepare('SELECT username, password, name, user_id FROM users WHERE username=:username AND password=:password');
$stmt->execute([
    'username'=>$username,
    'password'=>$password,
]);
$user=$stmt->fetch();

?>