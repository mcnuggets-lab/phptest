<?php
class Questions_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_questions() {
                $query = $this->db->get("questions");
                return $query->result_array();
        }

}