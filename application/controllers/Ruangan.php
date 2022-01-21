<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends CI_Controller {

    public function __construct()
    {

        parent::__construct();
        $this->load->model('data_lab');
        $this->load->model('data_pinjam');
    }

    public function index(){

        date_default_timezone_set('Asia/Makassar');

        $date = new DateTime("now");

        $curr_date = $date->format('Y-m-d');

        $whel1 = array('ruang' => 'Lab 1', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        $whel2 = array('ruang' => 'Lab 2', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        $whel3 = array('ruang' => 'Lab 3', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        $whel4 = array('ruang' => 'Lab 4', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        $whel5 = array('ruang' => 'Lab 5', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        $whel6 = array('ruang' => 'Lab 6', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');

        $data['lab1'] = $this->data_lab->lab1($whel1, 'jadwal_lab')->result();
        $data['lab2'] = $this->data_lab->lab2($whel2, 'jadwal_lab')->result();
        $data['lab3'] = $this->data_lab->lab3($whel3, 'jadwal_lab')->result();
        $data['lab4'] = $this->data_lab->lab4($whel4, 'jadwal_lab')->result();
        $data['lab5'] = $this->data_lab->lab5($whel5, 'jadwal_lab')->result();
        $data['lab6'] = $this->data_lab->lab6($whel6, 'jadwal_lab')->result();


        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        $data['title'] = 'LAB FTKOM UNCP ';
        $this->load->view('ruangan/ruangan', $data);

}

}