<!DOCTYPE html>
<html lang="ja">
<?php $title = "Let's Go Restaurant - 検索画面"; ?>
<?php include_once(__DIR__.'/template/header.php'); ?>
<body class="p-3 mb-2 bg-body-secondary">
    <?php include_once(__DIR__.'/template/nav.html'); ?>
    <script src="./js/search.js"></script>
    <h1 class="display-2">
        <span style="color: red;">L</span>et's <span style="color: red;">G</span>o <span style="color: red;">R</span>estaurant
    </h1>
    <hr><hr>

    <h2 class="display-4">検索条件を設定する</h2>
    <form id="searchForm" action="../controllers/search.php" method="post" >
        <label for="radius">検索範囲を選択してください(半径):</label>
        <select id="radius" name="radius" class="form-select" style="width: auto;display: inline-block;">
            <option value="" disabled selected>設定されていません</option>
            <option value="1">300 m以内</option>
            <option value="2">500 m</option>
            <option value="3">1000 m</option>
            <option value="4">2000 m</option>
            <option value="5">3000 m</option>
        </select>
        <br><br>

        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        <button type="submit" onclick="handleFormSubmit(event)" class="btn btn-outline-primary">現在地を取得して検索する</button>
    </form>

    <?php include_once(__DIR__ .'/template/footer.html'); ?>
</body>
</html>