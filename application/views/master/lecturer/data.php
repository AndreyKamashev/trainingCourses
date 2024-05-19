<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"> <?= $subjudul ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="mt-2 mb-4">
            <a href="<?= base_url('lecturer/add') ?>" class="btn btn-sm bg-blue btn-flat"><i class="fa fa-plus"></i> Добавить</a>
            <button type="button" onclick="reload_ajax()" class="btn btn-sm bg-maroon btn-default btn-flat"><i class="fa fa-refresh"></i> Обновить</button>
            <div class="pull-right">
                <button onclick="bulk_delete()" class="btn btn-sm btn-danger btn-flat" type="button"><i class="fa fa-trash"></i> Удалить</button>
            </div>
        </div>
        <?= form_open('lecturer/delete', array('id' => 'bulk')) ?>
        <table id="lecturer" class="w-100 table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Личный номер</th>
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>Курс</th>
                    <th class="text-center">Действие</th>
                    <th class="text-center">
                        <input type="checkbox" class="select_all">
                    </th>
                </tr>
            </thead>
            <tbody></tbody>
           
        </table>
        <?= form_close() ?>
    </div>
</div>

<script src="<?= base_url() ?>assets/dist/js/app/master/lecturer/data.js"></script>