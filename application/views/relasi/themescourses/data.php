<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"> <?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="mt-2 mb-3">
            <a href="<?=base_url('themescourses/add')?>" class="btn btn-sm btn-flat bg-blue"><i class="fa fa-plus"></i> Добавить</a>
            <button type="button" onclick="reload_ajax()" class="btn btn-sm bg-maroon btn-flat btn-default"><i class="fa fa-refresh"></i> Обновить</button>
			<div class="pull-right">
				<button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Удалить</button>
			</div>
        </div>
    </div>
	<?=form_open('',array('id'=>'bulk'))?>
	<div class="table-responsive px-4 pb-3" style="border:0">
	<table id="themescourses" class="w-100 table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Курс</th>
				<th>Темы</th>
				<th class="text-center">Действия</th>
				<th class="text-center">
					<input type="checkbox" class="select_all">
				</th>
			</tr>
		</thead>
		
	</table>
	</div>
	<?=form_close()?>
</div>

<script src="<?=base_url()?>assets/dist/js/app/relasi/themescourses/data.js"></script>