<?php


namespace becksonq\blog\utilities;


use becksonq\blog\models\post\PostReadRepository;
use Yii;
use yii\base\BaseObject;
use yii\caching\TagDependency;
use yii\web\UrlNormalizerRedirectException;

/**
 * Class BlogPostUrlRule
 * @package becksonq\blog\utilities
 */
class BlogPostUrlRule extends BaseObject implements \yii\web\UrlRuleInterface
{
    public $prefix = 'blog/post/single-post';
    private $_postReadRepository;

    /**
     * BlogUrlRule constructor.
     * @param array $config
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->_postReadRepository = Yii::createObject(PostReadRepository::class);
    }

    /**
     * @inheritDoc
     */
    public function parseRequest($manager, $request)
    {
        if (preg_match('#^' . $this->prefix . '/(.*[a-z0-9_])$#is', $request->pathInfo, $matches)) {
            $path = $matches['1'];

            // Yii::$app->cache->flush();

            $params = Yii::$app->cache->getOrSet(['blogSinglePostRoute', 'path' => $path], function () use ($path) {
                if (!$model = $this->_postReadRepository->findBySlug($this->pathSlug($path))) {
                    return ['id' => null, 'path' => null];
                }
                return ['id' => $model->id, 'slug' => $model->slug];
            }, null, new TagDependency(['tags' => ['blogSinglePost']]));

            if (empty($params['id'])) {
                return false;
            }

            if ($path != $params['slug']) {
                throw new UrlNormalizerRedirectException(['blog/post/single-post', 'id' => $params['id']], 301);
            }

            return ['blog/post/single-post', ['id' => $params['id']]];
        }

        Yii::warning("Can't parse request", "BlogPostUrlRule");

        return false;
    }

    /**
     * @inheritDoc
     */
    public function createUrl($manager, $route, $params)
    {
        if ($route === 'blog/post/single-post' && !empty($params['id'])) {
            $id = $params['id'];

            // Yii::$app->cache->flush();

            $url = Yii::$app->cache->getOrSet(['blogSinglePostRoute', 'id' => $id], function () use ($id) {
                if (!$model = $this->_postReadRepository->findById($id)) {
                    return null;
                }
                return $model->slug;
            }, null, new TagDependency(['tags' => ['blogSinglePost']]));

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