<?php

namespace becksonq\blog\widgets\comments;

use becksonq\blog\models\comment\Comment;

class CommentView
{
    /** @var Comment */
    public $comment;

    /** @var self[] */
    public $children;

    public function __construct(Comment $comment, array $children)
    {
        $this->comment = $comment;
        $this->children = $children;
    }
}