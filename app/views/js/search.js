function handleFormSubmit(event) {

    event.preventDefault(); // フォームのデフォルト送信を防ぐ

    // 選択されているオプションの値を取得
    var radius = document.getElementById("radius").value;
    if (radius === "") {
        alert("検索範囲を選択してください。");
        return;
    }

    getLocationAndSubmit();

}


function getLocationAndSubmit() {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(function(position) {

            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
            document.getElementById("searchForm").submit(); // 現在地取得後にフォームを送信
        
        }, showError);

    } else { 

        document.getElementById("location").innerHTML = "Geolocationはこのブラウザでサポートされていません。";
    }
}


function showError(error) {

    switch(error.code) {

        case error.PERMISSION_DENIED:

            document.getElementById("location").innerHTML = "ユーザーが位置情報の取得を拒否しました。"
            break;

        case error.POSITION_UNAVAILABLE:

            document.getElementById("location").innerHTML = "位置情報が利用できません。"
            break;

        case error.TIMEOUT:

            document.getElementById("location").innerHTML = "位置情報の取得がタイムアウトしました。"
            break;

        case error.UNKNOWN_ERROR:

            document.getElementById("location").innerHTML = "不明なエラーが発生しました。"
            break;
    }
}