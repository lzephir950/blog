<?php

session_start();

require_once(__DIR__ . '/config/mysql.php');



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
    <div class="card" style="width: 25rem;margin:auto;margin-top:250px">
        <div class="card-body">
            <h5 class="card-title" style="text-align:center;margin-top:10px;color:green">BIENVENU(e) <?php echo $_SESSION['NEW_USER'];?> !</h5><br>
            <p class="card-text" style="text-align:center">Vous êtes bien inscrit(e), vous pouvez dorénavant vous connecter.</p>
            <a href="index.php" class="card-link">Me connecter</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>