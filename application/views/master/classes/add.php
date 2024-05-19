<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Форма <?=$judul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="my-2">
                    <div class="form-horizontal form-inline">
                        <a href="<?=base_url('classes')?>" class="btn btn-default btn-xs">
                            <i class="fa fa-arrow-left"></i> Назад
                        </a>
                        <div class="pull-right">
                            <span> Всего : </span><label for=""><?=$banyak?></label>
                        </div>
                    </div>
                </div>
                <?=form_open('classes/save', array('id'=>'classes'), array('mode'=>'add'))?>
                <table id="form-table" class="table text-center table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Наименование</th>
                            <th>Тема</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i=1; $i <= $banyak; $i++) : ?> 
                            <tr>
                                <td><?=$i?></td>
                                <td>
                                    <div class="form-group">
                                        <input autofocus="autofocus" onfocus="this.select()" required="required" autocomplete="off" type="text" name="name_classes[<?=$i?>]" class="form-control">
                                        <span class="d-none">НЕ УДАЛЯЙТЕ</span>
                                        <small class="help-block text-right"></small>
                                    </div>
                                </td>
                                <td width="200">
                                    <div class="form-group">
                                        <select required="required" name="themes_id[<?=$i?>]" class="form-control input-sm select2" style="width: 100%!important">
                                            <option value="" disabled selected>-- Выберите --</option>
                                            <?php foreach ($themes as $j) : ?>
                                                <option value="<?=$j->id_themes?>"><?=$j->name_themes?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="help-block text-right"></small>
                                    </div>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
                <button id="submit" type="submit" class="mb-4 btn btn-block btn-flat bg-purple">
                    <i class="fa fa-save"></i> Сохранить
                </button>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var inputs ='';
    var banyak = '<?=$banyak;?>';
</script>

<script src="<?=base_url()?>assets/dist/js/app/master/classes/add.js"></script>