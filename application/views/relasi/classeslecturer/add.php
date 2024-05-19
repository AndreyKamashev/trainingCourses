<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Форма <?=$judul?></h3>
        <div class="box-tools pull-right">
            <a href="<?=base_url()?>classeslecturer" class="btn btn-warning btn-flat btn-sm">
                <i class="fa fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="alert bg-purple">
                    <h4><i class="fa fa-info-circle"></i> Информация</h4>
                    Если поле преподавателя отсутствует, вот возможные причины:
                    <br><br>
                    <ol class="pl-4">
                        <li>Для всех преподавателей группы распределены, нужно создать нового преподавателя.</li>
                        <li>Чтобы обновить или удалить группы для преподавателя, выберите редактировать.</li>
                    </ol>
                </div>
            </div>
            <div class="col-sm-4">
                <?=form_open('classeslecturer/save', array('id'=>'classeslecturer'), array('method'=>'add'))?>
                <div class="form-group">
                    <label>Преподаватель</label>
                    <select name="lecturer_id" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($lecturer as $d) : ?>
                            <option value="<?=$d->id_lecturer?>"><?=$d->name_lecturer?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="help-block text-right"></small>
                </div>
                <div class="form-group">
                    <label>Группа</label>
                    <select id="classes" multiple="multiple" name="classes_id[]" class="form-control select2" style="width: 100%!important">
                        <?php foreach ($classes as $k) : ?>
                            <option value="<?=$k->id_classes?>"><?=$k->name_classes?> - <?=$k->name_themes?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="help-block text-right"></small>
                </div>
                <div class="form-group pull-right">
                    <button type="reset" class="btn btn-flat btn-default">
                        <i class="fa fa-rotate-left"></i> Очистить
                    </button>
                    <button id="submit" type="submit" class="btn btn-flat bg-purple">
                        <i class="fa fa-save"></i> Сохранить
                    </button>
                </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/relasi/classeslecturer/add.js"></script>