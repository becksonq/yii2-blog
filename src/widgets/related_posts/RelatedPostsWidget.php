<?php


namespace becksonq\blog\widgets\related_posts;


use becksonq\blog\models\post\PostReadRepository;

/**
 * Виджет для показа популярных постов внизу страницы просмотра поста
 *
 * Class RelatedPostsWidget
 * @package becksonq\blog\widgets\related_posts
 *
 * <?= \becksonq\blog\widgets\related_posts\RelatedPostsWidget::widget([]) ?>
 */
class RelatedPostsWidget extends \yii\base\Widget
{
    const POPULAR_LIMIT = 6;

    private $_posts;

    /**
     * RelatedPostsWidget constructor.
     * @param PostReadRepository $posts
     * @param array $config
     */
    public function __construct(PostReadRepository $posts, $config = [])
    {
        parent::__construct($config);
        $this->_posts = $posts;
    }

    public function run()
    {
        return $this->render('index', [
            'posts' => $this->_posts->getPopular(self::POPULAR_LIMIT),
        ]);
    }

}