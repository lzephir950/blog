<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');

$postData=$_POST;

// pour afficher le tableau des catégorie
$stmt=$pdo->prepare('SELECT name, category_id FROM categories');
$stmt->execute();
$categories=$stmt->fetchAll();




if(isset($postData['formArticle'])){

    $valid=true;

    $cat=$postData['category'];
    $title=$postData['title'];
    $contentOne=$postData['content_one'];
    $contentTwo=$postData['content_two'];
    $contentThree=$postData['content_three'];
    $author=$_SESSION['LOGGED_USER'];

    $tableau=[$cat,$title,$contentOne,$contentTwo,$contentThree,$author];
    

    if(isset($postData['category'])){
        if(empty($cat)){
            $valid=false;
            $_SESSION['ERROR_CAT']="*Vous devez choisir une catégorie";
        }
    }

    if(isset($postData['title'])){
        
        if(empty($title)){
            $valid=false;
            $_SESSION['ERROR_TITLE']="*Veuillez remplir le champ";
        }
    }

    if(isset($postData['content_one'])){
        if(empty($contentOne)){
            
            $valid=false;
            $_SESSION['ERROR_CONTENTONE']="*Veuillez remplir le champ";
        }
    }

    if($valid){
        $stmt=$pdo->prepare('INSERT INTO articles(category_id,title,content_one,content_two,content_three,author) VALUES(?,?,?,?,?,?)');
        $stmt->execute($tableau);
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
    <h5>Créez votre blog !</h5><br>
    <div class="card w-75 mb-3">
        <div class="card-body">
            <form action="create_article.php" method="post">
                <!-- verifier champ rempli ou non -->
                <?php if(isset($_SESSION['ERROR_CAT'])) : ?>
                    <div style="color:red"><?php echo $_SESSION['ERROR_CAT']; ?></div>
                    <?php unset($_SESSION['ERROR_CAT']);?>
                <?php endif; ?>
                <!-- fin verification -->
                <label for="category" class="form-label">Catégories</label>
                <select class="form-select form-select-sm-3" aria-label="Small select example" id="category" name="category">
                    <option value="" selected>Choisissez une catégorie</option>
                        <?php foreach($categories as $c) : ?>
                            <option value="<?php echo $c['category_id'];?>"><?php echo $c['name']; ?>
                        <?php endforeach; ?>

                    </option>
                </select>
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_TITLE'])) : ?>
                        <div style="color:red"><?php echo $_SESSION['ERROR_TITLE']; ?></div>
                        <?php unset($_SESSION['ERROR_TITLE']);?>
                    <?php endif; ?>
                    <label for="title" class="form-label">Titre</label>
                    <input type="title" class="form-control" id="title" placeholder="Un titre pertinent" name="title">
                </div><br>
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_CONTENTONE'])):?>
                        <div style="color:red"><?php echo $_SESSION['ERROR_CONTENTONE'];?></div>
                        <?php unset($_SESSION['ERROR_CONTENTONE']);?>
                    <?php endif; ?>
                    <label for="content_one" class="form-label">Première article</label>
                    <textarea class="form-control" id="content_one" rows="5" placeholder="Exprimez-vous..." name="content_one"></textarea>
                </div><br>
                <div class="mb-3">
                    <label for="content_two" class="form-label">Deuxième article</label>
                    <textarea class="form-control" id="content_two" rows="5" placeholder="facultatif" name="content_two"></textarea>
                </div><br>
                <div class="mb-3">
                    <label for="content_three" class="form-label">Troisième article</label>
                    <textarea class="form-control" id="content_three" rows="5" placeholder="facultatif" name="content_three"></textarea>
                </div>

                        <button type="submit" class="btn btn-primary" style="width:150px!important; margin-bottom:12px; margin-left:12px" name="formArticle">Enregistrer</button>

            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>