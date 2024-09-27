**## 短链生成**

**注意：本仓库中含有ai生成代码，请谨慎使用**

目前暂无前端，仅可以通过URL使用


将仓库中文件放置在站点下，并将数据库文件导入到数据库

修改mysql.php中数据库账号密码


**生成短链**

example.com/dl?url=目标；链接

**打开短链**

example.com/短链

**伪静态**

```
location / {
    try_files $uri $uri/ @rewrite;
}

location @rewrite {
    rewrite ^/(.*)$ /2.php?path=$1 last;
}

```



