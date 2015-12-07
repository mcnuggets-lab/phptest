<?php
class Questions extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('questions_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['questions'] = $this->questions_model->get_questions();
                $data['title'] = 'Questions';

                $this->load->view('templates/header', $data);
                $this->load->view('polls/index', $data);
                $this->load->view('templates/footer');
        }

        public function view()
        {
                $data['questions_item'] = $this->questions_model->get_questions();

                if (empty($data['questions_item']))
                {
                        show_404();
                }

                $data['question'] = $data['questions_item']['question'];

                $this->load->view('templates/header', $data);
                $this->load->view('polls/view', $data);
                $this->load->view('templates/footer');
        }
}
