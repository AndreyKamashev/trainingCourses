<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class themescourses extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}else if (!$this->ion_auth->is_admin()){
			show_error('Только администраторы имеют право доступа к этой странице, <a href="'.base_url('dashboard').'">На главную</a>', 403, 'Forbidden Access');			
		}
		$this->load->library(['datatables', 'form_validation']);// Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
		$this->form_validation->set_error_delimiters('','');
	}

	public function output_json($data, $encode = true)
	{
        if($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
    }

    public function index()
	{
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Курс-темы',
			'subjudul'=> 'Данные курса-тем'
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('relasi/themescourses/data');
		$this->load->view('_templates/dashboard/_footer.php');
    }

    public function data()
    {
        $this->output_json($this->master->getthemescourses(), false);
	}

	public function getthemesId($id)
	{
		$this->output_json($this->master->getAllthemes($id));		
	}
	
	public function add()
	{
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Добавить курс-темы',
			'subjudul'	=> 'Добавить данные',
			'courses'	=> $this->master->getcourses()
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('relasi/themescourses/add');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function edit($id)
	{
		$data = [
			'user' 			=> $this->ion_auth->user()->row(),
			'judul'			=> 'Редактировать курс-темы',
			'subjudul'		=> 'Редактировать данные',
			'courses'		=> $this->master->getcoursesById($id, true),
			'id_courses'		=> $id,
			'all_themes'	=> $this->master->getAllthemes(),
			'themes'		=> $this->master->getthemesByIdcourses($id)
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('relasi/themescourses/edit');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function save()
	{
		$method = $this->input->post('method', true);
		$this->form_validation->set_rules('courses_id', 'Курс', 'required');
		$this->form_validation->set_rules('themes_id[]', 'Темы', 'required');
	
		if($this->form_validation->run() == FALSE){
			$data = [
				'status'	=> false,
				'errors'	=> [
					'courses_id' => form_error('courses_id'),
					'themes_id[]' => form_error('themes_id[]'),
				]
			];
			$this->output_json($data);
		}else{
			$courses_id 	= $this->input->post('courses_id', true);
			$themes_id = $this->input->post('themes_id', true);
			$input = [];
			foreach ($themes_id as $key => $val) {
				$input[] = [
					'courses_id' 	=> $courses_id,
					'themes_id'  	=> $val
				];
			}
			if($method==='add'){
				$action = $this->master->create('themes_courses', $input, true);
			}else if($method==='edit'){
				$id = $this->input->post('courses_id', true);
				$this->master->delete('themes_courses', $id, 'courses_id');
				$action = $this->master->create('themes_courses', $input, true);
			}
			$data['status'] = $action ? TRUE : FALSE ;
		}
		$this->output_json($data);
	}

	public function delete()
    {
        $chk = $this->input->post('checked', true);
        if(!$chk){
            $this->output_json(['status'=>false]);
        }else{
            if($this->master->delete('themes_courses', $chk, 'courses_id')){
                $this->output_json(['status'=>true, 'total'=>count($chk)]);
            }
        }
	}
}