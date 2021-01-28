<?php


namespace becksonq\blog;

use Yii;
use yii\base\Application;

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
        /** @var Module $module */
        if ($app->hasModule('blog') && ($module = $app->getModule('blog')) instanceof Module) {

            $configUrlRule = [
                'prefix' => $module->urlPrefix,
                'rules'  => $module->urlRules,
            ];

            if ($module->urlPrefix != 'blog') {
                $configUrlRule['routePrefix'] = 'blog';
            }

            $configUrlRule['class'] = 'yii\web\GroupUrlRule';
            $rule = Yii::createObject($configUrlRule);

            $app->urlManager->addRules([$rule], false);
        }
    }
}