<?php

namespace becksonq\blog\models\post;

use shop\exceptions\NotFoundException;

class PostRepository
{
    /**
     * @param $id
     * @return Post
     */
    public function get($id): Post
    {
        if (!$post = Post::findOne($id)) {
            throw new NotFoundException('Post is not found.');
        }
        return $post;
    }
    
    /**
     * @param $id
     * @return bool
     */
    public function existsByCategory($id): bool
    {
        return Post::find()->andWhere(['category_id' => $id])->exists();
    }
    
    /**
     * @param Post $post
     */
    public function save(Post $post): void
    {
        if (!$post->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
    
    /**
     * @param Post $brand
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Post $post): void
    {
        if (!$post->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}