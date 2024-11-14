<?php 
session_start();
if (!isset($_SESSION['result_data'])){
    // 検索後でなければ検索ページにリダイレクトする
    header('Location: /views/search.php');
    exit();
}
// 検索に基づく検索結果をセッションから取得
$result_data = $_SESSION['result_data'];

// ページング用の変数を設定
$count = 10; // 1ページあたりの表示件数
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $count + 1;

// 検索結果から店舗情報を取得
$shops = $result_data['results']['shop'] ?? [];
$total_count = $result_data['results']['results_available'] ?? 0; // 総店舗数
$total_pages = ceil($total_count / $count); // 総ページ数
?>

<!DOCTYPE html>
<html lang="ja">
<?php $title = "Let's Go Restaurant - 検索画面"; ?>

<?php include_once(__DIR__.'/template/header.php'); ?>
<body class="p-3 mb-2 bg-body-secondary">
    <?php include_once(__DIR__.'/template/nav.html'); ?>
    <hr>
    <h1 class="display-2">
        <span style="color: red;">L</span>et's <span style="color: red;">G</span>o <span style="color: red;">R</span>estaurant
    </h1>
    <hr><hr>

    <h2 class="display-4">検索結果</h2>
    <br>
    <?php if (empty($shops)): ?>

        <h3>レストラン情報が見つかりませんでした。</h3>
        <a href="./search.php">検索しなおす</a>
    <?php else: ?>
        <table class="table table-secondary table-striped" style="width: auto;">
            <thead>
                <tr>
                    <th>店舗名</th>
                    <th>ジャンル</th>
                    <th>アクセス</th>
                    <th>サムネイル</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($shops as $shop): ?>
                    <tr>
                        <td>
                            <!-- 店舗名の表示 -->
                            <?php echo htmlspecialchars($shop['name'], ENT_QUOTES, 'UTF-8'); ?>

                            <br>
                            <!-- 同セル内に詳細ページ遷移用ボタン設置 -->
                            <form action="shop_info.php" method="post">
                                <input type="hidden" name="shop_info" value="<?php echo htmlspecialchars(json_encode($shop), ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="current_page" value="<?php echo $page; ?>">
                                <button type="submit" class="btn btn-outline-primary">詳細を見る</button>
                            </form>
                        </td>
                        <td>
                            <!-- ジャンルの表示 -->
                            <?php echo htmlspecialchars($shop['genre']['name'], ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <!-- アクセスの表示 -->
                            <?php echo htmlspecialchars($shop['access'], ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                        <td>
                            <!-- サムネイル画像の表示 -->
                            <?php if (!empty($shop['photo']['mobile']['l'])): ?>
                                <img src="<?php echo htmlspecialchars($shop['photo']['mobile']['l'], ENT_QUOTES, 'UTF-8'); ?>" alt="サムネイル" width="100">
                            <?php else: ?>
                                画像なし
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- ページング -->
        <div>
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">前のページ</a>
            <?php endif; ?>

            <span>ページ <?php echo $page; ?> / <?php echo $total_pages; ?></span>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>">次のページ</a>
            <?php endif; ?>
        </div>

    <?php endif; ?>

    <?php include_once(__DIR__ .'/template/footer.html'); ?>
</body>
</html>