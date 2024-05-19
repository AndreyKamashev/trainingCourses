<div class="row">
    <div class="col-sm-12">    
        <?=form_open_multipart('soal/save', array('id'=>'formsoal'), array('method'=>'add'));?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$subjudul?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="form-group col-sm-12">
                            <label>Преподаватель (Курс)</label>
                            <?php if ($this->ion_auth->is_admin()) : ?>
                            <select name="lecturer_id" required="required" id="lecturer_id" class="select2 form-group" style="width:100% !important">
                                <option value="" disabled selected>Выберите</option>
                                <?php foreach ($lecturer as $d) : ?>
                                    <option value="<?=$d->id_lecturer?>:<?=$d->courses_id?>"><?=$d->name_lecturer?> (<?=$d->name_courses?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <small class="help-block" style="color: #dc3545"><?=form_error('lecturer_id')?></small>
                            <?php else : ?>
                            <input type="hidden" name="lecturer_id" value="<?=$lecturer->id_lecturer;?>">
                            <input type="hidden" name="courses_id" value="<?=$lecturer->courses_id;?>">
                            <input type="text" readonly="readonly" class="form-control" value="<?=$lecturer->name_lecturer; ?> (<?=$lecturer->name_courses; ?>)">
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-sm-12">
                            <label for="soal" class="control-label">Вопрос</label>
                            <div class="form-group">
                                <input type="file" name="file_soal" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('file_soal')?></small>
                            </div>
                            <div class="form-group">
                                <textarea name="soal" id="soal" class="form-control summernote"><?=set_value('soal')?></textarea>
                                <small class="help-block" style="color: #dc3545"><?=form_error('soal')?></small>
                            </div>
                        </div>
                        
                        <!-- 
                            Создание цикла A-E 
                        -->
                        <?php
                        $abjad = ['a', 'b', 'c', 'd', 'e'];
                        foreach ($abjad as $abj) :
                            $ABJ = strtoupper($abj); // -------
                        ?>

                        <div class="col-sm-12">
                            <label for="file">Ответ <?= $ABJ; ?></label>
                            <div class="form-group">
                                <input type="file" name="file_<?= $abj; ?>" class="form-control">
                                <small class="help-block" style="color: #dc3545"><?=form_error('file_'.$abj)?></small>
                            </div>
                            <div class="form-group">
                                <textarea name="jawaban_<?= $abj; ?>" id="jawaban_<?= $abj; ?>" class="form-control summernote"><?=set_value('jawaban_a')?></textarea>
                                <small class="help-block" style="color: #dc3545"><?=form_error('jawaban_'.$abj)?></small>
                            </div>
                        </div>

                        <?php endforeach; ?>

                        <div class="form-group col-sm-12">
                            <label for="jawaban" class="control-label">Правильный ответ</label>
                            <select required="required" name="jawaban" id="jawaban" class="form-control select2" style="width:100%!important">
                                <option value="" disabled selected>Выберите</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>                
                            <small class="help-block" style="color: #dc3545"><?=form_error('jawaban')?></small>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="bobot" class="control-label">"Вес" ответа</label>
                            <input required="required" value="1" type="number" name="bobot" placeholder="Question Weight" id="bobot" class="form-control">
                            <small class="help-block" style="color: #dc3545"><?=form_error('bobot')?></small>
                        </div>
                        <div class="form-group pull-right">
                            <a href="<?=base_url('soal')?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> Назад</a>
                            <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=form_close();?>
    </div>
</div>