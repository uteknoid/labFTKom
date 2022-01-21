<?php

class Data_pinlab extends CI_Model
{
    function datapinlab()
    {
        return $this->db->get('jadwal _lab');
    }


    function edit_pinlab($where, $table)
    {
        return $this->db->get_where($table, $where);
    }


    function update_pinlab($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function kembalikan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function hapus_pinlab($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
