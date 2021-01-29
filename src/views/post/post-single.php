<?php

/* @var $this yii\web\View
 * @var $post \becksonq\blog\models\post\Post
 * @var $prev \becksonq\blog\models\post\Post
 * @var $next \becksonq\blog\models\post\Post
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $post->getSeoTitle();

$this->registerMetaTag(['name' => 'description', 'content' => $post->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $post->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Блог'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $post->title;

$tagLinks = [];
foreach ($post->tags as $tag) {
    $tagLinks[] = Html::a(Html::encode($tag->name), ['tag', 'slug' => $tag->slug]);
}
?>

<!-- Page Title (Light)-->
<div class="bg-secondary py-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <?= \becksonq\breadcrumbs\Breadcrumbs::widget([
                'links'      => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'navOptions' => ['aria-label' => 'breadcrumb',],
                'homeLink'   => [
                    'label'  => '<i class="czi-home mr-1"></i>' . Yii::t('yii', 'Home'),
                    'url'    => Yii::$app->homeUrl,
                    'encode' => false
                ],
                'options'    => [
                    'class' => 'breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start',
                ],
            ]) ?>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
            <?= Html::tag('h1', Html::encode($post->title), ['class' => 'h3 mb-0']) ?>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container pb-5">
    <div class="row pt-5 mt-md-2">
        <section class="col-lg-8">
            <!-- Post meta-->
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4 mt-n1">
                <div class="d-flex align-items-center font-size-sm mb-2">
                    <?= Html::beginTag('a', ['class' => 'blog-entry-meta-link', 'href' => Url::to(['#'])]) ?>
                    <div class="blog-entry-author-ava">
                        <?= Html::img(
                            Html::encode($post->user->avatar) ?: (Yii::getAlias('@web') . '/uploads/img/no-person.webp'),
                            ['alt' => $post->user->username]) ?>
                    </div>
                    <?= Html::encode($post->user->username) ?>
                    <?= Html::endTag('a') ?>
                    <span class="blog-entry-meta-divider"></span>
                    <?= Html::a(Yii::$app->formatter->asDate($post->created_at, 'php:M d, Y'), null, [
                        'class' => 'blog-entry-meta-link',
                    ]) ?>
                </div>
                <div class="font-size-sm mb-2">
                    <?= Html::a('<i class="czi-message"></i>' . $post->comments_count, null, [
                        'class'       => 'blog-entry-meta-link text-nowrap',
                        'href'        => '#comments',
                        'data-scroll' => true
                    ]) ?>
                </div>
            </div>

            <!-- Gallery-->
            <?php if (!empty($post->images)): echo $this->render('_gallery', ['post' => $post]); endif; ?>

            <!-- Post content-->
            <?= $post->content ?>

            <!-- Post tags + sharing-->
            <div class="d-flex flex-wrap justify-content-between pt-2 pb-4 mb-1">
                <div class="mt-3 mr-3">
                    <?php foreach ($post->tags as $tag):
                        //@todo: link to search by tags
                        echo Html::a('#' . $tag->name, Url::to(['#']), ['class' => 'btn-tag mr-2 mb-2']);
                    endforeach; ?>
                </div>
                <div class="mt-3">
                    <?= Html::tag('span', Yii::t('app', 'Поделиться:'),
                        ['class' => 'd-inline-block align-middle text-muted font-size-sm mr-3 mb-2']) ?>
                    <?= Html::a('<i class="czi-facebook"></i>', Url::to(['#']),
                        ['class' => 'social-btn sb-facebook mr-2 mb-2']) ?>
                    <?= Html::a('<i class="czi-twitter"></i>', Url::to(['#']),
                        ['class' => 'social-btn sb-twitter mr-2 mb-2']) ?>
                    <?= Html::a('<i class="czi-pinterest"></i>', Url::to(['#']),
                        ['class' => 'social-btn sb-pinterest mr-2 mb-2']) ?>
                </div>
            </div>
            <!-- Post navigation-->
            <!-- Pagination-->
            <nav class="entry-navigation" aria-label="Post navigation">
                <?= Html::beginTag('a', [
                    'class'          => 'entry-navigation-link nav-link ' . ($prev !== null ? '' : 'disabled'),
                    'href'           => Url::to(['post', 'id' => $prev->id]),
                    'data-toggle'    => 'popover',
                    'data-placement' => 'top',
                    'data-trigger'   => 'hover',
                    'data-html'      => 'true',
                    'data-content'   => $prev == null ?: '<div class="media align-items-center">'
                        . \becksonq\blog\models\helpers\PostHelper::prevBtnImage($prev) . '<div class="media-body"><h6  class="font-size-sm font-weight-semibold mb-0">'
                        . Html::encode($prev->title) . '</h6><span class="d-block font-size-xs text-muted">' . $prev->user->username . '</span></div></div>',
                ]) ?>
                <i class="czi-arrow-left mr-2"></i>
                <?= Html::tag('span', Yii::t('app', 'Назад'), ['class' => 'd-none d-sm-inline']) ?>
                <?= Html::endTag('a') ?>

                <?= Html::a('<i class="czi-view-list mr-2"></i><span class="d-none d-sm-inline">' . Yii::t('app',
                        'Все посты') . '</span>',
                    Url::to(['/blog/post/index']), ['class' => 'entry-navigation-link']) ?>

                <?= Html::beginTag('a', [
                    'class'          => 'entry-navigation-link nav-link ' . ($next !== null ? '' : 'disabled'),
                    'href'           => Url::to(['post', 'id' => $next->id]),
                    'data-toggle'    => 'popover',
                    'data-placement' => 'top',
                    'data-trigger'   => 'hover',
                    'data-html'      => 'true',
                    'data-content'   => $next == null ?: '<div class="media align-items-center">'
                        . \becksonq\blog\models\helpers\PostHelper::nextBtnImage($next) . '<div class="media-body"><h6  class="font-size-sm font-weight-semibold mb-0">'
                        . Html::encode($next->title) . '</h6><span class="d-block font-size-xs text-muted">' . $next->user->username . '</span></div></div>'
                ]) ?>
                <?= Html::tag('span', Yii::t('app', 'Вперед'), ['class' => 'd-none d-sm-inline']) ?>
                <i class="czi-arrow-right ml-2"></i>
                <?= Html::endTag('a') ?>
            </nav>

            <!-- Comments-->
            <?= \becksonq\blog\widgets\comments\CommentsWidget::widget(['post' => $post]) ?>

        </section>
        <?= $this->render('_aside', []) ?>
    </div>
</div>

<?= \becksonq\blog\widgets\related_posts\RelatedPostsWidget::widget([]) ?>
