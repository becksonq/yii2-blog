<?php

namespace becksonq\blog\models\comment;

use becksonq\blog\models\post\Post;
use common\models\user\User;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\HtmlPurifier;

/**
 * @property int $id
 * @property int $created_at
 * @property int $post_id
 * @property int $user_id
 * @property int $parent_id
 * @property string $text
 * @property bool $active
 *
 * @property Post $post
 * @property User $user
 */
class Comment extends ActiveRecord
{
    /**
     * @param $userId
     * @param $parentId
     * @param $text
     * @return Comment
     */
    public static function create($userId, $parentId, $text): self
    {
        $review = new static();
        $review->user_id = $userId;
        $review->parent_id = $parentId;
        $review->text = $text;
        $review->created_at = time();
        $review->active = true;
        return $review;
    }

    public function edit($parentId, $text): void
    {
        $this->parent_id = $parentId;
        $this->text = $text;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = false;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active == true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isChildOf($id): bool
    {
        return $this->parent_id == $id;
    }

    /**
     * @return ActiveQuery
     */
    public function getPost(): ActiveQuery
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%blog_comments}}';
    }
}