<?php 
session_start();
if (!isset($_SESSION['result_data'])){
    // 検索後でなければ検索ページにリダイレクトする
    header('Location: /views/search.php');
    exit();
}
$result_data = $_SESSION['result_data'];
var_dump($result_data);
?>

<!DOCTYPE html>
<html lang="ja">
<?php $title = "Let's Go Restaurant - 検索画面"; ?>

<?php include_once(__DIR__.'/template/header.php'); ?>
<body>
    <?php include_once(__DIR__.'/template/nav.html'); ?>
    <h1>Let's Go Restaurant</h1>

    <h2>検索結果</h2>

    







    <?php include_once(__DIR__ .'/template/footer.html'); ?>
</body>
</html>