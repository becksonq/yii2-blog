<?php

namespace becksonq\blog\models\comment;


use becksonq\blog\models\post\PostRepository;
use common\models\user\UserRepository;

/**
 * Class CommentService
 * @package blog\models\post
 */
class CommentService
{
    private $_posts;
    private $_users;

    /**
     * CommentService constructor.
     * @param PostRepository $posts
     * @param UserRepository $users
     */
    public function __construct(PostRepository $posts, UserRepository $users)
    {
        $this->_posts = $posts;
        $this->_users = $users;
    }

    /**
     * @param $postId
     * @param $userId
     * @param CommentForm $form
     * @return Comment
     */
    public function create($postId, $userId, CommentForm $form): Comment
    {
        $post = $this->_posts->get($postId);
        $user = $this->_users->get($userId);

        $comment = $post->addComment($user->id, $form->parentId, $form->text);

        $this->_posts->save($post);

        return $comment;
    }

    /**
     * @param $postId
     * @param $id
     * @param CommentEditForm $form
     */
    public function edit($postId, $id, CommentEditForm $form): void
    {
        $post = $this->_posts->get($postId);
        $post->editComment($id, $form->parentId, $form->text);
        $this->_posts->save($post);
    }

    /**
     * @param $postId
     * @param $id
     */
    public function activate($postId, $id): void
    {
        $post = $this->_posts->get($postId);
        $post->activateComment($id);
        $this->_posts->save($post);
    }

    /**
     * @param $postId
     * @param $id
     */
    public function remove($postId, $id): void
    {
        $post = $this->_posts->get($postId);
        $post->removeComment($id);
        $this->_posts->save($post);
    }
}