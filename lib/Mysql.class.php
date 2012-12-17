<?php

class Mysql {

    private static $_db = NULL;
    private static $_sql = NULL;

    public static function getError() {
        $db = self::_connect();

        $error = $db->errorInfo();
        $errorInfo = array(
            "code" => $error[1],
            "msg" => $error[2],
        );
        return $errorInfo;
    }

    public static function beginTransaction() {
        $db = self::_connect();
        return $db->beginTransaction();
    }

    public static function rollBack() {
        $db = self::_connect();
        return $db->rollBack();
    }

    public static function commit() {
        $db = self::_connect();
        return $db->commit();
    }

    public static function selectOne($tableName, $whereArray = NULL, $fieldArray = NULL, $orderArr = NULL) {
        $result = self::select($tableName, $whereArray, $fieldArray, $orderArr, 0, 1);
        if ($result && isset($result[0])) {
            return $result[0];
        } else {
            return null;
        }
    }

    public static function select($tableName, $whereArray = NULL, $fieldArray = NULL, $orderArr = NULL, $start = NULL, $limit = NULL) {
        if (!$tableName)
            return FALSE;
        $sql = "SELECT " . ($fieldArray ? '`' . implode('`,`', array_values($fieldArray)) . '`' : '*') . " FROM $tableName" . self::_condition($whereArray) . self::_order($orderArr);
        if (!empty($limit)) {
            $sql .= " LIMIT $start,$limit";
        }
//        echo $sql.'<br />';
        return self::query($sql);
    }

    public static function selectCount($tableName, $whereArray = NULL) {
        if (!$tableName)
            return FALSE;
        $sql = "SELECT count(1) as c FROM $tableName" . self::_condition($whereArray);
        $result = self::query($sql);
        return isset($result[0]['c']) ? (int) $result[0]['c'] : 0;
    }

    public static function insert($tableName, $dataArray, $needInsertId = FALSE) {
        if (!$tableName || !$dataArray)
            return FALSE;
        $sql = "INSERT INTO $tableName (`" . implode('`,`', array_keys($dataArray)) . "`) VALUES ('" . implode("','", array_values($dataArray)) . "')";
        $res = self::execute($sql);
        if ($needInsertId && $res) {
            $db = self::_connect();
            $id = $db->lastInsertId();
            return $id;
        }
        return $res;
    }

    public static function delete($tableName, $whereArray = NULL) {
        if (!$tableName || !$whereArray)
            return FALSE;
        $sql = "DELETE FROM $tableName" . self::_condition($whereArray);
        return self::execute($sql);
    }

    public static function update($tableName, $dataArray, $whereArray = NULL, $fieldArray = NULL) {
        if (!$tableName || !$dataArray)
            return FALSE;
        $setValue = '';
        foreach ($dataArray as $key => $value) {
            $setValue .= "`" . $key . "` = '" . $value . "',";
        }
        $sql = "UPDATE $tableName SET " . substr($setValue, 0, -1) . self::_condition($whereArray);
        return self::execute($sql);
    }

    public static function query($sql) {
        $db = self::_connect();
        try {
            $result = $db->prepare($sql);
            self::$_sql = $sql;
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    public static function execute($sql) {
        $db = self::_connect();
        try {
            $result = $db->prepare($sql);
            self::$_sql = $sql;
            $res = $result->execute();
            return FALSE === $res ? FALSE : TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public static function getLastSQL() {
        return self::$_sql;
    }

    /**
     * 将where数组翻译成sql字符串
     * @param  where条件数组
     * @return sql条件结果
     */
    public static function tranferCondition($where) {
        return self::_condition($where);
    }

    private static function _condition($whereArray) {
        if ($whereArray) {
            $tmpArr = array();
            foreach ($whereArray as $key => $data) {
                $opt = '=';
                $val = $data;
                if (is_array($data)) {
                    if (isset($data['opt'])) {
                        $opt = $data['opt'];
                        $val = $data['val'];
                        //$val = $data['val'];
                        if (isset($data['valex'])) {
                            $valex = $data['valex'];
                        }
                    } else {
                        foreach ($data as $dal) {
                            $tmpArr[] = "{$key} " . $dal['opt'] . " '" . $dal['val'] . "'";
                        }
                        continue;
                    }
                }

                if ($opt == 'in' || $opt == 'not in') {
                    $tmpArr[] = "`{$key}` {$opt} ({$val})";
                } else if ($opt == 'like') {
                    $tmpArr[] = "`{$key}` {$opt} '%{$val}%'";
                } else if ($opt == 'between') {
                    $tmpArr[] = "`{$key}` >= '{$val}' and `{$key}` <= '{$valex}'";
                } else {
                    $tmpArr[] = "`{$key}` {$opt} '{$val}'";
                }
            }
            return " WHERE " . implode(" AND ", $tmpArr);
            //print_r($tmpArr);
        }
        return "";
    }

    private static function _connect() {
        if (!is_object(self::$_db)) {
            try {
                global $MYSQL_CONFIG;
                $dsn = "mysql:host=" . $MYSQL_CONFIG['db_host'] . ";dbname=" . $MYSQL_CONFIG['db_name'] . ";";
                self::$_db = new PDO($dsn, $MYSQL_CONFIG['db_user'], $MYSQL_CONFIG['db_passwd']);
                self::$_db->exec("SET NAMES UTF8;");
            } catch (PDOException $e) {
                return FALSE;
            }
        }
        return self::$_db;
    }

    private static function _order($orderArr) {
        if ($orderArr) {
            return " ORDER BY " . implode(",", $orderArr);
        }
        return "";
    }

}
