<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Themes extends CI_Controller
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
			'judul'	=> 'Темы',
			'subjudul' => 'Данные тем'
		];
		$this->load->view('_templates/dashboard/_header', $data);
		$this->load->view('master/themes/data');
		$this->load->view('_templates/dashboard/_footer');
	}

	public function add()
	{
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Добавить тему',
			'subjudul'	=> 'Добавить данные',
			'banyak'	=> $this->input->post('banyak', true)
		];
		$this->load->view('_templates/dashboard/_header', $data);
		$this->load->view('master/themes/add');
		$this->load->view('_templates/dashboard/_footer');
	}

	public function data()
	{
		$this->output_json($this->master->getDatathemes(), false);
	}

	public function edit()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			redirect('themes');
		} else {
			$themes = $this->master->getthemesById($chk);
			$data = [
				'user' 		=> $this->ion_auth->user()->row(),
				'judul'		=> 'Редактировать тему',
				'subjudul'	=> 'Редактировать данные',
				'themes'	=> $themes
			];
			$this->load->view('_templates/dashboard/_header', $data);
			$this->load->view('master/themes/edit');
			$this->load->view('_templates/dashboard/_footer');
		}
	}

	public function save()
	{
		$rows = count($this->input->post('name_themes', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			$name_themes = 'name_themes[' . $i . ']';
			$this->form_validation->set_rules($name_themes, 'Тема', 'required');
			$this->form_validation->set_message('required', '{field} Required');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$name_themes => form_error($name_themes)
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'name_themes' => $this->input->post($name_themes, true)
					];
				} else if ($mode == 'edit') {
					$update[] = array(
						'id_themes'	=> $this->input->post('id_themes[' . $i . ']', true),
						'name_themes' 	=> $this->input->post($name_themes, true)
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('themes', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('themes', $update, 'id_themes', null, true);
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
			if ($this->master->delete('themes', $chk, 'id_themes')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

	public function load_themes()
	{
		$data = $this->master->getthemes();
		$this->output_json($data);
	}
//--------------импорт--------------------------
//----------------------------------------------
}