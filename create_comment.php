<?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');

$getData=$_GET;
$postData=$_POST;
$id=$_SESSION['ID_USER'];




if(isset($postData['formComment'])){
    $valid=true;

    $idUser=$postData['user_id'];
    $idArticle=$postData['article_id'];
    $comment=$postData['comment'];
    
    $tableau=[$idUser,$idArticle,$comment];


        if(empty($comment)){
            $valid=false;
            $_SESSION['ERROR_COMMENT']="Veuillez remplir le champ";
        }
    
    
    
    if($valid){
        $stmt=$pdo->prepare('INSERT INTO comments(user_id, article_id, comment) VALUES (?,?,?)');
        $stmt->execute($tableau);

        header('Location: read_article.php?article_id=' . $idArticle);
        exit;
        die('ok');

        
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

       <?php require_once(__DIR__ . '/header.php')?>


       <div class="card mb-3" style="width: 20rem; margin:auto;margin-top:200px">
        <div class="card-body">
            <form action="create_comment.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label"><?php echo $_SESSION['LOGGED_USER']; ?></label><br>
                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $_SESSION['ID_USER'];; ?>">
                    <input type="hidden" id="article_id" name="article_id" value="<?php echo $getData['article_id']; ?>">
                    
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Commentaire</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"><?php ?></textarea>
                    <?php if(isset($_SESSION['ERROR_COMMENT'])) : ?>
                        <div style="color:red; font-size:12px">*<?php echo $_SESSION['ERROR_COMMENT'] ; ?></div>
                        <?php unset($_SESSION['ERROR_COMMENT']) ; ?>
                    <?php endif; ?>
                </div>
                <div style="text-align:center;padding-top:10px;padding-bottom:10px">
                    <button type="submit" class="btn btn-primary" name="formComment">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>