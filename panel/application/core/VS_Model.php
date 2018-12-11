<?php

class VS_Model extends CI_Model {
    public $tableName = "";

    public function __construct()
    {
        parent::__construct();
    }

    public function get($where = [])
    {
        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function get_all($where = [], $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    public function add($data = array())
    {
        if(isAllowedWriteModule()){
            return $this->db->insert($this->tableName, $data);
        } else{
            return false;
        }
    }

    public function edit($where = array(), $data = array())
    {
        if(isAllowedEditModule()){
            return $this->db->where($where)->update($this->tableName, $data);
        } else{
            return false;
        }
    }

    public function delete($where = [])
    {
        if(isAllowedDeleteModule()){
            return $this->db->where($where)->delete($this->tableName);
        } else{
            return false;
        }
    }
}