<?php

class Data_pinjam extends CI_Model
{
    function datapinjam()
    {
        return $this->db->get('pinjam');
    }

    function datapinjam2($table)
    {
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get($table);
    }


    function edit_pinjam($where, $table)
    {
        return $this->db->get_where($table, $where);
    }


    function update_pinjam($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function kembalikan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function hapus_pinjam($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
