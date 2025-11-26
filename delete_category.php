<!-- <?php 

session_start();

require_once(__DIR__ . '/config/mysql.php');

$getData=$_GET;

$stmt=$pdo->prepare('DELETE FROM categories WHERE category_id=:id');
$stmt->execute([
    'id'=>$getData['category_id'],
]);

header('Location: create_category.php');
exit;


?> -->