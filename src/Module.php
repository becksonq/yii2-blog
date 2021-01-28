<?php

namespace becksonq\blog;

use yii\web\NotFoundHttpException;

/**
 * blog module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'becksonq\blog\controllers';

    /** @var string The database connection to use for models in this module. */
    public $dbConnection = 'db';

    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'blog';

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        '<action:(index)>' => 'post/<action>',
        '<action:\w+>/<id:\d+>' => 'post/<action>',
//        'post/<action:\w+>' => 'crud/post/<action>',
//        'post/<action:\w+>/<id:\d+>' => 'crud/post/<action>',
//        'post/view/<id:\d+>' => 'crud/post/view',
//        'post/<action:\w+>/<id:\d+>/<imageId:\d+>' => 'crud/post/<action>',
    ];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if ($this->layout === null) {
            throw new NotFoundHttpException('Not found blog layout');
        }

        $this->modules = [
            'sidebar_banner' => [
                // здесь имеет смысл использовать более лаконичное пространство имен
                'class' => 'becksonq\blog\modules\sidebar_banner\SidebarBannerModule',
            ],
        ];
    }
}
