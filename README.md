Yii2 blog
=========
Yii2 blog for bootstrap4 createx theme

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


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \becksonq\blog\AutoloadExample::widget(); ?>
```


Migrations
----------


```
yii migrate/up --migrationPath=@vendor/becksonq/yii2-blog/migrations
```
