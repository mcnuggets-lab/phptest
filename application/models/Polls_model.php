<?php
class Polls_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_polls() {
                $query = $this->db->get("polls");
                return $query->result_array();
        }

}