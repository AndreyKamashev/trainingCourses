<?=form_open('lecturer/save', array('id'=>'formlecturer'), array('method'=>'add'));?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Форма <?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <a href="<?=base_url()?>lecturer" class="btn btn-sm btn-flat btn-warning">
                <i class="fa fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="form-group">
                    <label for="nip">Личный номер</label>
                    <input autofocus="autofocus" onfocus="this.select()" type="text" id="nip" class="form-control" name="nip" value="<?=$nimValue;?>" readonly>
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="name_lecturer">ФИО</label>
                    <input type="text" class="form-control" name="name_lecturer" placeholder="Lecturer Name">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="email"> Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Lecturer Email">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="courses">Курс</label>
                    <select name="courses" id="courses" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected>Выберите</option>
                        <?php foreach ($courses as $row) : ?>
                            <option value="<?=$row->id_courses?>"><?=$row->name_courses?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="help-block"></small>
                </div>
                <div class="form-group pull-right">
                    <button type="reset" class="btn btn-flat btn-default">
                        <i class="fa fa-rotate-left"></i> Очистить
                    </button>
                    <button type="submit" id="submit" class="btn btn-flat bg-purple">
                        <i class="fa fa-save"></i> Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?=form_close();?>

<script src="<?=base_url()?>assets/dist/js/app/master/lecturer/add.js"></script>