<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Courses extends CI_Controller
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
			'judul'	=> 'Курсы',
			'subjudul' => 'Данные курсов'
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/courses/data');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function data()
	{
		$this->output_json($this->master->getDatacourses(), false);
	}

	public function add()
	{
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Добавить курс',
			'subjudul'	=> 'Добавить данные',
			'banyak'	=> $this->input->post('banyak', true)
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/courses/add');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function edit()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			redirect('courses');
		} else {
			$courses = $this->master->getcoursesById($chk);
			$data = [
				'user' 		=> $this->ion_auth->user()->row(),
				'judul'		=> 'Редактировать курс',
				'subjudul'	=> 'Редактировать данные',
				'courses'	=> $courses
			];
			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('master/courses/edit');
			$this->load->view('_templates/dashboard/_footer.php');
		}
	}

	public function save()
	{
		$rows = count($this->input->post('name_courses', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			$name_courses = 'name_courses[' . $i . ']';
			$this->form_validation->set_rules($name_courses, 'Курс', 'required');
			$this->form_validation->set_message('required', '{field} Required');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$name_courses => form_error($name_courses)
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'name_courses' => $this->input->post($name_courses, true)
					];
				} else if ($mode == 'edit') {
					$update[] = array(
						'id_courses'	=> $this->input->post('id_courses[' . $i . ']', true),
						'name_courses' 	=> $this->input->post($name_courses, true)
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('courses', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('courses', $update, 'id_courses', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		$this->output_json($data);
	}

	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('courses', $chk, 'id_courses')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}
//---------------------------------------------------
//---------------------------------------------------
}
