<?php

namespace blog\widgets;

use blog\models\comment\Comment;

class CommentView
{
    public $comment;
    /**
     * @var self[]
     */
    public $children;

    public function __construct(Comment $comment, array $children)
    {
        $this->comment = $comment;
        $this->children = $children;
    }
}