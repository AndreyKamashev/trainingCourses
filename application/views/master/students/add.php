<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Форма <?=$judul?></h3>
        <div class="box-tools pull-right">
            <a href="<?=base_url('students')?>" class="btn btn-sm btn-flat btn-warning">
                <i class="fa fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <?=form_open('students/save', array('id'=>'students'), array('method'=>'add'))?>
                    <div class="form-group">
                       <label for="nim">Личный номер</label>
                        <input autofocus="autofocus" onfocus="this.select()" placeholder="Личн.номер" type="text" value="<?=$nimValue;?>" name="nim" class="form-control" readonly>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="name">ФИО</label>
                        <input placeholder="ФИО" type="text" name="name" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input placeholder="Email" type="email" name="email" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Пол</label>
                        <select name="jenis_kelamin" class="form-control select2">
                            <option value="">-- Выберите --</option>
                            <option value="M">Мужской</option>
                            <option value="F">Женский</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="themes">Тема курса</label>
                        <select id="themes" name="themes" class="form-control select2">
                            <option value="" disabled selected>-- Выберите --</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="classes">Группа</label>
                        <select id="classes" name="classes" class="form-control select2">
                            <option value="">-- Выберите --</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group pull-right">
                        <button type="reset" class="btn btn-flat btn-default"><i class="fa fa-rotate-left"></i> Очистить</button>
                        <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Сохранить </button>
                    </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/master/students/add.js"></script>