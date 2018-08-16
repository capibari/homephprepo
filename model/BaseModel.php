<?php

namespace model;

use core\DB\DBDriver;
use core\Exception\ValidateException;
use core\Validators\FormValidate;

abstract class BaseModel
{
    protected $db;
    protected $table;
    protected $validate;

    public function __construct(DBDriver $db, FormValidate $validate, $table)
    {
        $this->validate = $validate;
        $this->db = $db;
        $this->table = $table;
    }

    public function getAll()
    {
        return $this->db->select($this->table);
    }

    public function getById($id)
    {
        $params = ['id' => $id];

        return $this->db->select($this->table, $params, DBDriver::FETCH_ONE);
    }

    public function delete($id)
    {
        $params = ['id' => $id];

        return $this->db->delete($this->table, $params);
    }

    public function create($params)
    {
        $this->validate->execute($params);

        if(!$this->validate->getSuccess()){
            throw new ValidateException($this->validate->getErrors());
        }

        $params = $this->validate->getResult();

        return $this->db->create($this->table, $params);

    }


    public function update($params)
    {
        $this->validate->execute($params);

        if(!$this->validate->getSuccess()){
            throw new ValidateException($this->validate->getErrors());
        }

        $params = $this->validate->getResult();

        return $this->db->update($this->table, $params);
    }

}