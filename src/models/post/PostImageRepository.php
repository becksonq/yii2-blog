<?php


namespace becksonq\blog\models\post;


use shop\exceptions\NotFoundException;

/**
 * Class PostImageRepository
 * @package becksonq\blog\models\post
 */
class PostImageRepository
{
    /**
     * @param int $postId
     * @return PostImages[]
     */
    public function getAll(int $postId): array
    {
        if (!$models = PostImages::findAll($postId)) {
            throw new NotFoundException('Images are not found.');
        }
        return $models;
    }

    /**
     * @param int $postId
     * @param int $type
     * @return PostImages[]
     */
    public function getAllByType(int $postId, int $type): array
    {
        return $models = PostImages::findAll(['post_id' => $postId, 'type' => $type,]);
    }

    /**
     * @param int $postId
     * @return array
     */
    public function getPostImages(int $postId): array
    {
        return PostImages::find()->where([
            'post_id' => $postId,
            'type'    => PostImages::TYPE_POST_SINGLE
        ])->orderBy(['sort' => SORT_ASC])->all();
    }

    /**
     * @param int $postId
     * @return array
     */
    public function getFullImages(int $postId): array
    {
        return $models = PostImages::find()->where([
            'post_id' => $postId,
            'type'    => PostImages::TYPE_FULL
        ])->orderBy(['sort' => SORT_ASC])->all();
    }

    /**
     * @param $id
     * @return PostImages
     */
    public function get($id): PostImages
    {
        if (!$model = PostImages::findOne($id)) {
            throw new NotFoundException('Image is not found.');
        }
        return $model;
    }

    /**
     * @param int $postId
     * @param int $type
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getOne(int $postId, int $type)
    {
        return $model = PostImages::find()->where(['post_id' => $postId, 'type' => $type])->one();
    }

    /**
     * @param int $postId
     * @return PostImages
     */
    public function getByPost(int $postId): PostImages
    {
        if (!$model = PostImages::findOne($postId)) {
            throw new NotFoundException('Image is not found.');
        }
        return $model;
    }

    /**
     * @param PostImages $model
     */
    public function save(PostImages $model): void
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param PostImages $model
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(PostImages $model): void
    {
        if (!$model->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}