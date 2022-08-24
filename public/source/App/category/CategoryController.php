<?php

namespace Source\App;

use Source\Models\Category;

class CategoryController
{

    public function getAllCategories()
    {

        $listCategories = array();
        $category = new Category();
        $list = $category->find()->fetch(true);

        foreach ($list as $cat) {
            array_push($listCategories, $cat->data());
        }

        echo json_encode(['listCategories' => $listCategories]);
    }

    public function getById($data)
    {
        $category = new Category();
        $category->findById($data['nr_category']);
        echo json_encode(['category' => $category->data()]);
    }

    public function saveCategory($data)
    {
        $category = new Category();

        if ($data['id_category']) {
            $category = (new Category())->findById($data['id_category']);
        }

        $category->nm_category = $data['nm_category'];

        $category->save();
    }
}
