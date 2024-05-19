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
                            <span> Всего : </span><label for=""><?=count($classes)?></label>
                        </div>
                    </div>
                </div>
                <?=form_open('classes/save', array('id'=>'classes'), array('mode'=>'edit'))?>
                <table id="form-table" class="table text-center table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Группа</th>
                            <th>Тема</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach($classes as $row) : ?> 
                            <tr>
                                <td><?=$i?></td>
                                <td>
                                    <div class="form-group">
                                        <?=form_hidden('id_classes['.$i.']', $row->id_classes);?>
                                        <input required="required" autofocus="autofocus" onfocus="this.select()" value="<?=$row->name_classes?>" type="text" name="name_classes[<?=$i?>]" class="form-control">
                                        <span class="d-none">НЕ УДАЛЯЙТЕ</span>
                                        <small class="help-block text-right"></small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select required="required" name="themes_id[<?=$i?>]" class="input-sm form-control select2" style="width: 100%!important">
                                            <option value="" disabled>-- Выберите --</option>
                                            <?php foreach ($themes as $j) : ?>
                                                <option <?= $row->themes_id == $j->id_themes ? "selected='selected'" : "" ?> value="<?=$j->id_themes?>"><?=$j->name_themes?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="help-block text-right"></small>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++;endforeach; ?>
                    </tbody>
                </table>
                <button id="submit"  type="submit" class="mb-4 btn btn-block btn-flat bg-purple">
                    <i class="fa fa-edit"></i> Редактировать
                </button>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/master/classes/edit.js"></script>