<?php
class Setting_model extends CI_Model
{
    public $tableName = "settings";

    public function __construct()
    {
        parent::__construct();
    }
    /** belirtilen kaydı getirir
     * @param array $where
     * @return
     */
    public function get($where = [])
    {
        return $this->db->where($where)->get($this->tableName)->row();
    }

    /** tüm kayıtları listeler
     * @param array $where
     * @return
     */
    public function get_all($where = [], $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    public function add($data = array())
    {
        return $this->db->insert($this->tableName, $data);
    }

    public function edit($where = array(), $data = array())
    {
        return $this->db->where($where)->update($this->tableName, $data);
    }

    public function delete($where = [])
    {
        return $this->db->where($where)->delete($this->tableName);
    }
}