<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');

$postData=$_POST;

$stmt=$pdo->prepare('UPDATE articles SET category_id=:category_id, title=:title, content_one=:content_one, content_two=:content_two, content_three=:content_three WHERE article_id=:id');
$stmt->execute([
    'id'=>$postData['article_id'],
    'category_id'=>$postData['category_id'],
    'title'=>$postData['title'],
    'content_one'=>$postData['content_one'],
    'content_two'=>$postData['content_two'],
    'content_three'=>$postData['content_three'],
]);

header('Location:home.php');

?>