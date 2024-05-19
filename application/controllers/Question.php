<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}else if ( !$this->ion_auth->in_group('Lecturer') ){
			show_error('Только преподаватели имеют право доступа к этой странице, <a href="'.base_url('dashboard').'">На главную</a>', 403, 'Forbidden Access');
		}
		$this->load->library(['datatables', 'form_validation']);// Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
		$this->load->model('Question_model', 'question');
	}

	public function output_json($data, $encode = true)
	{
        if($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
    }

    public function index()
	{
        $user = $this->ion_auth->user()->row();
		$data = [
			'user' => $user,
			'judul'	=> 'Вопросы к студентам',
			'subjudul'=> 'Данные вопросов'
        ];
                  
        $data['questions'] = $this->question->getDataQuestion($user->username);
       
        $this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('question/data');
		$this->load->view('_templates/dashboard/_footer.php');
    }
   //---------------add--------------------
	public function add() {
		
		$this->form_validation->set_rules('name_questions','Вопрос','required|trim');
		$this->form_validation->set_rules('id_students','Студент','required');
	
		if($this->form_validation->run() === TRUE){ 
			//----------------------------------------
			$name_questions=$this->input->post('name_questions');
			$id_students=$this->input->post('id_students');	
			$user = $this->ion_auth->user()->row();
			$lecturer_id = $this->question->getlecturerId($user->username);
			$date_create = date('Y-m-d');
			$this->question->createquest($name_questions,$id_students,$lecturer_id->id_lecturer,$date_create);
		} else {
			//-------------load add-------------------
			  $user = $this->ion_auth->user()->row();
				$data = [
					'user' => $user,
					'judul'	=> 'Вопросы к студентам',
					'subjudul'=> 'Добавить вопрос',
					'students'	=> $this->question->getDataStudents($user->username)
				];
							   
				$this->load->view('_templates/dashboard/_header.php', $data);
				$this->load->view('question/add');
				$this->load->view('_templates/dashboard/_footer.php');		
		}
	}
	 //---------------edit--------------------
	public function edit($id) {
		
		$this->form_validation->set_rules('name_questions','Вопрос','required|trim');
		$this->form_validation->set_rules('id_students','Студент','required');
		$this->form_validation->set_rules('score','Оценка','required|trim');
		
		if($this->form_validation->run() === TRUE){ 
			//----------------------------------------
			$name_questions=$this->input->post('name_questions');
			$id_students=$this->input->post('id_students');	
			$score=$this->input->post('score');	
			
			$this->question->editquest($id,$name_questions,$id_students,$score);
		} else {
			//-------------load edit-------------------
			  $user = $this->ion_auth->user()->row();
				$data = [
					'user' => $user,
					'judul'	=> 'Вопросы к студентам',
					'subjudul'=> 'Обновить вопрос',
					'students'	=> $this->question->getDataStudents($user->username),
					'data' 		=> $this->question->getquestionById($id)
				];
							   
				$this->load->view('_templates/dashboard/_header.php', $data);
				$this->load->view('question/edit');
				$this->load->view('_templates/dashboard/_footer.php');		
		}
	}
	//----------------delete-------------------------------
	public function delete($id){
		$this->question->deletequest($id);
		$this->session->set_flashdata('success', 'Вопрос успешно удален!');
		redirect('question');
	}

}