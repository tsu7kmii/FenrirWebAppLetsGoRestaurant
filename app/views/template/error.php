<?php

class CustomError
{
    // 共通のback_linkとback_textを定数として定義
    const SEARCH_LINK = "/views/search.php";
    const SEARCH_TEXT = "検索画面に戻る";




    private $error_types = [
        // 共通のエラーハンドリング
        // 無効なリクエスト時のエラー
        'api_response' => [
            'title' => "APIのリクエストに\n失敗しました。",
            'message' => "再度検索してください。",
            'back_link' => self::SEARCH_LINK,
            'back_text' => self::SEARCH_TEXT
        ]

    ];




    private $error_info = null;
    public function __construct()
    {
        $this->setErrorInfo();
    }


    private function setErrorInfo()
    {
        // GETパラメータからエラーコードを取得、存在しない場合は空文字列に設定
        // 取得したエラーコードに基づいてエラー情報を設定、見つからない場合はnullを設定する
        $error_code = $_GET['error'] ?? '';                          
        $this->error_info = $this->error_types[$error_code] ?? null;
    }


    public function displayErrorPage()
    {
        if ($this->error_info) {
            // nullでは無い場合、エラーページに表示する情報を設定
            $this->displayError();
        } else {
            // nullの場合、エラー文を表示
            echo "エラーハンドリングが正しく設定されていません。";
            exit;
        }
    }


    private function displayError()
    {
        $error_title = nl2br(htmlspecialchars($this->error_info['title'], ENT_QUOTES, 'UTF-8'));
        $error_message = nl2br(htmlspecialchars($this->error_info['message'], ENT_QUOTES, 'UTF-8'));
        $back_link = htmlspecialchars($this->error_info['back_link'], ENT_QUOTES, 'UTF-8');
        $back_text = htmlspecialchars($this->error_info['back_text'], ENT_QUOTES, 'UTF-8');
        ?>

        <!DOCTYPE html>
        <html lang="ja">
        <?php $title = "Let's Go Restaurant - エラー"; ?>
        <?php include_once('./header.php'); ?>

        <body>

            <div>

                <main>

                    <section>

                        <h2><?php echo $error_title; ?></h2>

                        <p><?php echo $error_message; ?></p>

                        <div>
                            <a href="<?php echo $back_link; ?>"><?php echo $back_text; ?></a>
                        </div>

                    </section>

                </main>

            </div>

        </body>

        </html>
    <?php
    }
}

$error_page = new CustomError();
$error_page->displayErrorPage();
?>