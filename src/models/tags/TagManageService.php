<?php

namespace becksonq\blog\models\tags;

/**
 * Class TagManageService
 * @package shop\models\tag
 */
class TagManageService
{
    private $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param TagForm $form
     * @return Tag
     */
    public function create(TagForm $form): Tag
    {
        $tag = Tag::create(
            $form->name,
            $form->slug
        );
        $this->tags->save($tag);
        return $tag;
    }

    /**
     * @param $id
     * @param TagForm $form
     */
    public function edit($id, TagForm $form): void
    {
        $tag = $this->tags->get($id);
        $tag->edit(
            $form->name,
            $form->slug
        );
        $this->tags->save($tag);
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $tag = $this->tags->get($id);
        $this->tags->remove($tag);
    }
}