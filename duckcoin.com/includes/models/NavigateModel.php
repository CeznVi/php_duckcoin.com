<?php

namespace App;

class NavigateModel extends DbEngine
{
    public function __construct()
    {
        parent::__construct('navigate');
    }

    public  function getAllNav() {
        return $this->getManyRows([], 'ASC', "'order'");
    }

    public function getAllTitle() {
        $arr = $this->getManyRows();
        $options = [];

        for($i = 0; $i < count($arr); $i++){
            $options += [$arr[$i]['title'] => $arr[$i]['href']];
        }
        return $options;
    }

    public function getOneRow($id)
    {
        return parent::getOneRow($id); //
    }

    public function getHref($title) {
        $query = "SELECT href FROM navigate WHERE title = '".$title."'";
        return $this->executeQuery($query);
    }

    public function getNavigateByFilter($filter = []) {
        return $this->getManyRows($filter);
    }

    public function addParam($data = []) {
        $this->addRow($data);
    }

    public function dellParam($id) {
        $this->deleteRow($id);
    }

    public function updParam($id, $data = []) {
        $this->updateRow($id, $data);
    }

}