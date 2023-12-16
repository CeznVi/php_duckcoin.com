<?php

namespace App {
    class OptionModel extends DbEngine
    {
            public function __construct()
            {
                parent::__construct('options');
            }
            public function getOption($key) {
                $query = "SELECT value FROM options WHERE name = '".$key."'";
                return $this->executeQuery($query);
            }
            public function getAllOptions() {
                return $this->getManyRows();
            }
            public function removeOption($id) {
                return $this->deleteOneRow($id);
            }

            public function getOneRow($id)
            {
                return parent::getOneRow($id); //
            }

            public function getOptionsByFilter($filter = []) {
                return $this->getManyRows($filter);
            }

            public function addParam($data = []) {
                return $this->addRow($data);
            }

            public function dellParam($id) {
                $this->deleteRow($id);
            }

            public function updateParam($id, $data = []) {
               return $this->updateRow($id, $data);
            }
    }
}