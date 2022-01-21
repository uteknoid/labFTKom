<?php

class Data_pengeluaran extends CI_Model
{
    function datapengeluaran()
    {
        return $this->db->get('pengeluaran');
    }


    function edit_pengeluaran($where, $table)
    {
        return $this->db->get_where($table, $where);
    }


    function update_pengeluaran($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function hapus_pengeluaran($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function pengeluaran_terbaru()
    {
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('pengeluaran');
    }
}
