<?php 
// .envファイルを読み込む
session_start();
require __DIR__.'/../vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

// 環境変数からAPIキーを取得
$recruit_api_key = $_ENV['RECRUIT_API_KEY'];


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // データを取得する
    $radius = $_POST['radius'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Hot Pepper APIのエンドポイント
    $url = "https://webservice.recruit.co.jp/hotpepper/gourmet/v1/";
    $params = [
        'key' => $recruit_api_key,
        'lat' => $latitude,
        'lng' => $longitude,
        'range' => $radius,
        'format' => 'json',
        'count' => 100,
    ];

    // パラメータをクエリ文字列に変換
    $query = http_build_query($params);
    $request_url = $url . "?" . $query;

    // APIリクエストを実行
    $response = file_get_contents($request_url);
    if ($response === FALSE) {
        header('Location: /views/template/error.php?error=api_response');
        exit();
    }

    // JSONレスポンスをデコードしセッションに保存
    $_SESSION['result_data'] = json_decode($response, true);

    // リダイレクト
    header('Location: /views/search_result.php');
    exit();
}
?>