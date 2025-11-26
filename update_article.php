<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');





$getData=$_GET;
// afficher categories dans select
$stmt=$pdo->prepare('SELECT name,category_id FROM categories');
$stmt->execute();
$categories=$stmt->fetchAll();

// afficher element a modifier dans article
$sql=$pdo->prepare('SELECT * FROM articles WHERE article_id=:id');
$sql->execute([
    'id'=>$getData['article_id'],
]);
$article=$sql->fetch();

$row=$pdo->prepare('SELECT c.name, a.category_id
FROM categories c
INNER JOIN articles a ON c.category_id=a.category_id');
$row->execute();
$cat=$row->fetch();

// if(isset($_SESSION['LOGGED_USER'])){
//     if($_SESSION['LOGGED_USER'] != $article['author']){
//         $_SESSION['ERROR']="non";
//     }
// }

if(isset($_SESSION['LOGGED_USER'])){
    if($_SESSION['LOGGED_USER'] != $article['author']){
        $_SESSION['ERRORU']="Vous ne pouvez pas modifier l'article";

        header('Location:home.php?article_id=' . $getData['article_id']);
    }
}

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
    <h5>Modifier l'article <?php echo $article['title']; ?></h5><br>
    

    <div class="card w-75 mb-3">
        <div class="card-body">
            <form action="post_update_article.php" method="post">
                <label for="category" class="form-label">Catégories</label>
                <input type="hidden" name="article_id" value="<?php echo $getData['article_id'] ?>">
                <select class="form-select form-select-sm-3" aria-label="Small select example" id="category_id" name="category_id">
                    <option selected><?php echo $cat['name'];?></option>
                        <?php foreach($categories as $c) : ?>
                            <option value="<?php echo $c['category_id'];?>"><?php echo $c['name'];?></option>
                        <?php endforeach; ?>
                    </option>
                </select><br>
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="title" class="form-control" id="title" placeholder="Un titre pertinent" name="title" value="<?php echo $article['title']?>">
                </div><br>
                <div class="mb-3">
                    <label for="content_one" class="form-label">Première article</label>
                    <textarea class="form-control" id="content_one" rows="5" placeholder="Exprimez-vous..." name="content_one"><?php echo $article['content_one'];?></textarea>
                </div><br>
                <div class="mb-3">
                    <label for="content_two" class="form-label">Deuxième article</label>
                    <textarea class="form-control" id="content_two" rows="5" placeholder="facultatif" name="content_two"><?php echo $article['content_two']?></textarea>
                </div><br>
                <div class="mb-3">
                    <label for="content_three" class="form-label">Troisième article</label>
                    <textarea class="form-control" id="content_three" rows="5" placeholder="facultatif" name="content_three"><?php echo $article['content_three'];?></textarea>
                </div>
                <div class="mb-3">
                    <label for="update_at" class="form-label">Troisième article</label>
                    <input type="hidden" name="update_at">
                </div>

                        <button type="submit" class="btn btn-primary" style="width:150px!important; margin-bottom:12px; margin-left:12px" name="formArticle">Enregistrer</button>

            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>