<?php

class Data_saldo extends CI_Model
{
    function saldo_terkini()
    {
        return $this->db->get('saldo_terkini');
    }

    function edit_saldo_terkini($where)
    {
        return $this->db->get_where('saldo_terkini', $where);
    }

    function update_saldo_terkini($where, $data)
    {
        $this->db->where($where);
        $this->db->update('saldo_terkini', $data);
    }

    function datasaldo()
    {
        return $this->db->get('saldo');
    }


    function edit_saldo($where, $table)
    {
        return $this->db->get_where($table, $where);
    }


    function update_saldo($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function hapus_saldo($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
