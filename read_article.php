<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');

$getData=$_GET;

$stmt=$pdo->prepare('SELECT * FROM articles WHERE article_id=:id');
$stmt->execute([
    'id'=>$getData['article_id'],
]);
$article=$stmt->fetch();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>

    <?php require_once(__DIR__ . '/header.php');?>

    <h1><?php echo $article['title'] ?></h1>
    <p><?php echo $article['content_one']?></p>
    <p><?php echo $article['content_two']?></p>
    <p><?php echo $article['content_three']?></p>
    <p>Ecrit par <span style="font-weight:bold"><?php echo $article['author']; ?></span></p>
    <i><?php echo $article['created_at']; ?></i><br><br>

    <button class="btn btn-primary" ><a href="create_comment.php?article_id=<?php echo $article['article_id']?>" style="color:white; text-decoration:none">Ajouter un commentaire</a></button>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>