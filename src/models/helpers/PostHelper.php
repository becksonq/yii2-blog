<?php

namespace becksonq\blog\models\helpers;

use becksonq\blog\models\post\Post;
use shop\models\product\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class PostHelper
{
    /**
     * @return string[]
     */
    public static function statusList(): array
    {
        return [
            Product::STATUS_DRAFT  => 'Draft',
            Product::STATUS_ACTIVE => 'Active',
        ];
    }

    /**
     * @param $status
     * @return string
     * @throws \Exception
     */
    public static function statusName($status): string
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }

    /**
     * @param $status
     * @return string
     * @throws \Exception
     */
    public static function statusLabel($status): string
    {
        switch ($status) {
            case Product::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case Product::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
            'class' => $class,
        ]);
    }

    /**
     * Кнопка навигации "предыдущий пост" на странице просмотра поста
     * @param Post $model
     * @return string|null
     */
    public static function prevBtnImage(Post $model)
    {
        foreach ($model->images as $image) {
            if ($image->type == \becksonq\blog\models\post\PostImages::TYPE_CAROUSEL) {
                return Html::img($image->getThumbFileUrl('file', 'navigation'),
                    ['width' => '60', 'class' => 'mr-3', 'alt' => $model->title]);
            }
        }
        return null;
    }

    /**
     * Кнопка навигации "следующий пост" на странице просмотра поста
     * @param Post $model
     * @return string|null
     */
    public static function nextBtnImage(Post $model)
    {
        foreach ($model->images as $image) {
            if ($image->type == \becksonq\blog\models\post\PostImages::TYPE_CAROUSEL) {
                return Html::img($image->getThumbFileUrl('file', 'navigation'),
                    ['width' => '60', 'class' => 'mr-3', 'alt' => $model->title]);
            }
        }
        return null;
    }
}