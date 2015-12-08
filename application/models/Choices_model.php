<?php
class Choices_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_choices($id) {
                $query = $this->db->get_where("choices", array('question_id' => $id));
                return $query->result_array();
        }

}