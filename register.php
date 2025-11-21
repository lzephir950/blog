<?php 

require_once(__DIR__ . '/config/mysql.php');

$postData=$_POST;

if(isset($postData['formRegister'])){
    $valid=true;

    $firstName=htmlentities($postData['first_name']);
    $name=htmlentities($postData['name']);
    $email=htmlentities($postData['email']);
    $username=htmlentities($postData['username']);
    $password=htmlentities(trim($postData['password']));
    $confPass=htmlentities(trim($postData['confpass']));

    $tableau=[$firstName,$name,$email,$username,$password,$confPass];

    if(empty($firstName)){
        $valid=false;
        $_SESSION['ERROR_FIRSTNAME']="*Le champ est vide, veuillez le remplir";
    }

    if(empty($name)){
        $valid=false;
        $_SESSION['ERROR_NAME']="*Le champ est vide, veuillez le remplir";
    }

    if(empty($email)){
        $valid=false;
        $_SESSION['ERROR_EMAIL']="*Le champ est vide, veuillez le remplir";
    }else{
        $stmt=$pdo->prepare('SELECT email FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $verif=$stmt->fetch();

        if($verif){
            $_SESSION['ERROR_VERIF_EMAIL']="*L'email existe déjà";
        }
    }

        if(empty($username)){
            $_SESSION['ERROR_USERNAME']="*Le champ est vide, veuillez le remplir";
        }else{
            $stmt=$pdo->prepare('SELECT username FROM users WHERE username=?');
            $stmt->execute([$username]);
            $verif=$stmt->fetch();

            if($verif){
                $valid=false;
                $_SESSION['ERROR_VERIF']="*Le pseudo est déjà utilisé";
            }

        }
    }

    if(empty($password)){
        $valid=false;
        $_SESSION['ERROR_PASSWORD']="*Le champ est vide, veuillez le remplir";
    }else{
        $nbMinLong=8;
        $nbMaxLong=20;
        $nbLongPassword=strlen($password);

        if($nbLongPassword < $nbMinLong){
            $valid=false;
            $_SESSION['ERROR_MIN']="*Mot de passe trop court";
        }
        
        if($nbLongPassword > $nbMaxLong){
            $valid=false;
            $_SESSION['ERROR_MAX']="*Mot de passe trop long";
        }
    }

    if(empty($confPass)){
        $valid=false;
        $_SESSION['ERROR_CONFPASS']="*Le champ est vide, veuillez le remplir";
    }else{

        if($confPass != $password){
            $valid=false;
            $_SESSION['ERROR_VERIFPASS']="Le mot de passe ne correspond pas";
        }
    }
    
    if($valid){
        $stmt=$pdo->prepare('INSERT INTO users(first_name, name, email, username, password, confpass) VALUES (?,?,?,?,?,?)');
        $stmt->execute($tableau);
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
    <div class="card w-75 mb-3" style="margin:auto; margin-top:110px; width:450px!important">
        <div class="card-body">
            <form action="register.php" method="post">
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_FIRSTNAME'])):?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_FIRSTNAME']; ?></div>
                        <?php unset($_SESSION['ERROR_FIRSTNAME']); ?>
                    <?php endif; ?>
                    <label for="first_name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_NAME'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_NAME'];?></div>
                        <?php unset($_SESSION['ERROR_NAME']); ?>
                    <?php endif; ?>
                    <label for="name" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_EMAIL'])): ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_EMAIL'];?></div>
                        <?php unset($_SESSION['ERROR_EMAIL']);?>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['ERROR_VERIF_EMAIL'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_VERIF_EMAIL'];?></div>
                        <?php unset($_SESSION['ERROR_VERIF_EMAIL']);?>
                    <?php endif; ?>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_USERNAME'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_USERNAME'];?></div>
                        <?php unset($_SESSION['ERROR_USER']);?>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['ERROR_VERIF'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_VERIF']; ?></div>
                        <?php unset($_SESSION['ERROR_VERIF']);?>
                    <?php endif; ?>
                    <label for="username" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_PASSWORD'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_PASSWORD'];?></div>
                        <?php unset($_SESSION['ERROR_PASSWORD']);?>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['ERROR_MIN'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_MIN']; ?></div>
                        <?php unset($_SESSION['ERROR_MIN']);?>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['ERROR_MAX'])) : ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_MAX'];?></div>
                        <?php unset($_SESSION['ERROR_MAX']);?>
                    <?php endif; ?>
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <?php if(isset($_SESSION['ERROR_CONFPASS'])):?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_CONFPASS']; ?></div>
                        <?php unset($_SESSION['ERROR_VERIF']);?>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['ERROR_VERIFPASS'])): ?>
                        <div style="color:red; font-size:12px"><?php echo $_SESSION['ERROR_VERIFPASS'];?></div>
                        <?php unset($_SESSION['ERROR_VERIFPASS']);?>
                    <?php endif; ?>
                    <label for="confpass" class="form-label">Confirmer votre mot de passe</label>
                    <input type="password" class="form-control" id="password" name="confpass">
                </div>
                <button type="submit" class="btn btn-primary" name="formRegister">S'enregistrer</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>