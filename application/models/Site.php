<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @package Site :  CodeIgniter Site
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *   
 * Description of Site Controller
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Model {
    private $_userID;
    private $_url;
    public function setUserID($userID) {
        $this->_userID = $userID;
    }
    public function seturl($url) {
        $this->_url = $url;
    }
    // get user details
    public function getUserDetails() {
        $this->db->select(array('m.id as user_id', 'CONCAT(m.first_name, " ", m.last_name) as full_name', 'm.first_name', 'm.last_name', 'm.email', 'm.contact_no', 'm.address', 'm.dob', 'up.url'));
        $this->db->from('users as m');
        $this->db->join('users_profile_picture as up', 'm.id=up.user_id');
        $this->db->where('m.id', $this->_userID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }
    public function setMemberProfilePicture() {
        $tableName = 'users_profile_picture';
        $this->db->select(array('lpp.id', 'lpp.url', 'lpp.user_id'));
        $this->db->from($tableName . ' as lpp');
        $this->db->where('lpp.user_id', $this->_userID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = array(
                'url' => $this->_url
            );
            $this->db->where('user_id', $this->_userID);
            $this->db->update($tableName, $data);
        } else {
            $data = array(
                'url' => $this->_url,
                'user_id' => $this->_userID
            );
            $this->db->insert($tableName, $data);
        }
    }

}
