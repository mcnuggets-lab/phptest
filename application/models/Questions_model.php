<?php
class Questions_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_questions($starting = true) {
                if ($starting == true) {
                        // Only starting questions will be considered by default.
                        $query = $this->db->get_where("questions", array('starting' => true));
                }
                else if ($starting == false) {
                        // Consider all questions if $starting == false.
                        $query = $this->db->get("questions");
                }
                return $query->result_array();
        }

        public function get_question_with_id($id) {
                $query = $this->db->get_where("questions", array('id' => $id));
                return $query->row_array();
        }

        public function get_input_type($id) {
                $query = $this->db->get_where("questions", array('id' => $id))->row_array();
                $type_id = $query['input_type_id'];
                $query = $this->db->get_where("input_types", array('id' => $type_id))->row_array();
                return $query['type'];
        }

}