<?php
class Polls extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('polls_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['polls'] = $this->polls_model->get_polls();
                $data['title'] = 'Polls';

                $this->load->view('templates/header', $data);
                $this->load->view('polls/index', $data);
                $this->load->view('templates/footer');
        }

        public function view()
        {
                $data['polls_item'] = $this->polls_model->get_polls();

                if (empty($data['polls_item']))
                {
                        $this->load->view('templates/header', $data);
                        $this->load->view('polls/empty', $data);
                        $this->load->view('templates/footer');
                }

                $data['question'] = $data['polls_item']['question'];

                $this->load->view('templates/header', $data);
                $this->load->view('polls/view', $data);
                $this->load->view('templates/footer');
        }
}