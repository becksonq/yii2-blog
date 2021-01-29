<?php


namespace becksonq\blog;

/**
 * Подключение внешнего ресурса. Путь передается в настройках модуля common/config/main.php
 *
 * Class AppAsset
 * @package becksonq\blog
 */
class AppAsset extends \yii\web\AssetBundle
{
    public function init()
    {
        parent::init();
        $module = Module::getInstance();
        $this->sourcePath = $module->assets;
    }
}