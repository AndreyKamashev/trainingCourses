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
            <div class="col-sm-12 mb-4">
                <a href="<?=base_url()?>hasilujian" class="btn btn-flat btn-sm btn-warning"><i class="fa fa-arrow-left"></i> Назад</a>
                <button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-purple"><i class="fa fa-refresh"></i> Обновить</button>
                <div class="pull-right">
                    <a target="_blank" href="<?=base_url()?>hasilujian/cetak_detail/<?=$this->uri->segment(3)?>" class="btn bg-maroon btn-flat btn-sm">
                        <i class="fa fa-download"></i> Загрузить/Печатать
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <table class="table w-100">
                    <tr>
                        <th>Наименование опроса</th>
                        <td><?=$ujian->name_ujian?></td>
                    </tr>
                    <tr>
                        <th>Всего вопросов</th>
                        <td><?=$ujian->jumlah_soal?></td>
                    </tr>
                    <tr>
                        <th>Время</th>
                        <td><?=$ujian->waktu?> Мин.</td>
                    </tr>
                    <tr>
                        <th>Дата начала</th>
                        <td><?=strftime('%d-%m-%Y', strtotime($ujian->tgl_mulai))?></td>
                    </tr>
                    <tr>
                        <th>Дата завершения</th>
                        <td><?=strftime('%d-%m-%Y', strtotime($ujian->terlambat))?></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <table class="table w-100">
                    <tr>
                        <th>Курс</th>
                        <td><?=$ujian->name_courses?></td>
                    </tr>
                    <tr>
                        <th>Преподаватель</th>
                        <td><?=$ujian->name_lecturer?></td>
                    </tr>
                    <tr>
                        <th>Низший балл</th>
                        <td><?=$nilai->min_nilai?></td>
                    </tr>
                    <tr>
                        <th>Высший балл</th>
                        <td><?=$nilai->max_nilai?></td>
                    </tr>
                    <tr>
                        <th>Средний балл</th>
                        <td><?=$nilai->avg_nilai?></td>
                    </tr>
                </table>
            </div>
			<div class="col-sm-12">
				<table class="table w-100">
					<thead>
                    <tr>
                      <th>#</th>
                      <th>Вопрос</th>
					  <th>Ответ</th>  
					</tr>
                  </thead>
                  <tbody>
					<?php
						if(isset($result_soap)) :
							$cnt=1; 
							foreach ($result_soap as $row) :
							?>                    
							<tr>
								<td><?php echo htmlentities($cnt);?></td>
								<td><?php echo $row->soal;?></td>
								<!------------------------------------->
								<td><?php
									$jawaban = explode(",",$nilai->list_jawaban); $flag=false;
									foreach ($jawaban as $row_) {
										$answer = explode(":",$row_);
										if (trim($answer[1]) == trim($row->jawaban)) { $flag = true;									
										} else { $flag = false;	}
									}
									if ($flag === true) echo "<p style='color: green'>Верно</p>";
									else echo "<p style='color:red'>Неверно</p>";
								?></td> 
							</tr>
							<?php 
								$cnt++;
							endforeach;
						else : 
					   ?>
						<tr>
							<td colspan="3">Нет записей</td>
						</tr>
						<?php
							endif;
						?>                
                  </tbody>
				</table>
			</div>
        </div>
    </div>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="detail_hasil" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>ФИО студента</th>
                <th>Группа</th>
                <th>Тема</th>
                <th>Правильные ответы</th>
                <th>Балл</th>
            </tr>        
        </thead>
        
        </table>
    </div>
</div>

<script type="text/javascript">
    var id = '<?=$this->uri->segment(3)?>';
</script>

<script src="<?=base_url()?>assets/dist/js/app/ujian/detail_hasil.js"></script>