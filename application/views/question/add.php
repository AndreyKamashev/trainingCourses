<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Форма <?=$subjudul?></h3>
			
        <div class="box-tools pull-right">
            <a href="<?=base_url()?>question" class="btn btn-sm btn-flat btn-warning">
                <i class="fa fa-arrow-left"></i> Назад
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-2">
               <form action="<?=base_url('question/add') ?>" method="post">
				  <div class="form-group has-feedback">
					 <div class="form-group col-sm-12">
						<label for="name_questions">Вопрос</label>
                        <textarea name="name_questions" id="name_questions" class="form-control summernote"></textarea>
                        <small class="help-block" style="color: #dc3545"></small>
                     </div>
				  </div>
				  
				  <div class="form-group">
				    <div class="form-group col-sm-9">
						<label for="students">Студент</label>
						<select name="id_students" id="students" class="form-control select2" style="width: 100%!important" autocomplete="off" required="">
							<option value="" disabled selected>Выберите</option>
							<?php foreach ($students as $row) : ?>
								<option value="<?=$row->id_students?>"><?=$row->name?></option>
							<?php endforeach; ?>
						</select>
						<small class="help-block"></small>
					</div>
				  </div>
				  <div class="form-group has-feedback">
					<div class="col-xs-8">
					  <button type="submit" class="btn btn-primary btn-block btn-flat">Добавить</button>
					</div>
				  </div>
				</form>
            </div>
        </div>
    </div>
</div>
