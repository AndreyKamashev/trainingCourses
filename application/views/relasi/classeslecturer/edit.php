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
            <div class="col-sm-4 col-sm-offset-4">
                <?=form_open('classeslecturer/save', array('id'=>'classeslecturer'), array('method'=>'edit', 'lecturer_id'=>$id_lecturer))?>
                <div class="form-group">
                    <label>Преподаватель</label>
                    <input type="text" readonly="readonly" value="<?=$lecturer->name_lecturer?>" class="form-control">
                    <small class="help-block text-right"></small>
                </div>
                <div class="form-group">
                    <label>Группа</label>
                    <select id="classes" multiple="multiple" name="classes_id[]" class="form-control select2" style="width: 100%!important">
                        <?php 
                        $sk = [];
                        foreach ($classes as $key => $val) {
                            $sk[] = $val->id_classes;
                        }
                        foreach ($all_classes as $m) : ?>
                            <option <?=in_array($m->id_classes, $sk) ? "selected" : "" ?> value="<?=$m->id_classes?>"><?=$m->name_classes?> - <?=$m->name_themes?></option>
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

<script src="<?=base_url()?>assets/dist/js/app/relasi/classeslecturer/edit.js"></script>