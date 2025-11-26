<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');

$getData=$_GET;

$stmt=$pdo->prepare('SELECT article_id FROM articles WHERE article_id=:id');
$stmt->execute([
    'id'=>$getData['article_id'],
]);
$stmt=$stmt->fetch();

$sql=$pdo->prepare('SELECT * FROM articles');
$sql->execute();
$a=$sql->fetch();

if(isset($_SESSION['LOGGED_USER'])){

    if($_SESSION['LOGEGD_USER'] != $a['author']){
        $_SESSION['ERRORD']="Vous ne pouvez pas supprimer cet article";

        header('Location:home.php?article_id=' . $getData['article_id']);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h5>Etes vous sûr de vouloir supprimer ?</h5>
    <form action="post_delete_article.php" method="post">
        <input type="hidden" name="article_id" value="<?php echo $getData['article_id']; ?>">
        <button type="submit">OUI</button>
    </form>
</body>
</html>