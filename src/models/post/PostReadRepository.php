<?php

namespace becksonq\blog\models\post;

use becksonq\blog\models\category\Category;
use becksonq\blog\models\tags\Tag;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class PostReadRepository
{
    /**
     * @return int
     */
    public function count(): int
    {
        return Post::find()->active()->count();
    }

    /**
     * @param $offset
     * @param $limit
     * @return array
     */
    public function getAllByRange($offset, $limit): array
    {
        return Post::find()->active()->orderBy(['id' => SORT_ASC])->limit($limit)->offset($offset)->all();
    }

    /**
     * @return DataProviderInterface
     */
    public function getAll(): DataProviderInterface
    {
        $query = Post::find()->active()->with('category')->orderBy('id DESC');
        return $this->_getProvider($query);
    }

    /**
     * @param Category $category
     * @return DataProviderInterface
     */
    public function getAllByCategory(Category $category): DataProviderInterface
    {
        $query = Post::find()->active()->andWhere(['category_id' => $category->id])->with('category');
        return $this->_getProvider($query);
    }

    /**
     * @param Tag $tag
     * @return DataProviderInterface
     */
    public function getAllByTag(Tag $tag): DataProviderInterface
    {
        $query = Post::find()->alias('p')->active('p')->with('category');
        $query->joinWith(['tagAssignments ta'], false);
        $query->andWhere(['ta.tag_id' => $tag->id]);
        $query->groupBy('p.id');
        return $this->_getProvider($query);
    }

    /**
     * @param $limit
     * @return array
     */
    public function getLast($limit): array
    {
        return Post::find()->with('category')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    /**
     * @param $limit
     * @return array
     */
    public function getPopular($limit): array
    {
        return Post::find()->with('category')->orderBy(['comments_count' => SORT_DESC])->limit($limit)->all();
    }

    /**
     * @param $id
     * @return Post|null
     */
    public function find($id): ?Post
    {
        return Post::find()->active()->andWhere(['id' => $id])->one();
    }

    /**
     * @param ActiveQuery $query
     * @return ActiveDataProvider
     */
    private function _getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort'  => false,
        ]);
    }

    /**
     * Кнопка "предыдущий пост"
     *
     * @param int $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public function prev(int $id)
    {
        $model = Post::find()->active()->andWhere(['<', 'id', $id])->orderBy('id DESC')->limit(1)->one();

        if ($model !== null) {
            return $model;
        }

        return null;
    }

    /**
     * Кнопка "следующий пост"
     *
     * @param int $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public function next(int $id)
    {
        $model = Post::find()->active()->andWhere(['>', 'id', $id])->orderBy('id ASC')->limit(1)->one();

        if ($model !== null) {
            return $model;
        }

        return null;
    }
}