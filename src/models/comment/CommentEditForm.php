<?php

namespace becksonq\blog\models\comment;


use yii\base\Model;

class CommentEditForm extends Model
{
    public $parentId;
    public $text;

    public function __construct(Comment $comment, $config = [])
    {
        $this->parentId = $comment->parent_id;
        $this->text = $comment->text;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['text'], 'required'],
            ['text', 'string'],
            ['parentId', 'integer'],
        ];
    }
}