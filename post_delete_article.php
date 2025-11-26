<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');

$postData=$_POST;

$stmt=$pdo->prepare('DELETE FROM articles WHERE article_id=:id');
$stmt->execute([
    'id'=>$postData['article_id'],
]);

header('Location: home.php');

?>