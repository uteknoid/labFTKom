<?php

class Data_lab extends CI_Model
{

    function ruang()
    {
        return $this->db->get_where('ruang_lab');
    }

    function lab($where, $table)
    {
        $this->db->order_by('jam_akhir', 'DESC');
        return $this->db->get_where($table, $where);
    }
    
     function lab1($where, $table)
    {
        $this->db->order_by('jam_akhir', 'DESC');
        return $this->db->get_where($table, $where);
    }

    function lab2($where, $table)
    {
        $this->db->order_by('jam_akhir', 'DESC');
        return $this->db->get_where($table, $where);
    }

    function lab3($where, $table)
    {
        $this->db->order_by('jam_akhir', 'DESC');
        return $this->db->get_where($table, $where);
    }

    function lab4($where, $table)
    {
        $this->db->order_by('jam_akhir', 'DESC');
        return $this->db->get_where($table, $where);
    }

    function lab5($where, $table)
    {
        $this->db->order_by('jam_akhir', 'DESC');
        return $this->db->get_where($table, $where);
    }

    function lab6($where, $table)
    {
        $this->db->order_by('jam_akhir', 'DESC');
        return $this->db->get_where($table, $where);
    }
}
