<?php 
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    public function Header() {
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'B', 18);
        $this->SetY(13);
        $this->Cell(0, 15, 'Результаты опроса', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Тим Патрик');
$pdf->SetTitle('Результаты опросов');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

$mulai = strftime('%d-%m-%Y', strtotime($ujian->tgl_mulai));
$selesai = strftime('%d-%m-%Y', strtotime($ujian->terlambat));

// create some HTML content
$html = <<<EOD
<p>
Результаты онлайн-опросов </br>
Вся подробная информация представлена ниже с наивысшим, самым низким и средним баллом студента!
</p>
<table>
    <tr>
        <th><b>Наименование опроса</b></th>
        <td>{$ujian->name_ujian}</td>
        <th><b>Курс</b></th>
        <td>{$ujian->name_courses}</td> 
    </tr>
    <tr>
        <th><b>Всего вопросов</b></th>
        <td>{$ujian->jumlah_soal}</td>
        <th><b>Преподаватель</b></th>
        <td>{$ujian->name_lecturer}</td>
    </tr>
    <tr>
        <th><b>Время</b></th>
        <td>{$ujian->waktu} Minute</td>
        <th><b>Самый низкий балл</b></th>
        <td>{$nilai->min_nilai}</td>
    </tr>
    <tr>
        <th><b>Дата начала</b></th>
        <td>{$mulai}</td>
        <th><b>Наивысший балл</b></th>
        <td>{$nilai->max_nilai}</td>
    </tr>
    <tr>
        <th><b>Дата завершения</b></th>
        <td>{$selesai}</td>
        <th><b>Средний балл</b></th>
        <td>{$nilai->avg_nilai}</td>
    </tr>
</table>
EOD;

$html .= <<<EOD
<br><br><br>
<table border="1" style="border-collapse:collapse">
    <thead>
        <tr align="center">
            <th width="5%">#</th>
            <th width="35%"><b>Наименование опроса</b></th>
            <th width="15%"><b>Группа</b></th>
            <th width="25%"><b>Тема</b></th>
            <th width="10%"><b>Правильных ответов</b></th>
            <th width="10%"><b>Балл</b></th>
        </tr>        
    </thead>
    <tbody>
EOD;

$no = 1;
foreach($hasil as $row) {
$html .= <<<EOD
    <tr>
        <td align="center" width="5%">{$no}</td>
        <td width="35%">{$row->name}</td>
        <td width="15%">{$row->name_classes}</td>
        <td width="25%">{$row->name_themes}</td>
        <td width="10%">{$row->jml_benar}</td>
        <td width="10%">{$row->nilai}</td>
    </tr>
EOD;
$no++;
}

$html .= <<<EOD
    </tbody>
</table>
EOD;

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);
// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('tes.pdf', 'I');
