<?php

namespace App {

    use Cassandra\Varint;
    use PDO;
    use Exception;

    class DBEngine
    {
        private $_dbConnector = null;
        private $_dbh = null;
        private $_bdTable = null;

        public function __construct($table)
        {
            $this->_dbConnector = DBConnector::getInstance();
            $this->_dbh = DBConnector::getInstance();
            $table = mb_strtolower($table);
            if (self::IsTableExists($table)) {
                $this->_bdTable = $table;
            }
        }

        public function IsTableExists($table)
        {
            $query = "SHOW TABLES";
            $result = $this->_dbh->query($query, PDO::FETCH_ASSOC)->fetchAll();
            if (count($result) > 0) {
                foreach ($result as $v) {
                    if (strcasecmp($v["Tables_in" . "_" . DB_NAME], $table) == 0) {
                        return true;
                    }
                }
            }
            return false;
        }

        public function __destruct()
        {
            unset($this->_dbConnector);
            unset($this->_dbh);
        }

        public function getId($filter = [])
        {
            $query = "SELECT Id FROM " . $this->_bdTable;
            if (count($filter) > 0) {
                $query .= " WHERE ";
                foreach ($filter as $key => $value) {
                    if ($value == null) {
                        $query .= "$key IS NULL AND ";
                    } else {
                        $query .= "$key = '$value' AND ";
                    }
                }
                $query = mb_substr($query, 0, mb_strlen($query) - 4);
            }
            $sth = $this->_dbh->prepare($query);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            if ($result != false) {
                return intval($result['Id'], 10);
            }
            return null;
        }

        public function getOneRow($filter = [])
        {
            $query = "SELECT * FROM " . $this->_bdTable;
            if (count($filter) > 0) {
                $query .= " WHERE ";
                foreach ($filter as $key => $value) {
                    if ($value == null) {
                        $query .= "$key IS NULL AND ";
                    } else {
                        $query .= "$key = '$value' AND ";
                    }
                }
                $query = mb_substr($query, 0, mb_strlen($query) - 4);
                $sth = $this->_dbh->prepare($query);
                $sth->execute();
                $resultArr = $sth->fetch(PDO::FETCH_ASSOC);
                return $resultArr;
            }
            return null;
        }

        public function getManyRows($filter = [], $order = "ASC", $by = "id", $offset = 0, $count = 100)
        {
            $query = "SELECT * FROM " . $this->_bdTable ;
            if (count($filter) > 0) {
                $query .= " WHERE ";
                foreach ($filter as $key => $value) {
                    if ($value == null) {
                        $query .= "$key IS NULL AND ";
                    } else {
                        $query .= "$key = '$value' AND ";
                    }
                }
                $query = mb_substr($query, 0, mb_strlen($query) - 4);
            }

            $query .= " ORDER BY " . $by . " " . $order . " LIMIT " . $count . " OFFSET " . $offset;

            $sth = $this->_dbh->prepare($query);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }


        public function addRow($data = [])
        {
            if (count($data) > 0) {
                $query = "INSERT INTO " . $this->_bdTable. "(";
                foreach ($data as $key => $value) {
                    $query .="`".$key . "`, ";
                }
                $query = mb_substr($query, 0, mb_strlen($query) - 2);
                $query .= ") VALUES (";
                foreach ($data as $key => $value) {
                    $query .= "'" . $value . "', ";
                }
                $query = mb_substr($query, 0, mb_strlen($query) - 2);
                $query .= ");";
                echo ($query);
                $sth = $this->_dbh->prepare($query);
                $sth->execute();
                return null;
            }

        }

        public function removeRow($id)
        {
            if ($id != null) {
                $query = "DELETE FROM " . $this->_bdTable . " WHERE id=" . $id . ";";
                $sth = $this->_dbh->prepare($query);
                $sth->execute();
                return null;
            }
        }

        public function updateRow($id, $data = [])
        {

            $query = "UPDATE  " . $this->_bdTable . " SET ";
            foreach ($data as $key => $value) {
                $query .="`".$key . "`='" . $value . "',";
            }
            $query = mb_substr($query, 0, mb_strlen($query) - 1);
            $query .= " WHERE id=" . $id . ";";

            $sth = $this->_dbh->prepare($query);
            $sth->execute();
            return null;
        }

        public function executeQuery($query)
        {
            $sth = $this->_dbh->prepare($query);
            $sth->execute();
            if (strpos($query, "SELECT") !== false) {
                return $sth->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $sth->rowCount() . " row affected";
            }
        }
    }
}