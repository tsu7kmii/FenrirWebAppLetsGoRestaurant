<!DOCTYPE html>
<html lang="ja">
<?php $title = "Let's Go Restaurant - 検索画面"; ?>
<?php include_once(__DIR__.'/template/header.php'); ?>
<body>
    <?php include_once(__DIR__.'/template/nav.html'); ?>
    <script src="./js/search.js"></script>
    <h1>Let's Go Restaurant</h1>

    <h2>検索条件を設定する</h2>
    <form id="searchForm" action="../controllers/search.php" method="post" >
        <label for="radius">検索範囲を選択してください(半径):</label>
        <select id="radius" name="radius">
            <option value="" disabled selected>設定されていません</option>
            <option value="500">0.5 km</option>
            <option value="1">1 km</option>
            <option value="2">2 km</option>
            <option value="3">3 km</option>
            <option value="4">4 km</option>
            <option value="5">5 km</option>
        </select>
        <br><br>

        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        <button type="submit" onclick="handleFormSubmit(event)">現在地を取得して検索する</button>
    </form>

    <?php include_once(__DIR__ .'/template/footer.html'); ?>
</body>
</html>