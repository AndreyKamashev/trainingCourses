<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Форма <?=$judul?></h3>
        <div class="box-tools pull-right">
            <a href="<?=base_url()?>themescourses" class="btn btn-warning btn-flat btn-sm">
                <i class="fa fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                    <?=form_open('themescourses/save', array('id'=>'themescourses'), array('method'=>'edit', 'courses_id'=>$id_courses))?>
                <div class="form-group">
                    <label>Курс</label>
                    <input type="text" readonly="readonly" value="<?=$courses->name_courses?>" class="form-control">
                    <small class="help-block text-right"></small>
                </div>
                <div class="form-group">
                    <label>Темы</label>
                    <select id="themes" multiple="multiple" name="themes_id[]" class="form-control select2" style="width: 100%!important">
                        <?php 
                        $sj = [];
                        foreach ($themes as $key => $val) {
                            $sj[] = $val->id_themes;
                        }
                        foreach ($all_themes as $m) : ?>
                            <option <?=in_array($m->id_themes, $sj) ? "selected" : "" ?> value="<?=$m->id_themes?>"><?=$m->name_themes?></option>
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

<script src="<?=base_url()?>assets/dist/js/app/relasi/themescourses/edit.js"></script>