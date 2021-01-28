<?php

namespace becksonq\blog\models\comment;

use yii\base\Model;

class CommentForm extends Model
{
    public $parentId;
    public $text;

    public function rules(): array
    {
        return [
            [['text'], 'required'],
            ['text', 'string'],
            ['text', 'filter', 'filter' => 'strip_tags'],
            ['parentId', 'integer'],
        ];
    }
}