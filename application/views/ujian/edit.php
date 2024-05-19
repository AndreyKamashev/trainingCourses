<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <a href="<?=base_url()?>ujian/master" class="btn btn-sm btn-flat btn-warning">
                <i class="fa fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="alert bg-purple">
                    <h4>Курс <i class="fa fa-book pull-right"></i></h4>
                    <p><?=$courses->name_courses?></p>
                </div>
                <div class="alert bg-purple">
                    <h4>Преподаватель <i class="fa fa-address-book-o pull-right"></i></h4>
                    <p><?=$lecturer->name_lecturer?></p>
                </div>
            </div>
            <div class="col-sm-4">
                <?=form_open('ujian/save', array('id'=>'formujian'), array('method'=>'edit','lecturer_id'=>$lecturer->id_lecturer, 'courses_id'=>$courses->courses_id, 'id_ujian'=>$ujian->id_ujian))?>
                <div class="form-group">
                    <label for="name_ujian">Наименование опроса</label>
                    <input value="<?=$ujian->name_ujian?>" autofocus="autofocus" onfocus="this.select()" placeholder="name Ujian" type="text" class="form-control" name="name_ujian">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="jumlah_soal">Количество вопросов</label>
                    <input value="<?=$ujian->jumlah_soal?>" placeholder="Number of Questions" type="number" class="form-control" name="jumlah_soal">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="tgl_mulai">Дата начала</label>
                    <input id="tgl_mulai" name="tgl_mulai" type="text" class="datetimepicker form-control" placeholder="Start Date">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="tgl_selesai">Дата завершения</label>
                    <input id="tgl_selesai" name="tgl_selesai" type="text" class="datetimepicker form-control" placeholder="Completion Date">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="waktu">Время</label>
                    <input value="<?=$ujian->waktu?>" placeholder="In Minute" type="number" class="form-control" name="waktu">
                    <small class="help-block"></small>
                </div>
                <div class="form-group">
                    <label for="jenis">Сортировка вопросов</label>
                    <select name="jenis" class="form-control">
                        <option value="" disabled selected>--- Выберите ---</option>
                        <option <?=$ujian->jenis==="Random"?"selected":"";?> value="Random">Случайная</option>
                        <option <?=$ujian->jenis==="Sort"?"selected":"";?> value="Sort">По порядку</option>
                    </select>
                    <small class="help-block"></small>
                </div>
                <div class="form-group pull-right">
                    <button type="reset" class="btn btn-default btn-flat">
                        <i class="fa fa-rotate-left"></i> Очистить
                    </button>
                    <button id="submit" type="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Сохранить</button>
                </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var tgl_mulai = '<?=$ujian->tgl_mulai?>';
    var terlambat = '<?=$ujian->terlambat?>';
</script>

<script src="<?=base_url()?>assets/dist/js/app/ujian/edit.js"></script>