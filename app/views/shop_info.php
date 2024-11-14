<?php 
session_start();
if (!isset($_POST['shop_info'])){
    // 検索後でなければ検索ページにリダイレクトする
    header('Location: /views/search.php');
    exit();
}
// 検索に基づく検索結果をセッションから取得
$shop_info = $_POST['shop_info'];
$current_page = $_POST['current_page'];
// JSONデータをデコード
$shop_data = json_decode($shop_info, true);
?>

<!DOCTYPE html>
<html lang="ja">
<?php $title = "Let's Go Restaurant - 検索画面"; ?>

<?php include_once(__DIR__.'/template/header.php'); ?>
<body>
    <?php include_once(__DIR__.'/template/nav.html'); ?>
    <br>
    <a href="./search.php">検索ページに戻る</a><br>
    <a href="./search_result.php?page=<?php echo htmlspecialchars($current_page, ENT_QUOTES, 'UTF-8'); ?>">一覧ページに戻る</a>
    
    <h1>Let's Go Restaurant</h1>

    <h2>店舗名：<?php echo htmlspecialchars($shop_data['name'], ENT_QUOTES, 'UTF-8'); ?></h2>

    <!-- 店舗情報表示 -->
    <div>
        <img src="<?php echo htmlspecialchars($shop_data['photo']['pc']['l'], ENT_QUOTES, 'UTF-8'); ?>" alt="店舗画像" width="400">
        <p><strong>住所:</strong> <?php echo htmlspecialchars($shop_data['address'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>最寄り駅:</strong> <?php echo htmlspecialchars($shop_data['station_name'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>営業時間:</strong> <?php echo htmlspecialchars($shop_data['open'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>ジャンル:</strong> <?php echo htmlspecialchars($shop_data['genre']['name'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>紹介:</strong> <?php echo htmlspecialchars($shop_data['genre']['catch'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>予算:</strong> <?php echo htmlspecialchars($shop_data['budget']['average'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>アクセス:</strong> <?php echo htmlspecialchars($shop_data['access'], ENT_QUOTES, 'UTF-8'); ?></p>
    </div>

    <br><br>

    <!-- 店舗へのリンク -->
    <h3>各種リンク</h3>
    <div>
        <a href="<?php echo htmlspecialchars($shop_data['urls']['pc'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank">店舗ページ</a>
    </div>

    <!-- クーポンリンク -->
    <div>
        <a href="<?php echo htmlspecialchars($shop_data['coupon_urls']['pc'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank">クーポンを見る</a>
    </div>

    <!-- Googleマップの埋め込みリンク -->
    <div>
        <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($shop_data['address']); ?>" target="_blank">Googleマップで表示</a>
    </div>


    <?php include_once(__DIR__ .'/template/footer.html'); ?>
</body>
</html>