<?php 

session_start();
require_once(__DIR__ . '/config/mysql.php');

$postData=$_POST;

$username=$postData['username'] ?? '';
$password=$postData['password'] ?? '';

require_once(__DIR__ . '/config/models/users.php');


if(isset($postData['username']) && isset($postData['password'])){
    if(empty($postData['username'])){
        $_SESSION['ERROR_USERNAME']="*Veuillez remplir le champ";
    }

    if(empty($postData['password'])){
        $_SESSION['ERROR_PASSWORD']="*Veuillez remplir le champ";
    }

if(!empty($postData['username']) && !empty($postData['password'])){
        if($user){
            if($postData['username'] === $user['username'] && $postData['password'] == $user['password']){
                $_SESSION['LOGGED_USER']=$user['username'];
                $_SESSION['ID_USER']=$user['user_id'];

                header('Location: home.php');
                exit;
            }
        }else{
            $_SESSION['MESSAGE']=sprintf("Vos identifiants sont incorrect : %s\%s", $postData['username'], $postData['password']);

    }

}

}



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrâap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>


    <div class="card mb-3" style="width: 20rem; margin:auto;margin-top:200px">
        <div class="card-body">
            <img src="./img/logo blog.png" class="card-img-top" alt="...">
            <form action="index.php" method="post">
                <div class="mb-3">
                    <?php if(isset($_SESSION['MESSAGE'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['MESSAGE']; ?></div>
                    <?php unset($_SESSION['MESSAGE']);?>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['ERROR_USERNAME'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_USERNAME'];?></div>
                        <?php unset($_SESSION['ERROR_USERNAME']);?>
                    <?php endif; ?>
                    <label for="username" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_PASSWORD'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_PASSWORD'];?></div>
                        <?php unset($_SESSION['ERROR_PASSWORD']);?>
                    <?php endif; ?>
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div style="text-align:center;padding-top:10px;padding-bottom:10px">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                    <button type="submit" class="btn btn-primary"><a href="register.php" style="color:white; text-decoration:none">S'enregistrer</a></button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>