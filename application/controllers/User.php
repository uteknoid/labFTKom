<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    
    public function index(){

        $data['user'] = $this->db->get_where('user', ['npm' => 
        $this->session->userdata('npm')])->row_array();

        echo 'Selamat Datang '. $data['user']['name'];

    }

}