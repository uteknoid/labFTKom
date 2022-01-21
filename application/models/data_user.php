<?php

class Data_user extends CI_Model
{
    function datauser()
    {
        return $this->db->get('user');
    }


    function edit_user($where, $table)
    {
        return $this->db->get_where($table, $where);
    }


    function update_user($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function hapus_user($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
