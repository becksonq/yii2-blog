<?php


namespace becksonq\blog\models\post;


use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class PostImagesForm
 * @package becksonq\blog\models\post
 */
class PostImagesForm extends Model
{
    /** @var UploadedFile[] */
    public $files;

    public function rules(): array
    {
        return [
            ['files', 'each', 'rule' => ['image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp']]],
//            ['files', 'image', 'extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],],
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }
        return false;
    }
}