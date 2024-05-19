<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
              <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat bg-maroon"><i class="fa fa-refresh"></i> Обновить</button>
        </div>
    </div>
	<?=form_open('ujian/delete', array('id'=>'bulk'))?>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="ujian" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
				<th class="text-center">
					<input type="checkbox" class="select_all" disabled>
				</th>
                <th>#</th>
                <th>Наименование опроса</th>
                <th>Курс</th>
                <th>Всего вопросов</th>
                <th>Время</th>
                <th>Сортировка вопросов</th>
				<th	class="text-center">Код опроса</th>
            </tr>        
        </thead>
        
        </table>
    </div>
	<?=form_close();?>
</div>

<script src="<?=base_url()?>assets/dist/js/app/ujian/data_admin.js"></script>