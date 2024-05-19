<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lecturer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		} else if (!$this->ion_auth->is_admin()) {
			show_error('Только администраторы имеют право доступа к этой странице, <a href="' . base_url('dashboard') . '">На главную</a>', 403, 'Forbidden Access');
		}
		$this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
		$this->form_validation->set_error_delimiters('', '');
	}

	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

	public function index()
	{
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Преподаватели',
			'subjudul' => 'Данные преподавателей'
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/lecturer/data');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function data()
	{
		$this->output_json($this->master->getDatalecturer(), false);
	}

	public function add()
	{
		//--------------------------------------------
			$lecturer_last_id= $this->master->get_last_id_lecturer();
			$cnt = $lecturer_last_id + 1;
			$cnt_id = 10000000 + $cnt;
		//--------------------------------------------
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Добавить преподавателя',
			'subjudul' => 'Добавить данные',
			'courses'	=> $this->master->getAllcourses(),
			'nimValue' => $cnt_id
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/lecturer/add', $data);
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function edit($id)
	{
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Редактировать преподавателя',
			'subjudul'	=> 'Редактировать данные',
			'courses'	=> $this->master->getAllcourses(),
			'data' 		=> $this->master->getlecturerById($id)
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/lecturer/edit');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function save()
	{
		$method 	= $this->input->post('method', true);
		$id_lecturer 	= $this->input->post('id_lecturer', true);
		$nip 		= $this->input->post('nip', true);
		$name_lecturer = $this->input->post('name_lecturer', true);
		$email 		= $this->input->post('email', true);
		$courses 	= $this->input->post('courses', true);
		if ($method == 'add') {
			$u_nip = '|is_unique[lecturer.nip]';
			$u_email = '|is_unique[lecturer.email]';
		} else {
			$dbdata 	= $this->master->getlecturerById($id_lecturer);
			$u_nip		= $dbdata->nip === $nip ? "" : "|is_unique[lecturer.nip]";
			$u_email	= $dbdata->email === $email ? "" : "|is_unique[lecturer.email]";
		}
		$this->form_validation->set_rules('nip', 'Лич.номер', 'required|numeric|trim|min_length[8]|max_length[12]' . $u_nip);
		$this->form_validation->set_rules('name_lecturer', 'Преподаватель', 'required|trim|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $u_email);
		$this->form_validation->set_rules('courses', 'Курсы', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'status'	=> false,
				'errors'	=> [
					'nip' => form_error('nip'),
					'name_lecturer' => form_error('name_lecturer'),
					'email' => form_error('email'),
					'courses' => form_error('courses'),
				]
			];
			$this->output_json($data);
		} else {
			$input = [
				'nip'			=> $nip,
				'name_lecturer' 	=> $name_lecturer,
				'email' 		=> $email,
				'courses_id' 	=> $courses
			];
			if ($method === 'add') {
				$action = $this->master->create('lecturer', $input);
			} else if ($method === 'edit') {
				$action = $this->master->update('lecturer', $input, 'id_lecturer', $id_lecturer);
			}

			if ($action) {
				$this->output_json(['status' => true]);
			} else {
				$this->output_json(['status' => false]);
			}
		}
	}

	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('lecturer', $chk, 'id_lecturer')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

	public function create_user()
	{
		$id = $this->input->get('id', true);
		$data = $this->master->getlecturerById($id);
		$name = explode(' ', $data->name_lecturer);
		$first_name = $name[0];
		$last_name = end($name);

		$username = $data->nip;
		$password = $data->nip;
		$email = $data->email;
		$additional_data = [
			'first_name'	=> $first_name,
			'last_name'		=> $last_name
		];
		$group = array('2'); // Sets user to lecturer.

		if ($this->ion_auth->username_check($username)) {
			$data = [
				'status' => false,
				'msg'	 => 'Имя пользователя недоступно (уже использовано).'
			];
		} else if ($this->ion_auth->email_check($email)) {
			$data = [
				'status' => false,
				'msg'	 => 'Электронная почта недоступна (уже используется).'
			];
		} else {
			$this->ion_auth->register($username, $password, $email, $additional_data, $group);
			$data = [
				'status'	=> true,
				'msg'	 => 'Пользователь успешно создан. Личн.номер используется в качестве пароля при входе в систему.'
			];
		}
		$this->output_json($data);
	}
	//--------------импорт--------------------------
	//----------------------------------------------
	
}