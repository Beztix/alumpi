<?php


require_once(HOME_DIRECTORY . 'alumpiHP_libraries/tfpdf/tfpdf.php');

// map FPDF to tFPDF so FPDF_TPL can extend it
class FPDF extends tFPDF
{
}

require_once(HOME_DIRECTORY . 'alumpiHP_libraries/fpdi/fpdi.php');



function generate_mitgliedsbescheinigung($titleAndName, $strasse, $plz, $ort, $land, $jahr, $vorstand, $datum){
	

	// initiate FPDI
	$pdf = new FPDI();
	// add a page
	$pdf->AddPage();
	// set the source file
	$pdf->setSourceFile(HOME_DIRECTORY . 'alumpiHP_libraries/Mitgliedsbestaetigung_blank.pdf');
	// import page 1
	$tplIdx = $pdf->importPage(1);
	// use the imported page and place it at position 0,0 with a width of 210 mm (full page)
	$pdf->useTemplate($tplIdx, 0, 0, 210);

	// add the font DejaVu
	$pdf->AddFont('DejaVuSans','','DejaVuSans.ttf',true);
	$pdf->AddFont('DejaVuSans-Bold','','DejaVuSans-Bold.ttf',true);


	// text settings
	$pdf->SetTextColor(0, 0, 0);


	// add address of the member
	$addressString = $titleAndName . "\n";
	$addressString .= $strasse . "\n";
	$addressString .= $plz . " " . $ort . "\n";
	$addressString .= $land;
	$pdf->SetFont('DejaVuSans');
	$pdf->SetFontSize(12);
	$pdf->SetXY(20, 23);
	$pdf->Multicell(80,6,$addressString);


	//add heading
	$headingString = "Mitgliedsbescheinigung " . $jahr;
	$pdf->SetFont('DejaVuSans-Bold');
	$pdf->SetFontSize(16);
	$pdf->SetXY(20, 80);
	$pdf->Multicell(170,6,$headingString);

	// add main text
	$textString = "Hiermit wird bestätigt, dass " . $titleAndName . " im Kalenderjahr " . $jahr;
	$textString .= " ordentliches Mitglied des Absolventen- und Förderverein MPI Uni Bayreuth e.V. (aluMPI) ist.\n";
	$textString .= "\n";
	$pdf->SetFont('DejaVuSans');
	$pdf->SetFontSize(12);
	$pdf->SetXY(20, 100);
	$pdf->Multicell(170,6,$textString);


	// add signature text
	$signatureString = "Absolventen- und Förderverein MPI Uni Bayreuth e.V.\n";
	$signatureString .= "1. Vorstand: " . $vorstand . "\n";
	$pdf->SetXY(20, 140);
	$pdf->Multicell(170,6,$signatureString);


	// add signature
	$pdf->Image(HOME_DIRECTORY . 'alumpiHP_libraries/unterschrift_krinninger.png', 20, 155, 50);


	// add place and date
	$dateString = "Bayreuth, " . $datum;
	$pdf->SetXY(20, 180);
	$pdf->Multicell(170,6,$dateString);
	
	ob_clean();
	
	$pdf->Output();
}

?>