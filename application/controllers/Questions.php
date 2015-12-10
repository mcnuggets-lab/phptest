<?php
class Questions extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('questions_model');
                $this->load->model('choices_model');
                $this->load->helper(array('url_helper', 'form'));
                $this->load->library('form_validation');
                $this->load->library('session');
        }

        public function index()
        {
                $data['questions'] = $this->questions_model->get_questions();
                if (empty($data['questions']))
                {
                        $this->load->view('templates/header', $data);
                        $this->load->view('polls/noquestions', $data);
                        $this->load->view('templates/footer');
                }
                else {
                        $data['title'] = 'Questions';

                        $this->load->view('templates/header', $data);
                        $this->load->view('polls/index', $data);
                        $this->load->view('templates/footer');
                }
        }

        public function view($id = NULL)
        {
                $data['question_item'] = $this->questions_model->get_question_with_id($id);
                $data['choices'] = $this->choices_model->get_choices($id);
                $data['input_type'] = $this->questions_model->get_input_type($id);
				$starting = $data['question_item']['starting'];
				$data['id'] = $id;
				$data['starting'] = $starting;

                if (empty($data['question_item']) || (($this->session->key != $id) && ($starting == FALSE)))
                {
                        show_404();
                }
                else if (empty($data['choices'])) {
					
						$data['title'] = $data['question_item']['question_text'];
						
                        $this->load->view('templates/header', $data);
                        $this->load->view('polls/nochoices', $data);
                        $this->load->view('templates/footer');
                }
                else {
                        $data['title'] = $data['question_item']['question_text'];

                        $this->load->view('templates/header', $data);
                        $this->load->view('polls/view', $data);
                        $this->load->view('templates/footer');
                }
        }

        public function submit($id = NULL)
        {
                $input_type = $this->questions_model->get_input_type($id);

                if ($input_type == 'radio') {

                        $this->form_validation->set_rules('choices', 'A choice', 'required');
                        if ($this->form_validation->run() === FALSE)
                        {
                    
                                $this->session->set_flashdata('errors', 'Please select a choice.');
                                redirect(base_url('/polls/'.$id));

                        }
                }
                else if ($input_type == 'checkbox') {
					
                        $this->form_validation->set_rules('choices[]', 'A choice', 'required');
						if ($this->form_validation->run() === FALSE)
                        {
                    
                                $this->session->set_flashdata('errors', 'Please select at least one choice.');
                                redirect(base_url('/polls/'.$id));

                        }
                }
                
                
                $data['choices'] = $this->input->post('choices');
                $this->choices_model->vote($data['choices'], $input_type);
                if ($input_type == 'radio') {
					$this->session->set_userdata('key', $data['choices']);
				}
                redirect(base_url('/polls/results/'.$id));

                

        }

        public function results($id = NULL) {

                $data['question_item'] = $this->questions_model->get_question_with_id($id);
                $data['choices'] = $this->choices_model->get_choices($id);
                $data['input_type'] = $this->questions_model->get_input_type($id);
				$data['chart_type'] = $this->questions_model->get_chart_type($id);
				if ($this->session->key) {
					$key = $this->session->key;
					$data['followup_id'] = $this->choices_model->get_followup_question_id($key);
					if ($data['followup_id'] != NULL) {
						$this->session->set_userdata('key', (int)$data['followup_id']);
					}
					else $this->session->unset_userdata('key');
				}

                $data['title'] = 'Result';

                $this->load->view('templates/header', $data);
                $this->load->view('polls/results', $data);
                $this->load->view('templates/footer', $data);
        }

}
