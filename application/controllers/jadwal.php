<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

	public $data 	= 	array();

	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
		// parent::__construct(); for CI 2.x users
 
		$this->load->helper('url'); //You should autoload this one ;)
		$this->load->helper('ckeditor');
 
 
		//Ckeditor's configuration
		$this->data['ckeditor'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'assets/ckeditor/',
 
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"550px",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
 
			),
 
			//Replacing styles from the "Styles tool"
			'styles' => array(
 
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 	=> 	'Blue',
						'font-weight' 	=> 	'bold'
					)
				),
 
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 	=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 		=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)				
			)
		);
 
		$this->data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content_2',
			'path'	=>	'js/ckeditor',
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"550px",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
				'toolbar' 	=> 	array(	//Setting a custom toolbar
					array('Bold', 'Italic'),
					array('Underline', 'Strike', 'FontSize'),
					array('Smiley'),
					'/'
				)
			),
 
			//Replacing styles from the "Styles tool"
			'styles' => array(
 
				//Creating a new style named "style 1"
				'style 3' => array (
					'name' 		=> 	'Green Title',
					'element' 	=> 	'h3',
					'styles' => array(
						'color' 	=> 	'Green',
						'font-weight' 	=> 	'bold'
					)
				)
 
			)
		);		
 
 
	}

	function index()
	{
		// if (!$this->tank_auth->is_logged_in()) {
		// 	redirect('/auth/login/');
		// } else {

		
			$this->load->model('m_halaman');
			$this->load->model('m_calon');
			$data['standar_nilai']="6.0";

			$isi=$this->input->post('halaman_isi');
			$halaman=$this->m_halaman->get(2);
			$data['halaman_isi']=$halaman['halaman_isi'];
			$data['halaman_judul']=$halaman['halaman_judul'];
			$data['title']="Jadwal";
			$data['is_logged_in']=$this->tank_auth->is_logged_in();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['base_url']=$this->config->base_url();
			$this->load->view('header', $data);
			$this->load->view('v_halaman', $data);
			$this->load->view('sidebar');
			$this->load->view('footer');


		// }
	}
		function update()
	{

			$this->load->model('m_halaman');
			$this->load->model('m_calon');
			$data['standar_nilai']="6.0";
			$data['is_logged_in']=$this->tank_auth->is_logged_in();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['base_url']=$this->config->base_url();
		
	if ($this->m_calon->get_level($data['user_id'])!='admin') {
			redirect('/auth/login/');
		} else {
			$isi=$this->input->post('halaman_isi');
			$halaman=$this->m_halaman->get(2);
			$data['halaman_isi']=$halaman['halaman_isi'];
			$data['halaman_judul']=$halaman['halaman_judul'];
			$this->m_halaman->update(2,$isi);

		}
		redirect('/'.$data['halaman_judul'], 'refresh');

	}

	function edit(){
			$this->load->model('m_halaman');
			$this->load->model('m_calon');
			$data['standar_nilai']="6.0";
			
			$data['is_logged_in']=$this->tank_auth->is_logged_in();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
	
		if ($this->m_calon->get_level($data['user_id'])!='admin') {
			redirect('/auth/login/');
		} else {
			$halaman=$this->m_halaman->get(2);
			$data['halaman_isi']=$halaman['halaman_isi'];
			$data['halaman_judul']=$halaman['halaman_judul'];
			$data['title']="Jadwal";
			$data['base_url']=$this->config->base_url();
			$this->load->view('header', $data);
			$this->load->view('v_halaman_edit', $this->data);
			$this->load->view('sidebar');
			$this->load->view('footer');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */