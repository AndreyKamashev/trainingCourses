<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classes extends CI_Controller
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
			'judul'	=> 'Группы',
			'subjudul' => 'Данные групп'
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/classes/data');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function data()
	{
		$this->output_json($this->master->getDataclasses(), false);
	}

	public function add()
	{
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Добавить группу',
			'subjudul'	=> 'Добавить данные',
			'banyak'	=> $this->input->post('banyak', true),
			'themes'	=> $this->master->getAllthemes()
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/classes/add');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function edit()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			redirect('admin/classes');
		} else {
			$classes = $this->master->getclassesById($chk);
			$data = [
				'user' 		=> $this->ion_auth->user()->row(),
				'judul'		=> 'Редактировать группу',
				'subjudul'	=> 'Редактировать данные',
				'themes'	=> $this->master->getAllthemes(),
				'classes'		=> $classes
			];
			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('master/classes/edit');
			$this->load->view('_templates/dashboard/_footer.php');
		}
	}

	public function save()
	{
		$rows = count($this->input->post('name_classes', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			$name_classes 	= 'name_classes[' . $i . ']';
			$themes_id 	= 'themes_id[' . $i . ']';
			$this->form_validation->set_rules($name_classes, 'Class', 'required');
			$this->form_validation->set_rules($themes_id, 'Dept.', 'required');
			$this->form_validation->set_message('required', '{field} Required');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$name_classes 	=> form_error($name_classes),
					$themes_id 	=> form_error($themes_id),
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'name_classes' 	=> $this->input->post($name_classes, true),
						'themes_id' 	=> $this->input->post($themes_id, true)
					];
				} else if ($mode == 'edit') {
					$update[] = array(
						'id_classes'		=> $this->input->post('id_classes[' . $i . ']', true),
						'name_classes' 	=> $this->input->post($name_classes, true),
						'themes_id' 	=> $this->input->post($themes_id, true)
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('classes', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('classes', $update, 'id_classes', null, true);
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
			if ($this->master->delete('classes', $chk, 'id_classes')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

	public function classes_by_themes($id)
	{
		$data = $this->master->getclassesBythemes($id);
		$this->output_json($data);
	}

	//--------------импорт--------------------------
	//----------------------------------------------
}