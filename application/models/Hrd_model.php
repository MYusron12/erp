<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hrd_model extends CI_Model{
    public function queryGetAllObat()
    {
        $query = "select max(id)+1 as total from master_obat";
        return $this->db->query($query)->result();
    }
}