<?php


namespace becksonq\blog\utilities;


use becksonq\blog\models\tags\TagRepository;
use Yii;
use yii\caching\TagDependency;
use yii\web\UrlNormalizerRedirectException;

/**
 * Class BlogTagUrlRule
 * @package becksonq\blog\utilities
 */
class BlogTagUrlRule extends \yii\base\BaseObject implements \yii\web\UrlRuleInterface
{
    public $prefix = 'blog/post/tag';
    private $_tagRepository;

    /**
     * BlogTagUrlRule constructor.
     * @param array $config
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->_tagRepository = Yii::createObject(TagRepository::class);
    }

    /**
     * @inheritDoc
     */
    public function parseRequest($manager, $request)
    {
        if (preg_match('#^' . $this->prefix . '/(.*[a-z0-9_])$#is', $request->pathInfo, $matches)) {
            $path = $matches['1'];

            // Yii::$app->cache->flush();

            $params = Yii::$app->cache->getOrSet(['blogTagRoute', 'path' => $path], function () use ($path) {
                if (!$model = $this->_tagRepository->findBySlug($this->pathSlug($path))) {
                    return ['id' => null, 'path' => null];
                }
                return ['id' => $model->id, 'slug' => $model->slug];
            }, null, new TagDependency(['tags' => ['blogTags']]));

            if (empty($params['id'])) {
                return false;
            }

            if ($path != $params['slug']) {
                throw new UrlNormalizerRedirectException(['blog/post/tag', 'id' => $params['id']], 301);
            }

            return ['blog/post/tag', ['id' => $params['id']]];
        }

        Yii::warning("Can't parse request", "BlogTagUrlRule");

        return false;
    }

    /**
     * @inheritDoc
     */
    public function createUrl($manager, $route, $params)
    {
        if ($route === 'blog/post/tag' && !empty($params['id'])) {
            $id = $params['id'];

            // Yii::$app->cache->flush();

            $url = Yii::$app->cache->getOrSet(['blogTagRoute', 'id' => $id], function () use ($id) {
                if (!$model = $this->_tagRepository->findById($id)) {
                    return null;
                }
                return $model->slug;
            }, null, new TagDependency(['tags' => ['blogTags']]));

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