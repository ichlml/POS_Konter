<?php
//============================================================+
// File name   : example_005.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 005 for TCPDF class
//               Multicell
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Multicell
 * @author $this->session->nama
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('Maula Konter');
$pdf->SetAuthor($this->session->nama);
$pdf->SetTitle('Laporan Transaksi');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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
$pdf->SetFont('Helvetica', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

$title="
<h2>Laporan Laba / Rugi - Total</h2>
<h4>pada ".indo_bulan($bulan)." ".$tahun."</h4>
";
$pdf->WriteHTMLCell(0,0,'','',$title,0,1,0,true,'C',true);
$table = '<table  border="1px" style="padding:2px;">';
$table .= '<tr>
				<th style="background-color:#ebebeb">Nama Barang</th>
				<th style="background-color:#ebebeb">Mata Uang</th>
				<th style="background-color:#ebebeb">Harga Awal</th>
				<th style="background-color:#ebebeb">Harga Jual</th>
				<th style="background-color:#ebebeb">Terjual</th>
				<th style="background-color:#ebebeb">Sub Total</th>
				<th style="background-color:#ebebeb">Laba/Rugi</th>
            </tr>';
			foreach($data as $row){
                $table .='<tr>
                    <td>'.$row->nama_b.'</td>
                    <td>IDR</td>
                    <td>'.$row->harga_awal_b.'</td>
                    <td>'.$row->harga_jual_b.'</td>
                    <td>'.$row->jumlah.'</td>
                    <td>'.number_format($row->total).'</td>
                    <td>'.number_format($row->keuntungan).'</td>
                </tr>';
			}
$table .= '</table>';
$pdf->WriteHTMLCell(0,0,'','',$table,0,1,0,true,'C',true);
// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_clean();
$pdf->Output('lap-'.$bulan.'-'.$tahun.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
