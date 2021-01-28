<?php


namespace becksonq\blog\widgets\trending_posts;


use becksonq\blog\models\post\PostReadRepository;
use yii\base\Widget;

/**
 * Class TrendingPostsWidget
 * @package blog\widgets\trending_posts
 *
 * Usage
 * ------------------------------------
 * <?= \becksonq\blog\widgets\trending_posts\TrendingPostsWidget::widget([]) ?>
 */
class TrendingPostsWidget extends Widget
{
    const POPULAR_LIMIT = 3;

    private $_posts;

    /**
     * TrendingPostsWidget constructor.
     * @param PostReadRepository $posts
     * @param array $config
     */
    public function __construct(PostReadRepository $posts, $config = [])
    {
        parent::__construct($config);
        $this->_posts = $posts;
    }

    /**
     * @return string|void
     */
    public function run()
    {
        return $this->render('index', [
            'posts' => $this->_posts->getPopular(self::POPULAR_LIMIT),
        ]);
    }
}