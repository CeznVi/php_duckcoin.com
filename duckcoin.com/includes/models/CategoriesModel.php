<?php

namespace App;

class CategoriesModel extends DbEngine
{
    public function __construct()
    {
        parent::__construct('categories');
    }

    ///Получить все посты из базы
    public function getAllCategory()
    {
        return $this->getManyRows();
    }

    ////Получить все категории кроме категории которая указана в айди
    public function getAllCategoryWithoutId($id) {
        $query = "SELECT * FROM categories WHERE categories.Id != ". $id;
        return $this->executeQuery($query);
    }
}