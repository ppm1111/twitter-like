#安裝步驟

```bash
composer install
cp .env.example .env
php artisan jwt:secret
php artisan migrate:refresh --seed
```

#文件資料夾
apiDoc

#class diagram 位置
apiDoc/twitter_like_class.drawio.png

#er diagram 位置
apiDoc/twitter_like_er_diagram.drawio.png

#Api blueprint 檔案
apiDoc/api_doc.apib

api 文件位置
apiDoc/output.html

#文件產生指令

安裝
```base
npm i -g aglio
```

產生
```base
aglio -i api_doc.apib -o output.html
```