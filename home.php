<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');


$stmt=$pdo->prepare('SELECT * FROM articles');
$stmt->execute();
$articles=$stmt->fetchAll();

$sql=$pdo->prepare('SELECT c.name, a.title
FROM articles a
INNER JOIN categories c ON a.category_id=c.category_id;
');
$sql->execute();
$category=$sql->fetch();


$errorD=null;


if(isset($_SESSION['ERRORD'])){
  $errorD=$_SESSION['ERRORD'];
  unset($_SESSION['ERRORD']);
  if(isset($_GET['article_id'])){
    $badId=$_GET['article_id'];
  }
}

$errorU=null;
if(isset($_SESSION['ERRORU'])){
  $errorU=$_SESSION['ERRORU'];
  unset($_SESSION['ERRORU']);
  if(isset($_GET['article_id'])){
    $lostId=$_GET['article_id'];
  }
}
// if(isset($_SESSION['LOGGED_USER'])){
//   echo "Bonjour et bienvenue";
// }

// if(isset($_SESSION['NEW_USER'])){
//   echo " Salut";
// }






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
    <?php require_once(__DIR__ . '/header.php');?><br>
    <!-- <h1>Bonjour et bienvenu(e) <?php echo $_SESSION['LOGGED_USER']; ?></h1>
    <br> -->

    <?php if(isset($_SESSION['LOGGED_USER'])) : ?>
      <h2><?php echo "Bonjour " . $_SESSION['LOGGED_USER'] . " !"; ?></h2><br>
    <?php endif; ?>
    <?php foreach($articles as $a) : ?>
      <div class="card">
        <div class="card-header" style="background-color:white!important; font-weight:bold;">
          <?php echo $category['name']; ?>
        </div>
        <div class="card-body">
          <h6 class="card-title"><?php echo $a['title']; ?></h6><br>
          <p><?php echo $a['author']; ?></p>
          <i><?php echo "crée le : " . $a['created_at']; ?></i><br><br>
          <i><?php echo "modifier le : " . $a['updated_at']; ?></i><br><br>
            <a href="read_article.php?article_id=<?php echo $a['article_id']; ?>" class="btn btn-primary">Lire</a>
            <a href="update_article.php?article_id=<?php echo $a['article_id'];?>" class="btn btn-warning">Modifier</a>
            <a href="delete_article.php?article_id=<?php echo $a['article_id'];?>" class="btn btn-danger">Supprimer</a><br><br>
            <?php if($errorU && isset($lostId) && $lostId == $a['article_id']) : ?>
              <div style="color:red; font-size:12px"><?php echo $errorU; ?></div>
            <?php endif; ?>
            <?php if($errorD && isset($badId) && $badId == $a['article_id']):?>
              <div style="color:red; font-size:12px"><?php echo $errorD; ?></div>
            <?php endif; ?>
        </div>
      </div><br>
    <?php endforeach; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>