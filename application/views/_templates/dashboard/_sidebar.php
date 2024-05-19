<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?=base_url()?>assets/dist/img/usersys-min.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?=$user->username?></p>
				<small><?=$user->email?></small>
			</div>
		</div>
		
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">ОПЕРАЦИИ</li>
			<!-- Optionally, you can add icons to the links -->
			<?php 
			$page = $this->uri->segment(1);
			$master = ["themes", "classes", "courses", "lecturer", "students"];
			$relasi = ["classeslecturer", "themescourses"];
			$users = ["users"];
			?>
			<li class="<?= $page === 'dashboard' ? "active" : "" ?>"><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> <span>Панель управления</span></a></li>
			<?php if($this->ion_auth->is_admin()) : ?>
			<li class="treeview <?= in_array($page, $master)  ? "active menu-open" : ""  ?>">
				<a href="#"><i class="fa fa-folder-open"></i> <span>Основные данные</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?=$page==='courses'?"active":""?>">
						<a href="<?=base_url('courses')?>">
							<i class="fa fa-bars"></i>
							 Курсы
						</a>
					</li>
					
					<li class="<?=$page==='themes'?"active":""?>">
						<a href="<?=base_url('themes')?>">
							<i class="fa fa-bars"></i> 
							 Темы курсов
						</a>
					</li>
					<li class="<?=$page==='lecturer'?"active":""?>">
						<a href="<?=base_url('lecturer')?>">
							<i class="fa fa-bars"></i>
							 Преподаватели
						</a>
					</li>
					
					<li class="<?=$page==='classes'?"active":""?>">
						<a href="<?=base_url('classes')?>">
							<i class="fa fa-bars"></i>
							 Группы
						</a>
					</li>
					
					<li class="<?=$page==='students'?"active":""?>">
						<a href="<?=base_url('students')?>">
							<i class="fa fa-bars"></i>
							 Студенты
						</a>
					</li>
				</ul>
			</li>
			<li class="treeview <?= in_array($page, $relasi)  ? "active menu-open" : ""  ?>">
				<a href="#"><i class="fa fa-link"></i> <span>Отношения</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?=$page==='classeslecturer'?"active":""?>">
						<a href="<?=base_url('classeslecturer')?>">
							<i class="fa fa-bars"></i>
							Преподаватель - группы
						</a>
					</li>
					<li class="<?=$page==='themescourses'?"active":""?>">
						<a href="<?=base_url('themescourses')?>">
							<i class="fa fa-bars"></i>
							Курс - темы
						</a>
					</li>
				</ul>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->is_admin() || $this->ion_auth->in_group('Lecturer') ) : ?>
			<li class="<?=$page==='soal'?"active":""?>">
				<a href="<?=base_url('soal')?>" rel="noopener noreferrer">
					<i class="fa fa-file-text"></i> <span>Вопросы</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->is_admin() || $this->ion_auth->in_group('Lecturer') ) : ?>
			<li class="<?=$page==='ujian'?"active":""?>">
				<a href="<?=base_url('ujian/master')?>" rel="noopener noreferrer">
					<i class="fa fa-pencil"></i> <span>Опросы</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->in_group('Lecturer') ) : ?>
			<li class="<?=$page==='question'?"active":""?>">
				<a href="<?=base_url('question')?>" rel="noopener noreferrer">
					<i class="fa fa-file-text"></i> <span>Вопросы к студентам</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( $this->ion_auth->in_group('Student') ) : ?>
			<li class="<?=$page==='ujian'?"active":""?>">
				<a href="<?=base_url('ujian/list')?>" rel="noopener noreferrer">
					<i class="fa fa-pencil"></i> <span>Опросы</span>
				</a>
			</li>
			<li class="<?=$page==='ujian'?"active":""?>">
				<a href="<?=base_url('ujian/list_question')?>" rel="noopener noreferrer">
					<i class="fa fa-pencil"></i> <span>Вопросы от преподавателя</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if( !$this->ion_auth->in_group('Student') ) : ?>
			<li class="header">Результаты</li>
			<li class="<?=$page==='hasilujian'?"active":""?>">
				<a href="<?=base_url('hasilujian')?>" rel="noopener noreferrer">
					<i class="fa fa-file"></i> <span>Результаты опросов</span>
				</a>
			</li>
			<?php endif; ?>
			<?php if($this->ion_auth->is_admin()) : ?>
			<li class="header">Администрирование</li>
			<li class="<?=$page==='users'?"active":""?>">
				<a href="<?=base_url('users')?>" rel="noopener noreferrer">
					<i class="fa fa-users"></i> <span>Управл. пользователями</span>
				</a>
			</li>
			
			<?php endif; ?>
		</ul>

	</section>
	<!-- /.sidebar -->
</aside>