<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Students extends CI_Controller
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
			'judul'	=> 'Студенты',
			'subjudul' => 'Данные студентов'
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/students/data');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function data()
	{
		$this->output_json($this->master->getDatastudents(), false);
	}

	public function add()
	{
		//--------------------------------------------
			$student_last_id= $this->master->get_last_id_students();
			$cnt = $student_last_id + 1;
			$cnt_id = 10000000 + $cnt;
		//--------------------------------------------
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Добавить студента',
			'subjudul' => 'Добавить данные',
			'nimValue' => $cnt_id
		];
		
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/students/add', $data);
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function edit($id)
	{
		$mhs = $this->master->getstudentsById($id);
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Редактировать студента',
			'subjudul'	=> 'Редактировать данные',
			'themes'	=> $this->master->getthemes(),
			'classes'		=> $this->master->getclassesBythemes($mhs->themes_id),
			'students' => $mhs
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/students/edit');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function validasi_students($method)
	{
		$id_students 	= $this->input->post('id_students', true);
		$nim 			= $this->input->post('nim', true);
		$email 			= $this->input->post('email', true);
		if ($method == 'add') {
			$u_nim = '|is_unique[students.nim]';
			$u_email = '|is_unique[students.email]';
		} else {
			$dbdata 	= $this->master->getstudentsById($id_students);
			$u_nim		= $dbdata->nim === $nim ? "" : "|is_unique[students.nim]";
			$u_email	= $dbdata->email === $email ? "" : "|is_unique[students.email]";
		}
		$this->form_validation->set_rules('nim', 'Личн.номер', 'required|numeric|trim|min_length[8]|max_length[12]' . $u_nim);
		$this->form_validation->set_rules('name', 'ФИО', 'required|trim|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $u_email);
		$this->form_validation->set_rules('jenis_kelamin', 'Пол', 'required');
		$this->form_validation->set_rules('themes', 'Тема курсов', 'required');
		$this->form_validation->set_rules('classes', 'Группа', 'required');

		$this->form_validation->set_message('required', 'Поле {field} является обязательным.');
	}

	public function save()
	{
		$method = $this->input->post('method', true);
		$this->validasi_students($method);

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'status'	=> false,
				'errors'	=> [
					'nim' => form_error('nim'),
					'name' => form_error('name'),
					'email' => form_error('email'),
					'jenis_kelamin' => form_error('jenis_kelamin'),
					'themes' => form_error('themes'),
					'classes' => form_error('classes'),
				]
			];
			$this->output_json($data);
		} else {
			
			$input = [
				'nim' 			=> $this->input->post('nim', true),
				'email' 		=> $this->input->post('email', true),
				'name' 			=> $this->input->post('name', true),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
				'classes_id' 		=> $this->input->post('classes', true),
			];
			if ($method === 'add') {
				$action = $this->master->create('students', $input);
			} else if ($method === 'edit') {
				$id = $this->input->post('id_students', true);
				$action = $this->master->update('students', $input, 'id_students', $id);
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
			if ($this->master->delete('students', $chk, 'id_students')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

	public function create_user()
	{
		$id = $this->input->get('id', true);
		$data = $this->master->getstudentsById($id);
		$name = explode(' ', $data->name);
		$first_name = $name[0];
		$last_name = end($name);

		$username = $data->nim;
		$password = $data->nim;
		$email = $data->email;
		$additional_data = [
			'first_name'	=> $first_name,
			'last_name'		=> $last_name
		];
		$group = array('3'); // Sets user to dosen.

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