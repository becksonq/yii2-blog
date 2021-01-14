<?php


namespace becksonq\blog;


/**
 * Class Bootstrap
 * @package becksonq\blog
 */
class Bootstrap implements \yii\base\BootstrapInterface
{

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        //Правила маршрутизации
        $app->getUrlManager()->addRules([
            'blog' => 'blog/post/index',
        ], false);
        /*
         * Регистрация модуля в приложении
         * (вместо указания в файле frontend/config/main.php
         */
        $app->setModule('blog', 'becksonq\blog\Module');
    }
}