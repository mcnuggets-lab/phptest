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

        public function vote($data, $input_type) {

                if ($input_type == 'radio') {

                        $this->db->set('votes', 'votes+1', FALSE);
                        $this->db->where('id', (int)$data);
                        $this->db->update('choices');

                }
                else if ($input_type = 'checkbox') {
                        
                        if (empty($data)) return;

                        foreach ($data as $choice_item):

                            $this->db->set('votes', 'votes+1', FALSE);
                            $this->db->where('id', (int)$choice_item);
                            $this->db->update('choices');

                        endforeach;

                }

        }

        // Given a choice id, return the followup question id, if any.
        public function get_followup_question_id($choice) {
                $query = $this->db->get_where("choices", array('id' => $choice))->row_array();
                return $query['followup_question_id'];
        }

}