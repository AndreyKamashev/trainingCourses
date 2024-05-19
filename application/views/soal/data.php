<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
		<div class="row">
        	<div class="col-sm-4">
				<button type="button" onclick="bulk_delete()" class="btn btn-flat btn-sm bg-red"><i class="fa fa-trash"></i> Удалить</button>
			</div>
			<div class="form-group col-sm-4 text-center">
				<?php if ( $this->ion_auth->is_admin() ) : ?>
					<select id="courses_filter" class="form-control select2" style="width:100% !important">
						<option value="all">Все курсы</option>
						<?php foreach ($courses as $m) :?>
							<option value="<?=$m->id_courses?>"><?=$m->name_courses?></option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
				<?php if ( $this->ion_auth->in_group('Lecturer') ) : ?>				
					<input id="courses_id" value="<?=$courses->name_courses;?>" type="text" readonly="readonly" class="form-control">
				<?php endif; ?>
			</div>
			<div class="col-sm-4">
				<div class="pull-right">
					<a href="<?=base_url('soal/add')?>" class="btn bg-blue btn-flat btn-sm"><i class="fa fa-plus"></i> Добавить</a>
					<button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-maroon"><i class="fa fa-refresh"></i> Обновить</button>
				</div>
			</div>
		</div>
    </div>
	<?=form_open('soal/delete', array('id'=>'bulk'))?>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="soal" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
				<th class="text-center">
					<input type="checkbox" class="select_all">
				</th>
                <th width="25">#</th>
				<th>Преподаватель</th>
                <th>Курс</th>
				<th>Вопросы</th>
				<th>Дата создания</th>
				<th class="text-center">Действия</th>
            </tr>        
        </thead>
        
        </table>
    </div>
	<?=form_close();?>
</div>

<script src="<?=base_url()?>assets/dist/js/app/soal/data.js"></script>

<?php if ( $this->ion_auth->is_admin() ) : ?>
<script type="text/javascript">
$(document).ready(function(){
	$('#courses_filter').on('change', function(){
		let id_courses = $(this).val();
		let src = '<?=base_url()?>soal/data';
		let url;

		if(id_courses !== 'all'){
			let src2 = src + '/' + id_courses;
			url = $(this).prop('checked') === true ? src : src2;
		}else{
			url = src;
		}
		table.ajax.url(url).load();
	});
});
</script>
<?php endif; ?>
<?php if ( $this->ion_auth->in_group('Lecturer') ) : ?>
<script type="text/javascript">
$(document).ready(function(){
	let id_courses = '<?=$courses->courses_id?>';
	let id_lecturer = '<?=$courses->id_lecturer?>';
	let src = '<?=base_url()?>soal/data';
	let url = src + '/' + id_courses + '/' + id_lecturer;

	table.ajax.url(url).load();
});
</script>
<?php endif; ?>