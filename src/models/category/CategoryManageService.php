<?php

namespace becksonq\blog\models\category;

use shop\models\meta\Meta;
use becksonq\blog\models\post\PostRepository;

class CategoryManageService
{
    private $categories;
    private $posts;

    public function __construct(CategoryRepository $categories, PostRepository $posts)
    {
        $this->categories = $categories;
        $this->posts = $posts;
    }

    public function create(CategoryForm $form): Category
    {
        $category = Category::create(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            $form->sort,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {
        $category = $this->categories->get($id);
        $category->edit(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            $form->sort,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->categories->save($category);
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        if ($this->posts->existsByCategory($category->id)) {
            throw new \DomainException('Unable to remove category with posts.');
        }
        $this->categories->remove($category);
    }
}