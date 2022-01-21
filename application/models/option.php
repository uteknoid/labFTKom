<?php

class Option extends CI_Model
{
    function edit($where, $table)
    {
        return $this->db->get_where($table, $where);
    }


    function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
