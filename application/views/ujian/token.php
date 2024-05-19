<div class="callout callout-info">
    <h4>Результаты опроса</h4>
    <p></p>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Подтвердить данные</h3>
    </div>
    <div class="box-body">
        <span id="id_ujian" data-key="<?=$encrypted_id?>"></span>
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-bordered">
                    <tr>
                        <th>ФИО</th>
                        <td><?=$mhs->name?></td>
                    </tr>
                    <tr>
                        <th>Преподаватель</th>
                        <td><?=$ujian->name_lecturer?></td>
                    </tr>
                    <tr>
                        <th>Группа/Тема</th>
                        <td><?=$mhs->name_classes?> / <?=$mhs->name_themes?></td>
                    </tr>
                    <tr>
                        <th>Наименование опроса</th>
                        <td><?=$ujian->name_ujian?></td>
                    </tr>
                    <tr>
                        <th>Количество вопросов</th>
                        <td><?=$ujian->jumlah_soal?></td>
                    </tr>
                    <tr>
                        <th>Время</th>
                        <td><?=$ujian->waktu?> Минуты</td>
                    </tr>
                    <tr>
                        <th>Дата завершения</th>
                        <td>
                            <?=strftime('%d-%m-%Y', strtotime($ujian->terlambat))?> 
                            <?=date('H:i:s', strtotime($ujian->terlambat))?>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align:middle">Код опроса</th>
                        <td>
                            <input autocomplete="off" id="token" placeholder="Token" type="text" class="input-sm form-control" value="<?=$ujian->token?>" readonly>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <div class="box box-solid">
                    <div class="box-body pb-0">
                        <div class="callout callout-info">
                            <p>
                            Время сдачи опроса наступает тогда, когда кнопка «Начать опрос» станет зеленой.
                            </p>
                        </div>
                        <?php
                        $mulai = strtotime($ujian->tgl_mulai);
                        $terlambat = strtotime($ujian->terlambat);
                        $now = time();
                        if($mulai > $now) : 
                        ?>
                        <div class="callout callout-success">
                            <strong><i class="fa fa-clock-o"></i> Опрос начнется</strong>
                            <br>
                            <span class="countdown" data-time="<?=date('Y-m-d H:i:s', strtotime($ujian->tgl_mulai))?>">00 Дней, 00 Часов, 00 Минут, 00 Секунд</strong><br/>
                        </div>
                        <?php elseif( $terlambat > $now ) : ?>
                        <button id="btncek" data-id="<?=$ujian->id_ujian?>" class="btn btn-success btn-lg mb-4">
                            <i class="fa fa-pencil"></i> Начать опрос
                        </button>
                        <div class="callout callout-danger">
                            <i class="fa fa-clock-o"></i> <strong class="countdown" data-time="<?=date('Y-m-d H:i:s', strtotime($ujian->terlambat))?>">00 Дней, 00 Часов, 00 Минут, 00 Секунд</strong><br/>
                            Таймаут нажатия кнопки «Начать опрос».
                        </div>
                        <?php else : ?>
                        <div class="callout callout-danger">
                        Время нажатия кнопки <strong>"Начать опрос"</strong> истекло.<br/>
                        Пожалуйста, свяжитесь со своим преподавателем, чтобы иметь возможность пройти опрос на ЗАМЕНУ.
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/dist/js/app/ujian/token.js"></script>