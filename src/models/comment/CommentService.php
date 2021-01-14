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
    private $posts;
    private $users;

    /**
     * CommentService constructor.
     * @param PostRepository $posts
     * @param UserRepository $users
     */
    public function __construct(PostRepository $posts, UserRepository $users)
    {
        $this->posts = $posts;
        $this->users = $users;
    }

    /**
     * @param $postId
     * @param $userId
     * @param CommentForm $form
     * @return Comment
     */
    public function create($postId, $userId, CommentForm $form): Comment
    {
        $post = $this->posts->get($postId);
        $user = $this->users->get($userId);

        $comment = $post->addComment($user->id, $form->parentId, $form->text);

        $this->posts->save($post);

        return $comment;
    }
}