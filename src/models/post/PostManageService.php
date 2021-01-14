<?php

namespace becksonq\blog\models\post;

use shop\models\meta\Meta;
use becksonq\blog\models\tags\Tag;
use becksonq\blog\models\category\CategoryRepository;
use becksonq\blog\models\tags\TagRepository;
use shop\models\services\TransactionManager;

/**
 * Class PostManageService
 * @package blog\models\post
 */
class PostManageService
{
    private $posts;
    private $categories;
    private $tags;
    private $transaction;

    /**
     * PostManageService constructor.
     * @param PostRepository $posts
     * @param CategoryRepository $categories
     * @param TagRepository $tags
     * @param TransactionManager $transaction
     */
    public function __construct(
        PostRepository $posts,
        CategoryRepository $categories,
        TagRepository $tags,
        TransactionManager $transaction
    ) {
        $this->posts = $posts;
        $this->categories = $categories;
        $this->tags = $tags;
        $this->transaction = $transaction;
    }

    /**
     * @param PostForm $form
     * @return Post
     * @throws \Exception
     */
    public function create(PostForm $form): Post
    {
        $category = $this->categories->get($form->categoryId);

        $post = Post::create(
            $category->id,
            $form->title,
            $form->description,
            $form->content,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        if ($form->image) {
            $post->setImage($form->image);
        }

        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $post->assignTag($tag->id);
        }

        $this->transaction->wrap(function () use ($post, $form) {
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $post->assignTag($tag->id);
            }
            $this->posts->save($post);
        });

        return $post;
    }

    /**
     * @param $id
     * @param PostForm $form
     * @throws \Exception
     */
    public function edit($id, PostForm $form): void
    {
        $post = $this->posts->get($id);
        $category = $this->categories->get($form->categoryId);

        $post->edit(
            $category->id,
            $form->title,
            $form->description,
            $form->content,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        if ($form->image) {
            $post->setImage($form->image);
        }

        $this->transaction->wrap(function () use ($post, $form) {

            $post->revokeTags();
            $this->posts->save($post);

            foreach ($form->tags->existing as $tagId) {
                $tag = $this->tags->get($tagId);
                $post->assignTag($tag->id);
            }
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $post->assignTag($tag->id);
            }
            $this->posts->save($post);
        });
    }

    /**
     * @param $id
     */
    public function activate($id): void
    {
        $post = $this->posts->get($id);
        $post->activate();
        $this->posts->save($post);
    }

    /**
     * @param $id
     */
    public function draft($id): void
    {
        $post = $this->posts->get($id);
        $post->draft();
        $this->posts->save($post);
    }

    /**
     * @param $id
     */
    public function remove($id): void
    {
        $post = $this->posts->get($id);
        $this->posts->remove($post);
    }
}