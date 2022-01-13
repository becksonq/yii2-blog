<?php


namespace becksonq\blog\models\tags;

use shop\exceptions\NotFoundException;

/**
 * Class TagRepository
 * @package shop\models\tag
 */
class TagRepository
{
    /**
     * @param $id
     * @return Tag
     */
    public function get($id): Tag
    {
        if (!$tag = Tag::findOne($id)) {
            throw new NotFoundException('Tag is not found.');
        }
        return $tag;
    }

    /**
     * @param $name
     * @return Tag|null
     */
    public function findByName($name): ?Tag
    {
        return Tag::findOne(['name' => $name]);
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public function findById($id)
    {
        return Tag::find()->andWhere(['id' => $id])->one();
    }

    /**
     * @param string $slug
     * @return array|\yii\db\ActiveRecord|null
     */
    public function findBySlug(string $slug)
    {
        return Tag::find()->andWhere(['slug' => $slug])->limit(1)->one();
    }

    /**
     * @param Tag $tag
     */
    public function save(Tag $tag): void
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Tag $tag
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    /**
     * @param $id
     * @return Tag|null
     */
    public function find($id): ?Tag
    {
        return Tag::findOne($id);
    }

    /**
     * @param $limit
     * @return array
     */
    public function getPopular($limit): array
    {
        return Tag::find()->limit($limit)->all();
    }
}