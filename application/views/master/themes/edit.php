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
            <div class="col-sm-offset-3 col-sm-6 col-lg-offset-4 col-lg-4">
                <div class="my-2">
                    <div class="form-horizontal form-inline">
                        <a href="<?=base_url('themes')?>" class="btn btn-default btn-xs">
                            <i class="fa fa-arrow-left"></i> Назад
                        </a>
                        <div class="pull-right">
                            <span>Всего : </span><label for=""><?=count($themes)?></label>
                        </div>
                    </div>
                </div>
                <?=form_open('themes/save', array('id'=>'themes'), array('mode'=>'edit'))?>
                <table id="form-table" class="table text-center table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Наименование темы</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($themes as $j) : ?>
                        <tr>
                            <td><?=$no?></td>
                            <td>
                                <div class="form-group">
                                    <?=form_hidden('id_themes['.$no.']', $j->id_themes)?>
                                    <input autofocus="autofocus" onfocus="this.select()" autocomplete="off" value="<?=$j->name_themes?>" type="text" name="name_themes[<?=$no?>]" class="input-sm form-control">
                                    <small class="help-block text-right"></small>
                                </div>
                            </td>
                        </tr>
                        <?php 
                        $no++;
                        endforeach; 
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="mb-4 btn btn-block btn-flat bg-purple">
                    <i class="fa fa-save"></i> Редактировать
                </button>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/master/themes/edit.js"></script>