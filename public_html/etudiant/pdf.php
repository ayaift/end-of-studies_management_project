<?php
require 'init.php';
require 'TCPDF/tcpdf.php';
date_default_timezone_set('Africa/Casablanca');

global $link;

if(isset($_GET['report_pdf']))
{
    error_reporting(0);
    $select1 = mysqli_query($link, "SELECT * FROM etudiant WHERE email = '".$_SESSION['user']."'");

    $result1 = mysqli_fetch_assoc($select1);
    
    $etudiant_id = $result1['id'];
    $etudiant = $result1['nom'];
    $prenom = $result1['prenom'];
    $classement = $result1['classement'];
    
    $select2 = mysqli_query($link, "SELECT * FROM choix WHERE etudiant_id = '$etudiant_id'  ");
    
    $result2 = mysqli_fetch_assoc($select2);
    
    
    $sujet_id = $result1['sujet_id'];

    $select4 = mysqli_query($link, "SELECT * FROM enseignant WHERE id = '$id' ");
    $result4 = mysqli_fetch_assoc($select4);
    

    $select = mysqli_query($link, "SELECT * FROM sujet WHERE id = '$sujet_id' ");
   
    while($result = mysqli_fetch_assoc($select)){
    $titre=$result['titre'];
    $id=$result['id'];
    $resume=$result['résumé'];
    $specialite=$result['spécialité'];
    $mot_cle=$result['mot_clé'];
    $enseignant =$result['enseignant_id'];

    $select4 = mysqli_query($link, "SELECT * FROM enseignant WHERE id = '$enseignant' ");
    $result4 = mysqli_fetch_assoc($select4);

    $prof_nom = $result4['nom'];
    $prof_prenom = $result4['prenom'];

    }
}
class pdf extends TCPDF{


    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'estk.png';
        $this->Image($image_file, 170, 17, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $this->Ln(5);

        // Set font

        $this->SetFont('times', '', 10);
        $this->Cell(189, 4, '', 0, 1, 'c',);

        $this->SetFont('times', 'B', 15);
        $this->Cell(189, 5, 'UNIVERSITE IBN TOFAIL – KENITRA', 0, 1, 'c',);

        $this->SetFont('times', '', 12);

        $this->Cell(189, 3, 'Ecole superieure de technologie - Kenitra',  0, 1, 'c',);
       


        $this->SetFont('times', 'B', 11);
        // Title

        $this->Cell(189, 3, '',  0, 1, 'c',);

        $this->SetFont('times', 'B', 16);
        // Title
        $this->Ln(20);
        $this->Cell(0, 15, 'Fiche de résultat de PFE', 0, false, 'C', 0, '', 0, false, 'M', 'M');
       
        
    }




}


$pdf = new PDF('p','mm','A4');

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('el yazidi adnane');
$pdf->SetTitle('Fiche');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

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

$pdf->AddPage();
$pdf->Ln(50);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(189, 3, 'NOM:    '.$etudiant,  0, 1, 'c',);
$pdf->Ln(6);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(189, 3, 'PRENOM:    '.$prenom,  0, 1, 'c',);
$pdf->Ln(6);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(189, 3, 'CLASSEMENT:    '.$classement,  0, 1, 'c',);
$pdf->Ln(6);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(189, 3, 'ETUDIANT ID:   '.$etudiant_id,  0, 1, 'c',);
$pdf->Ln(6);

$pdf->SetFont('helvetica', 'B', 10);
$space=  '<p>'.'  '. '</p>';
$titro = 'TITRE   :    ';
$html =  '<p>'.$titro .$titre.'</p>';
$pdf->writeHTML($html,true,false,true,false,'');

//$pdf->Cell(189, 3, 'Titre du PFE :   '.$html,  0, 1, 'c',);
//$pdf->Cell(189, 3, 'Titre du PFE :   '.$titre ,  0, 1, 'c',);

$pdf->Ln(6);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(189, 3, 'SOUTENANCE ID:   '.$id,  0, 1, 'c',);
$pdf->Ln(6);
$space="  ";
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(189, 3, 'ENSEIGNANT :   '.$prof_nom .$space .$prof_prenom ,  0, 1, 'c',);
$pdf->Ln(6);


$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(189, 3, 'RESUME:    ',  0, 1, 'c',);
$pdf->Ln(4);
$pdf->SetFont('times', 'B', 10);
$html = '<p>'.$resume.'</p>';
$pdf->writeHTML($html,true,false,true,false,'');
/* $pdf->Cell(189, 3, 'Spécialité:        '.$specialite,  0, 1, 'c',); */

$pdf->Ln(8);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(189, 3, 'MOT-CLE:    '.$mot_cle,  0, 1, 'c',);
$pdf->Ln(10);

$pdf->SetFont('helvetica', ' ', 10);
$pdf->Cell(189, 3, 'IMPRIME LE :    '.date("Y-m-d H:i:s"),  0, 1, 'c',);
$pdf->Ln(12);







// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>