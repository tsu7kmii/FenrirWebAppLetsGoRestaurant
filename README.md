## [簡易仕様書はこちら](./SpecDoc.md)

## API_KEYについて
`./app/.env`にて`RECRUIT_API_KEY`にて配置


## 環境変数 vendor関係のお願い
dockerfile内で`composer install`を含む方法が実装できなかったので、実行願います

## アクセス
1. `docker-compose up -d`
1. `composer install`
1. `./app/.env`に`RECRUIT_API_KEY`で配置
1. `localhost:80`にアクセスして下さい
