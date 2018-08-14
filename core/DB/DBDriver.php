<?php

namespace core\DB;


class DBDriver
{
    const FETCH_ALL = true;
    const FETCH_ONE = false;

    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function select($table, array $params = [], $fetch = self::FETCH_ALL)
    {
        if($fetch == self::FETCH_ALL){

            $sql = "SELECT * FROM {$table} ORDER BY id DESC";
            return  $this->query($sql)->fetchAll();
        }

        if($fetch == self::FETCH_ONE){

            $sql = "SELECT * FROM {$table} WHERE id=:id";
            return $this->query($sql, $params)->fetch();
        }

        return false;
    }

    public function update($table, $params)
    {
        $query ='';
        foreach ($params as $key => $param){
            if($key != 'id'){
                $query .= sprintf("%s = :%s, ", $key, $key);
            }
        }
        $query = substr($query, 0, -2);

        $sql = sprintf('UPDATE %s SET %s WHERE`id`=:id', $table, $query);

        return $this->query($sql, $params);
    }


    public function create($table, $params)
    {
        $columns  = sprintf('(%s)', implode(', ', array_keys($params)));
        $masks  = sprintf('(:%s)', implode(', :', array_keys($params)));

        $sql = sprintf('INSERT INTO %s %s VALUES %s', $table, $columns, $masks);

        if(is_string($result = $this->query($sql, $params))){
            var_dump($result);
            return $result;
        }

        return $this->pdo->lastInsertId();

    }

    public function delete($table, $params)
    {
        $sql = $sql = sprintf('DELETE FROM %s WHERE id=:id', $table);

        return $this->query($sql, $params);
    }


    private function query($sql, array $params=[])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);

        return $this->dbCheckError($query);
    }


    protected function dbCheckError($query)
    {
        $info = $query->errorInfo();
        if ($info[0] != \PDO::ERR_NONE) {
            return $info[2];
        } else return $query;
    }


}
