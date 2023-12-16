<?php


namespace App {
    use PDO;

    class DbEngine
    {
        private $_dbConnector = null;
        private $_dbH = null;
        private $_tableTable = null;

        public  function __construct($tableName)
        {
            $this->_dbConnector = DbConnector::getInstance();
            $this->_dbH = DbConnector::getInstance();
            $tableName = mb_strtolower($tableName);
            if($this->isTableExists($tableName)){
                $this->_tableTable = $tableName;
                return;
            }
            throw new \Exception("current table NOT exists");
        }

        public function getCountRow() {
            $query = "SELECT COUNT(*) FROM ". $this->_tableTable;
            $stH =  $this->_dbH->prepare($query);
            $stH->execute();
            ///получаем только нулевой столбик с результатом и проверяем вернулось ли число
            $rez = intval($stH->fetch(PDO::FETCH_COLUMN, 0));

            ///если число интовое то вернем его, если нет то будет -1
            if(is_int($rez)) {
                return $rez;
            } else {
                return -1;
            }
        }

        private function isTableExists($tableName) {
            $query = "SHOW TABLES";
            $result = $this->_dbH->query($query, PDO::FETCH_ASSOC)->fetchAll();
            if(count($result) > 0) {
                $baseName = "Tables_in_".mb_strtolower(DB_NAME);
                for ($i = 0; $i < count($result); $i++) {
                    if(strcasecmp($tableName, $result[$i][$baseName]) == 0){
                        return true;
                    }
                }
            }
            return  false;
        }
        protected function executeQuery($query) {
           $stH =  $this->_dbH->prepare($query);
           $stH->execute();
           return $stH->fetchAll(PDO::FETCH_ASSOC);
        }
        protected function getId($filter = []) {
            $query = "SELECT Id FROM ".$this->_tableTable." WHERE ";
            //options.name = 'lang' AND options.value = 'ua' AND";

            if(count($filter) > 0) {
                foreach ($filter as $key => $value) {
                    if($value == null) {
                        $query .= "$key IS NULL AND ";
                    } else {
                        $query .= "$key = '$value' AND ";
                    }
                }
                $query = mb_substr($query, 0, mb_strlen($query) - 4);
                $stH =  $this->_dbH->prepare($query);
                $stH->execute();
                $result = $stH->fetch(PDO::FETCH_ASSOC);
                if($result != false) {
                    return $result['Id'];
                }
                return  null;
            } else {
                throw new \Exception("Filter is empty!!!!");
            }
        }
        public function __destruct()
        {
            unset($this->_dbConnector);
            unset($this->_dbH);
        }

        protected function getOneRow($id) {
            $query = "SELECT * FROM ".$this->_tableTable. " WHERE Id = ".$id;
            return $this->executeQuery($query);
        }

        protected function getManyRows($filter = [], $order = "ASC", $by='Id', $limit = 100, $skip = 0) {
            $query = "SELECT * FROM ".$this->_tableTable;
            if(count($filter) > 0) {
                $query.= " WHERE ";
                foreach ($filter as $key => $value) {
                    if($value == null) {
                        $query .= "$key IS NULL AND ";
                    } else {
                        $query .= "$key = '$value' AND ";
                    }
                }
                $query = mb_substr($query, 0, mb_strlen($query) - 4);
            }
            $query .= " ORDER BY $by $order LIMIT $skip, $limit";
                $stH =  $this->_dbH->prepare($query);
                $stH->execute();
                return $stH->fetchAll(PDO::FETCH_ASSOC);
        }
        protected  function addRow($data = []){
            if(count($data) > 0) {
                $query = "INSERT " .$this->_tableTable. "(";

                foreach ($data as $key => $values) {
                    $query .= "$key, ";
                }

                $query = mb_substr($query, 0, mb_strlen($query) - 2);
                $query .= ") VALUES(";

                foreach ($data as $key => $values) {
                    $query .= "'".$values."', ";
                }
                $query = mb_substr($query, 0, mb_strlen($query) - 2);
                $query .= ")";

                /// Для дебага раскоментить чтобы посмотреть запрос
                //varSupperDump($query);

                $stH = $this->_dbH->prepare($query);
                $stH->execute();

                if($stH->rowCount() == 1) {
                    return true;
                } else {
                    return  false;
                }
            }
        }
        protected  function deleteOneRow($id) {
            $stH =  $this->_dbH->prepare("DELETE FROM ".$this->_tableTable." WHERE Id=:id LIMIT 1");
            $stH->bindParam(':id', $id, PDO::PARAM_INT);
            $stH->execute();
            if($stH->rowCount() == 1) {
                return true;
            } else {
                return  false;
            }
        }
        protected  function updateRow($id, $data = []) {
            if(count($data) > 0) {
                $query = "UPDATE " .$this->_tableTable. " SET ";

                foreach ($data as $key => $values) {
                    $query .= "$key = '$values', ";
                }

                $query = mb_substr($query, 0, mb_strlen($query) - 2);
                $query .= " WHERE Id = $id";

                $stH = $this->_dbH->prepare($query);
                $stH->execute();

                if($stH->rowCount() == 1) {
                    return true;
                } else {
                    return  false;
                }
            }
        }
    }
}