<?php

session_start();

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/function.php');

$postData=$_POST;

if(isset($postData['formCategory'])){

    $valid=true;

    $name=$postData['name'];

    if(empty($name)){
        $valid=false;
        $_SESSION['ERROR_NAME']="*Veuillez remplir le champ";
    }else{
        $stmt=$pdo->prepare('SELECT name FROM categories WHERE name = ?');
        $stmt->execute([$name]);
        $verif=$stmt->fetch();

        if($verif){
            $valid=false;
            $_SESSION['ERROR_VERIF']="*Le nom existe déjà";
        }
    }
    
    if($valid){

        
        $stmt=$pdo->prepare("INSERT INTO categories(name) VALUES (?)");
        $stmt->execute([$name]);


        
    }

}

$stmt=$pdo->prepare('SELECT name, category_id FROM categories');
$stmt->execute();
$categories=$stmt->fetchAll();

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
    <h1>Ajouter une catégorie</h1><br>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <form action="create_category" method="post">
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_NAME'])) : ?>
                        <div style="color:red;font-size:12px"><?php echo $_SESSION['ERROR_NAME'];?></div>
                        <?php unset($_SESSION['ERROR_NAME']);?>
                    <?php endif;?>
                    <?php if(isset($_SESSION['ERROR_VERIF'])) :?>
                        <div style="color:red;font-size:12px"><?php echo $_SESSION['ERROR_VERIF']; ?></div>
                        <?php unset($_SESSION['ERROR_VERIF']); ?>
                    <?php endif; ?>
                    <label for="name" class="form-label">Nom de la catégorie</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <!-- <input type="hidden" name="category_id"> -->
                </div>
                <button type="submit" class="btn btn-primary" name="formCategory">Enregistrer</button>
            </form>
        </div>
    </div><br>
    
    <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
            <?php foreach($categories as $c) : ?>
            <li class="list-group-item"><?php echo $c['name'];?>
            <?php endforeach;?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>