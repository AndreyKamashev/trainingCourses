<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"> <?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <a href="<?=base_url()?>ujian/list_question" class="btn btn-sm btn-flat btn-warning">
                <i class="fa fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-2">
                <form action="<?=base_url('ujian/editquest/'.$data->id_questions) ?>" method="post">
				  <div class="form-group has-feedback">
				   
					 <div class="form-group col-sm-12">
					    <label for="name_answers">Ответ</label>
                        <textarea name="name_answers" id="name_answers" class="form-control summernote"><?=$data->name_answers?></textarea>
                        <small class="help-block" style="color: #dc3545"><?=form_error('name_answers')?></small>
                     </div>
				  </div>
							
				  <div class="form-group has-feedback">
					<div class="col-xs-8">
					  <button type="submit" class="btn btn-primary btn-block btn-flat">Редактировать</button>
					</div>
				  </div>
				</form>
            </div>
        </div>
    </div>
</div>