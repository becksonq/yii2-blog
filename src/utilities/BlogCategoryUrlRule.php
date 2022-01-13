<?php


namespace becksonq\blog\utilities;


use becksonq\blog\models\category\CategoryReadRepository;
use Yii;
use yii\caching\TagDependency;
use yii\web\UrlNormalizerRedirectException;

/**
 * Class BlogCategoryUrlRule
 * @package becksonq\blog\utilities
 */
class BlogCategoryUrlRule extends \yii\base\BaseObject implements \yii\web\UrlRuleInterface
{
    public $prefix = 'blog/post/category';
    private $_categoryReadRepository;

    /**
     * BlogTagUrlRule constructor.
     * @param array $config
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->_categoryReadRepository = Yii::createObject(CategoryReadRepository::class);
    }

    /**
     * @inheritDoc
     */
    public function parseRequest($manager, $request)
    {
        if (preg_match('#^' . $this->prefix . '/(.*[a-z0-9_])$#is', $request->pathInfo, $matches)) {
            $path = $matches['1'];

            // Yii::$app->cache->flush();

            $params = Yii::$app->cache->getOrSet(['blogCategoryRoute', 'path' => $path], function () use ($path) {
                if (!$model = $this->_categoryReadRepository->findBySlug($this->pathSlug($path))) {
                    return ['id' => null, 'path' => null];
                }
                return ['id' => $model->id, 'slug' => $model->slug];
            }, null, new TagDependency(['tags' => ['blogCategory']]));

            if (empty($params['id'])) {
                return false;
            }

            if ($path != $params['slug']) {
                throw new UrlNormalizerRedirectException([$this->prefix, 'id' => $params['id']], 301);
            }

            return [$this->prefix, ['id' => $params['id']]];
        }

        Yii::warning("Can't parse request", "BlogCategoryUrlRule");

        return false;
    }

    /**
     * @inheritDoc
     */
    public function createUrl($manager, $route, $params)
    {
        if ($route === $this->prefix && !empty($params['id'])) {
            $id = $params['id'];

            // Yii::$app->cache->flush();

            $url = Yii::$app->cache->getOrSet(['blogCategoryRoute', 'id' => $id], function () use ($id) {
                if (!$model = $this->_categoryReadRepository->find($id)) {
                    return null;
                }
                return $model->slug;
            }, null, new TagDependency(['tags' => ['blogCategory']]));

            if (!$url) {
                throw new \InvalidArgumentException('Undefined url.');
            }

            $url = $this->prefix . '/' . $url;
            unset($params['id']);
            if (!empty($params) && ($query = http_build_query($params)) !== '') {
                $url .= '?' . $query;
            }
            return $url;
        }
        return false;
    }

    /**
     * @param string $path
     * @return string
     */
    public function pathSlug(string $path): string
    {
        $chunks = explode('/', $path);
        return end($chunks);
    }
}