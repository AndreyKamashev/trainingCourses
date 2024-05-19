<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classeslecturer extends CI_Controller {

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
			'judul'	=> 'Преподаватель-группы',
			'subjudul'=> 'преподаватели – группы'
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('relasi/classeslecturer/data');
		$this->load->view('_templates/dashboard/_footer.php');
    }

    public function data()
    {
        $this->output_json($this->master->getclasseslecturer(), false);
	}
	
	public function add()
	{
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Добавить',
			'subjudul'	=> 'Добавить преподавателя и группы',
			'lecturer'		=> $this->master->getAlllecturer(),
			'classes'	    => $this->master->getAllclasses()
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('relasi/classeslecturer/add');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function edit($id)
	{
		$data = [
			'user' 			=> $this->ion_auth->user()->row(),
			'judul'			=> 'Редактировать',
			'subjudul'		=> 'Редактировать пр.группы',
			'lecturer'			=> $this->master->getlecturerById($id),
			'id_lecturer'		=> $id,
			'all_classes'	    => $this->master->getAllclasses(),
			'classes'		    => $this->master->getclassesBylecturer($id)
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('relasi/classeslecturer/edit');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function save()
	{
		$method = $this->input->post('method', true);
		$this->form_validation->set_rules('lecturer_id', 'Преподаватель', 'required');
		$this->form_validation->set_rules('classes_id[]', 'Группы', 'required');
	
		if($this->form_validation->run() == FALSE){
			$data = [
				'status'	=> false,
				'errors'	=> [
					'lecturer_id' => form_error('lecturer_id'),
					'classes_id[]' => form_error('classes_id[]'),
				]
			];
			$this->output_json($data);
		}else{
			$lecturer_id = $this->input->post('lecturer_id', true);
			$classes_id = $this->input->post('classes_id', true);
			$input = [];
			foreach ($classes_id as $key => $val) {
				$input[] = [
					'lecturer_id'  => $lecturer_id,
					'classes_id' => $val
				];
			}
			if($method==='add'){
				$action = $this->master->create('classes_lecturer', $input, true);
			}else if($method==='edit'){
				$id = $this->input->post('lecturer_id', true);
				$this->master->delete('classes_lecturer', $id, 'lecturer_id');
				$action = $this->master->create('classes_lecturer', $input, true);
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
            if($this->master->delete('classes_lecturer', $chk, 'lecturer_id')){
                $this->output_json(['status'=>true, 'total'=>count($chk)]);
            }
        }
	}
}