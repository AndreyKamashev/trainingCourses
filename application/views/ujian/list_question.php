<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$subjudul?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
	<div class="box-tools pull-center">
			<!---- Success Message ---->
			<?php if ($this->session->flashdata('success')) { ?>
			<p style="color:green; font-size:18px;"><?php echo $this->session->flashdata('success'); ?></p>
			
			<?php } ?>
			<!---- Error Message ---->
			<?php if ($this->session->flashdata('error')) { ?>
			<p style="color:red; font-size:18px;"><?php echo $this->session->flashdata('error');?></p>
			<?php } ?>
        </div>	
    <div class="box-body">
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="question" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
				
                <th width="25">#</th>
				<th>Преподаватель</th>
                <th>Студент</th>
				<th>Вопрос</th>
				<th>Ответ</th>
				<th>Оценка</th>
				<th>Дата создания вопроса</th>
				<th>Дата создания ответа</th>
				<th class="text-center">Действия</th>
            </tr>        
        </thead>
        <tbody>
			<?php
				if(count($questions)) :
				$cnt=1; 
				foreach ($questions as $row) :
				?>                    
                    <tr>
                      <td><?php echo htmlentities($cnt);?></td>
                      <td><?php echo htmlentities($row->name_lecturer)?></td>
                      <td><?php echo htmlentities($row->name)?></td>
					  <td><?php echo htmlentities($row->name_questions)?></td>
                      <td><?php echo $row->name_answers;?></td>
					  <td><?php echo htmlentities($row->score)?></td>
					  <td><?php echo htmlentities($row->date_questions)?></td>
					  <td><?php echo htmlentities($row->date_answers)?></td>
                      <td><?php 
							echo  anchor("ujian/editquest/{$row->id_questions}",' ','class="fa fa-edit" title="Ответ на вопрос"')?>
                      </td>
                    </tr>
				 <?php 
				$cnt++;
				endforeach;
				else : ?>
				<tr>
				<td colspan="6">Нет записей</td>
				</tr>
				<?php
				endif;
				?>                
		</tbody>
        </table>
    </div>
	</div>
</div>