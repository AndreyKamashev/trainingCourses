<?=form_open('lecturer/save', array('id'=>'formlecturer'), array('method'=>'edit', 'id_lecturer'=>$data->id_lecturer));?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"> <?=$subjudul?></h3>
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
                    <input value="<?=$data->nip?>" autofocus="autofocus" onfocus="this.select()" type="text" id="nip" class="form-control" name="nip" readonly>
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="name_lecturer">ФИО</label>
                    <input value="<?=$data->name_lecturer?>" type="text" class="form-control" name="name_lecturer" placeholder="Lecturer Name">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="<?=$data->email?>" type="text" class="form-control" name="email" placeholder="Lecturer Email">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="courses">Курс</label>
                    <select name="courses" id="courses" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected>Выберите курс</option>
                        <?php foreach ($courses as $row) : ?>
                            <option <?=$data->courses_id===$row->id_courses?"selected":""?> value="<?=$row->id_courses?>"><?=$row->name_courses?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="help-block"></small>
                </div>
                <div class="form-group pull-right">
                    <button type="reset" class="btn btn-flat btn-danger">
                        <i class="fa fa-rotate-left"></i> Очистить
                    </button>
                    <button type="submit" id="submit" class="btn btn-flat bg-green">
                        <i class="fa fa-pencil"></i> Редактировать
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?=form_close();?>

<script src="<?=base_url()?>assets/dist/js/app/master/lecturer/edit.js"></script>