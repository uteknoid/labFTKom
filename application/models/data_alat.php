<?php

class Data_alat extends CI_Model
{
    function dataalat()
    {
        return $this->db->get('alat');
    }

    function dataruang()
    {
        return $this->db->get('ruang_lab');
    }


    function edit_alat($where, $table)
    {
        return $this->db->get_where($table, $where);
    }


    function update_alat($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function hapus_alat($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
