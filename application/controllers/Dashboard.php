<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth');
		}
		$this->load->model('Dashboard_model', 'dashboard');
		$this->user = $this->ion_auth->user()->row();
	}

	public function admin_box()
	{
		$box = [
			[
				'box' 		=> 'yellow',
				'total' 	=> $this->dashboard->total('themes'),
				'title'		=> 'themes',
				'text'      => 'Темы курсов',
				'icon'		=> 'th-large'
			],
			[
				'box' 		=> 'green',
				'total' 	=> $this->dashboard->total('classes'),
				'title'		=> 'classes',
				'text'      => 'Группы',
				'icon'		=> 'building-o'
			],
			[
				'box' 		=> 'blue',
				'total' 	=> $this->dashboard->total('lecturer'),
				'title'		=> 'lecturer',
				'text'      => 'Преподаватели',
				'icon'		=> 'users'
			],
			[
				'box' 		=> 'red',
				'total' 	=> $this->dashboard->total('students'),
				'title'		=> 'students',
				'text'      => 'Студенты',
				'icon'		=> 'graduation-cap'
			],
			[
				'box' 		=> 'maroon',
				'total' 	=> $this->dashboard->total('courses'),
				'title'		=> 'courses',
				'text'      => 'Курсы',
				'icon'		=> 'th'
			],
			[
				'box' 		=> 'aqua',
				'total' 	=> $this->dashboard->total('tb_soal'),
				'title'		=> 'soal',
				'text'      => 'Вопросы',
				'icon'		=> 'file-text'
			],
			[
				'box' 		=> 'purple',
				'total' 	=> $this->dashboard->total('h_ujian'),
				'title'		=> 'hasilujian',
				'text'      => 'Полученные результаты',
				'icon'		=> 'file'
			],
			[
				'box' 		=> 'olive',
				'total' 	=> $this->dashboard->total('users'),
				'title'		=> 'users',
				'text'      => 'Пользователи системы',
				'icon'		=> 'key'
			],
		];
		$info_box = json_decode(json_encode($box), FALSE);
		return $info_box;
	}

	public function index()
	{
		$user = $this->user;
		$data = [
			'user' 		=> $user,
			'judul'		=> 'Панель управления',
			'subjudul'	=> 'Данные приложения',
		];

		if ( $this->ion_auth->is_admin() ) {
			$data['info_box'] = $this->admin_box();
		} elseif ( $this->ion_auth->in_group('Lecturer') ) {
			$courses = ['courses' => 'lecturer.courses_id=courses.id_courses'];
			$data['lecturer'] = $this->dashboard->get_where('lecturer', 'nip', $user->username, $courses)->row();

			$classes = ['classes' => 'classes_lecturer.classes_id=classes.id_classes'];
			$data['classes'] = $this->dashboard->get_where('classes_lecturer', 'lecturer_id' , $data['lecturer']->id_lecturer, $classes, ['name_classes'=>'ASC'])->result();
		}else{
			$join = [
				'classes b' 	=> 'a.classes_id = b.id_classes',
				'themes c'	=> 'b.themes_id = c.id_themes'
			];
			$data['students'] = $this->dashboard->get_where('students a', 'nim', $user->username, $join)->row();
		}

		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('dashboard');
		$this->load->view('_templates/dashboard/_footer.php');
	}
}