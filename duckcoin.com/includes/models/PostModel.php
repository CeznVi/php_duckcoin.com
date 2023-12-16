<?php

namespace App;

class PostModel extends DbEngine
{
    public function __construct()
    {
        parent::__construct('posts');
    }

    ///Получить все посты из базы
    public function getAllposts($order = "ASC", $by='Id', $limit = 100, $skip = 0) {
        $query = "SELECT posts.Id, categories.category, posts.title, posts.content, posts.dateOfCreation, posts.imageLink".
                  " FROM posts, categories".
                  " WHERE categories.Id = posts.categoryId";
        $query .= " ORDER BY $by $order LIMIT $skip, $limit";

        return $this->executeQuery($query);
    }

    ///Получить количество постов в базе
    public function getCountPost() {
        return $this->getCountRow();
    }

    ///Получить пост из базы по его Id
    public function getOnePostById($id) {
        $query = "SELECT posts.Id, posts.categoryId,categories.category, posts.title, posts.content, posts.dateOfCreation, posts.imageLink".
            " FROM posts, categories".
            " WHERE categories.Id = posts.categoryId AND posts.Id =".$id;
        return $this->executeQuery($query);
    }

    public function deletePost($id) {
        return $this->deleteOneRow($id);
    }

    public function editPost($id, $data) {
        return $this->updateRow($id, $data);
    }

    public function addPost($data) {
        return $this->addRow($data);
    }

}