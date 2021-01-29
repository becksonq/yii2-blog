Yii2 blog
=========
Yii2 blog for bootstrap4 <strong>createx</strong> theme

###Warning!
This project is for 2myshop.ru site only. Don't try to install it in your project.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist becksonq/yii2-blog "*"
```

or add

```
"becksonq/yii2-blog": "*"
```

to the require section of your `composer.json` file.

In common/config/main.php

```
'modules' => [
...
    'blog' => [
        'class'  => 'becksonq\blog\Module',
        'layout' => '@frontend/themes/createx_grocery_store/views/layouts/main_fs',
        'assets'  => '@frontend/themes/createx_grocery_store/web',
    ],
...
],
```


Usage
-----


Migrations
----------


```
yii migrate/up --migrationPath=@becksonq/blog/migrations
```
