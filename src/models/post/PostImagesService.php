<?php


namespace becksonq\blog\models\post;


use Yii;
use shop\exceptions\NotFoundException;
use yii\web\UploadedFile;

class PostImagesService
{
    /** @var PostImageRepository */
    private $_repository;

    /** @var PostImages */
    private $_images;

    public function __construct(PostImageRepository $repository, PostImages $images)
    {
        $this->_repository = $repository;
        $this->_images = $images;
    }

    /**
     * Добавляем изображения 1000x667 для слайшоу поста на странице его просмотра
     * @param int $postId
     * @param PostImagesForm $form
     * @param int $type
     */
    public function addFullImages(int $postId, PostImagesForm $form): void
    {
        $postImagesArray = $this->_repository->getAllByType($postId, PostImages::TYPE_FULL) ?? [];

        foreach ($form->files as $file) {
            $postImagesArray[] = PostImages::create($postId, $file, PostImages::TYPE_FULL);
        }
        $this->_updateImages($postImagesArray);
    }

    /**
     * Добавляем изображения 628x494 для тела поста на странице его просмотра
     * @param int $postId
     * @param PostImagesForm $form
     * @param int $type
     */
    public function addImages(int $postId, PostImagesForm $form): void
    {
        $postImagesArray = $this->_repository->getAllByType($postId, PostImages::TYPE_POST_SINGLE) ?? [];

        foreach ($form->files as $file) {
            $postImagesArray[] = PostImages::create($postId, $file, PostImages::TYPE_POST_SINGLE);
        }
        $this->_updateImages($postImagesArray);
    }

    /**
     * Добавляем изображение 600х350 для карусели на главной странице постов
     * @param int $postId
     * @param PostImagesForm $form
     * @todo приходит и обрабатывается массив, а должен быть один файл, потому, что загружается одно изображение
     */
    public function addCarouselImage(int $postId, PostImagesForm $form): void
    {
        $postImagesArray = [];

        $postImage = $this->_repository->getOne($postId, PostImages::TYPE_CAROUSEL);
        foreach ($form->files as $file) {
            if ($postImage == null) {
                $postImagesArray[] = PostImages::create($postId, $file, PostImages::TYPE_CAROUSEL);
            } else {
                $postImagesArray[] = $postImage->edit($postId, $file, PostImages::TYPE_CAROUSEL);
            }
        }
        $this->_updateImages($postImagesArray);
    }

    /**
     * Добавляем изображение 100х667 для слайдера на странице поста
     * @param int $postId
     * @param PostImagesForm $form
     * @todo приходит и обрабатывается массив, а должен быть один файл, потому, что загружается одно изображение
     */
    public function addFullImage(int $postId, PostImagesForm $form): void
    {
        $postImagesArray = [];

        $postImage = $this->_repository->getOne($postId, PostImages::TYPE_FULL);
        foreach ($form->files as $file) {
            if ($postImage == null) {
                $postImagesArray[] = PostImages::create($postId, $file, PostImages::TYPE_FULL);
            } else {
                $postImagesArray[] = $postImage->edit($postId, $file, PostImages::TYPE_FULL);
            }
        }
        $this->_updateImages($postImagesArray);
    }

    /**
     * @param int $postId
     * @param PostImagesForm $form
     * @param int $type
     */
    public function updateImages(int $postId, PostImagesForm $form, int $type): void
    {
        if ($type == PostImages::TYPE_POST_SINGLE) {
            return;
        }

        if ($form->files !== null) {
            foreach ($form->files as $file) {
                $this->_images->updateImage($postId, $file, $type);
            }
        } else {
            throw new NotFoundException('No images loaded.');
        }
    }

    /**
     * @param array $images
     */
    private function _updateImages(array $images)
    {
        /** @var $image PostImages */
        foreach ($images as $i => $image) {
            $image->sort = $i;
            $this->_repository->save($image);
        }
    }

    /**
     * @param int $postId
     * @param int|null $type
     * @param int|null $imageId
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @todo: нужно удалять по id изображения!
     */
    public function removeImage(int $postId, int $type = null, int $imageId = null): void
    {
        $postImagesArray = [];
        if ($imageId !== null) {
            $image = $this->_repository->get($imageId);
        } else {
            $image = $this->_repository->getOne($postId, $type);
        }
        $this->_repository->remove($image);

        if ($type !== null && $type == PostImages::TYPE_POST_SINGLE) {
            $postImagesArray = $this->_repository->getAllByType($postId, $type);
        }
        $this->_updateImages($postImagesArray);

        $originDirectory = Yii::getAlias('@staticRoot') . PostImages::ORIGIN_PATH;
        $cacheDirectory = Yii::getAlias('@staticRoot') . PostImages::CACHE_PATH;

        $this->deleteFile($originDirectory . $postId . DIRECTORY_SEPARATOR . $image->id);
        $this->deleteFile($cacheDirectory . $postId . DIRECTORY_SEPARATOR . $image->id);
    }

    /**
     * Удаляем изображение в папке
     * @param $path
     * @return bool
     */
    protected function deleteFile($path)
    {
        if ((is_file($path) === true) || (is_link($path) === true)) {
            return unlink($path);
        }
        return false;
    }

    /**
     * @param $postId
     * @param $photoId
     */
    public function moveImageUp(int $postId, int $imageId): void
    {
        $images = $this->_repository->getPostImages($postId);
        foreach ($images as $i => $image) {
            if ($image->isIdEqualTo($imageId)) {
                if ($prev = $images[$i - 1] ?? null) {
                    $images[$i - 1] = $image;
                    $images[$i] = $prev;
                    $this->_updateImages($images);
                }
                return;
            }
        }
        throw new \DomainException('Image is not found.');
    }

    /**
     * @param $postId
     * @param $photoId
     */
    public function moveImageDown($postId, $imageId): void
    {
        $images = $this->_repository->getPostImages($postId);
        foreach ($images as $i => $image) {
            if ($image->isIdEqualTo($imageId)) {
                if ($next = $images[$i + 1] ?? null) {
                    $images[$i] = $next;
                    $images[$i + 1] = $image;
                    $this->_updateImages($images);
                }
                return;
            }
        }
        throw new \DomainException('Image is not found.');
    }

    /**
     * @param $postId
     * @param $photoId
     */
    public function moveFullImageUp(int $postId, int $imageId): void
    {
        $images = $this->_repository->getfullImages($postId);
        foreach ($images as $i => $image) {
            if ($image->isIdEqualTo($imageId)) {
                if ($prev = $images[$i - 1] ?? null) {
                    $images[$i - 1] = $image;
                    $images[$i] = $prev;
                    $this->_updateImages($images);
                }
                return;
            }
        }
        throw new \DomainException('Image is not found.');
    }

    /**
     * @param $postId
     * @param $photoId
     */
    public function moveFullImageDown($postId, $imageId): void
    {
        $images = $this->_repository->getFullImages($postId);
        foreach ($images as $i => $image) {
            if ($image->isIdEqualTo($imageId)) {
                if ($next = $images[$i + 1] ?? null) {
                    $images[$i] = $next;
                    $images[$i + 1] = $image;
                    $this->_updateImages($images);
                }
                return;
            }
        }
        throw new \DomainException('Image is not found.');
    }
}