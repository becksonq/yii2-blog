<?php


namespace becksonq\blog;

/**
 * Class BlogAssetBundle
 * @package becksonq\blog
 */
class BlogAssetBundle extends \yii\web\AssetBundle
{
    public $sourcePath = '@vendor/becksonq/yii2-blog/src/assets';

    public $css = [
        'lightgallery.js/dist/css/lightgallery.min.css'
    ];

    public $js = [
        'smooth-scroll/dist/smooth-scroll.polyfills.min.js',
        'lightgallery.js/dist/js/lightgallery.min.js',
        'lg-fullscreen.js/dist/lg-fullscreen.min.js',
        'lg-zoom.js/dist/lg-zoom.min.js',
    ];
}