<?php
class Statics extends CI_Controller {

        public function view($page1 = 'index.html', $page2 = '')
        {
			$base_dir = APPPATH.'/views/statics/';
			$temp_page = $page1;
			if ($page2) {
				$temp_page .= '/'.$page2;
			}
		if ( ! file_exists($base_dir.$temp_page) || preg_match('^\S+\.\S+^', $temp_page) === false)
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }
			
            else {
                    //$data['title'] = ucfirst($page); // Capitalize the first letter

                    $this->load->view('templates/header');
                    $this->load->view('statics/'.$temp_page);
                    $this->load->view('templates/footer');
            }
        }
}