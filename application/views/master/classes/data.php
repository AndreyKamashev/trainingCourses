<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title"> <?= $subjudul ?></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="mt-2 mb-3">
			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-flat bg-blue"><i class="fa fa-plus"></i> Добавить</button>
			<button type="button" onclick="reload_ajax()" class="btn btn-sm bg-maroon btn-flat btn-default"><i class="fa fa-refresh"></i> Обновить</button>
			<div class="pull-right">
				<button onclick="bulk_edit()" class="btn btn-sm btn-flat btn-warning" type="button"><i class="fa fa-edit"></i> Ред.</button>
				<button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Удалить</button>
			</div>
		</div>
		<?= form_open('', array('id' => 'bulk')) ?>
		<table id="classes" class="w-100 table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Группа</th>
					<th>Тема</th>
					<th class="text-center">
						<input type="checkbox" id="select_all">
					</th>
				</tr>
			</thead>
		</table>
		<?= form_close() ?>
	</div>
</div>

<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Добавить</h4>
			</div>
			<?= form_open('classes/add', array('id', 'tambah')); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="banyak">Количество данных</label>
					<input value="1" minlength="1" maxlength="50" min="1" max="50" id="banyakinput" type="number" autocomplete="off" required="required" name="banyak" class="form-control">
					<small class="help-block">Макс. 50</small>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" name="input">Генерировать</button>
			</div>
			<?= form_close(); ?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<script src="<?= base_url() ?>assets/dist/js/app/master/classes/data.js"></script>