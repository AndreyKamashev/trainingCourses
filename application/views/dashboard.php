<?php if( $this->ion_auth->is_admin() ) : ?>
<div class="row">
    <?php foreach($info_box as $info) : ?>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-<?=$info->box?>">
        <div class="inner">
            <h3><?=$info->total;?></h3>
            <p><?=$info->text;?></p>
        </div>
        <div class="icon">
            <i class="fa fa-<?=$info->icon?>"></i>
        </div>
        <a href="<?=base_url().strtolower($info->title);?>" class="small-box-footer">
            Подробнее <i class="fa fa-arrow-circle-right"></i>
        </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php elseif( $this->ion_auth->in_group('Lecturer') ) : ?>

<div class="row">
    <div class="col-sm-4">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Информация об учетной записи</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>ФИО</th>
                    <td><?=$lecturer->name_lecturer?></td>
                </tr>
                <tr>
                    <th>Личный номер</th>
                    <td><?=$lecturer->nip?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?=$lecturer->email?></td>
                </tr>
                <tr>
                    <th>Курс</th>
                    <td><?=$lecturer->name_courses?></td>
                </tr>
                <tr>
                    <th>Список классов</th>
                    <td>
                        <ol class="pl-4">
                        <?php foreach ($classes as $k) : ?>
                            <li><?=$k->name_classes?></li>
                        <?php endforeach;?>
                        </ol>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="box box-solid">
            <div class="box-header bg-yellow">
                <h3 class="box-title">Описание роли:</h3>
            </div>
            <div class="box-body">
            <p>Добро пожаловать в систему онлайн-опросов. Вот несколько советов, которые помогут вам с легкостью пройти через систему.</p>
                <ul class="pl-4">
                    <li>Перво-наперво, все вопросы перечислены в разделе "Банк вопросов" (меню боковой панели слева).</li>
                    <li>Во-вторых, вы можете управлять опросниками, чтобы настроить опросы из раздела "Банк вопросов".</li>
                    <li>У каждого опроса должно быть свое название, наборы вопросов, дата и временные рамки, установленные ПРЕПОДАВАТЕЛЕМ.</li>
                    <li>Вам необходимо скопировать код ТОКЕНА и поделиться им (со студентами) один раз после создания опросационной записи.</li>
                    <li>Как только студент сдаст опрос, вы сможете просмотреть его подробные результаты в разделе "Результаты опроса".</li>
                    <li>Кроме того, часть результатов можно загрузить в формате PDF.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php else : ?>

<div class="row">
    <div class="col-sm-4">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Информация об учетной записи</h3>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>Личный номер</th>
                    <td><?=$students->nim?></td>
                </tr>
                <tr>
                    <th>ФИО</th>
                    <td><?=$students->name?></td>
                </tr>
                <tr>
                    <th>Пол</th>
                    <td><?=$students->jenis_kelamin === 'M' ? "Male" : "Female" ;?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?=$students->email?></td>
                </tr>
                <tr>
                    <th>Тема курса</th>
                    <td><?=$students->name_themes?></td>
                </tr>
                <tr>
                    <th>Класс(группа)</th>
                    <td><?=$students->name_classes?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="box box-solid">
            <div class="box-header bg-yellow">
                <h3 class="box-title">Описание роли:</h3>
            </div>
            <div class="box-body">
            <p>Добро пожаловать в систему онлайн-опросов. Вот несколько советов, которые помогут вам с легкостью пройти через систему.</p>
                <ul class="pl-4">
                    <li>Перво-наперво, все опросы перечислены в разделе "опросы" (меню боковой панели слева).</li>
                    <li>Во-вторых, вы сможете ознакомиться с результатами опросов только в соответствии с вашим курсом и темой.</li>
                    <li>Каждый опрос имеет свой собственный лимит времени, который устанавливается преподавателем.</li>
                    <li>Вам необходимо ввести номер ТОКЕНА, чтобы начать онлайн-опрос.</li>
                    <li>Вам необходимо записаться/начать опрос в установленные сроки (дата и время), иначе вы не сможете присоединиться к опросу.</li>
                    <li>Как только вы пройдете опросы, вы сможете просмотреть только свои результаты.</li>
                    <li>Для повторного опроса, пожалуйста, проконсультируйтесь с вашим преподавателем!</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>