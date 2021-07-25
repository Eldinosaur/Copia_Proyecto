<?php
	require_once("pdf.php");
	include_once("sql.php");
	//herencia para crear una cabecera y un pie de pagina (Header /footer)

	/**
	 * 
	 */
	class my_pdf extends TCPDF{
		//metodo para cabecera
		public function Header(){
			//añadir logotipo
			$image_file = K_PATH_IMAGES.'images/logo.jpg';  //busca automaticamente una imagen en el directorio
			$this->Image($image_file,10,10,15,'','JPG','','T',false,300,'',false,false,0,false,false);
			//colocar el font
			$this->SetFont('times','B',20);
			//Titulo
			$this->Cell(0,15,'Certificado',0,false,'C',0,'',0,false,'M','M');
		}
		//metodo footer
		public function Footer(){
			//espacio o posicion que ocupara en la parte inferior (se coloca un valor en milimetros)
			$this->SetY(-15);
			//colocar un font 
			$this->SetFont('times','I',8);
			//añadir numeracion
			$this->Cell(0,15,'Optica Sudamericana - Nuestra misión es su visión',0,false,'C',0,'',0,false,'M','M');
		}
	}
	//creando una instancia de la clase pdf
	$pdf = new my_pdf(PDF_PAGE_ORIENTATION, PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
	//formatear el documento
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Dino');
	$pdf->SetTitle($_GET['cedula']);
	$pdf->SetSubject('Primer PDF');
	$pdf->SetKeywords('sw, dino, pdf');
	//valores predefinidos para la cabecera
	$pdf->SetHeaderData(PDF_HEADER_LOGO,PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE,PDF_HEADER_STRING);
	//activar fuentres de cabecera y pie de pagina
	$pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
	$pdf->SetFooterFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
	//activar fuentes por defecto del documento
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	//colocar margenes del PDF
	$pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	//colocar los saltos de pagina
	$pdf->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);
	//colocamos escalas para las imagenes
	$pdf->SetImageScale(PDF_IMAGE_SCALE_RATIO);
	//formatear el lenguaje de creacion del PDF (opcional)

	//colocar una fuente al texto
	$pdf->SetFont('times','BI',12);
	//añadir una pagina
	$pdf->AddPage();
	$html='<div align="center">
		<h4>Datos del Paciente</h4>
		</div>
		<br>
		<div>
			<table align="center">'.datos_certificado($_GET['cedula']).'
			</table>
		</div>
		<br>
		<div align="center">
			<h4>Historial de Medidas</h4>
		</div>
		<div>
		<table align="center" border="1">
			<tr>
				<td><b>Fecha</b></td>
				<td><b>OD</b></td>
				<td><b>Eje OD</b></td>
				<td><b>OI</b></td>
				<td><b>Eje OI</b></td>
				<td><b>Observacion</b></td>
			</tr>
			'.medidas_paciente($_GET['cedula']).'
		</table>
		<br>
		<br>
		<br>
		<br>
		<br>
		<div align="center">
		<p>Certifica</p>
		</div>
		<br>
		<br>
		<br>
		<br>
		<div>
		<p></p>
		</div>
		<br>
		<br>
		<br>
		<div align="center">
		<p>_______________________</p>
		</div>
		<br>
		<div align="center">
		<p>'.$_SESSION['nombre'].'</p>
		<p>Optometra</p>
		</div>';
	//colocar en el pdf el texto o elementos necesarios
	$pdf->writeHTML($html,true,0,true,0);
	$pdf->LastPage();
	$pdf->Output($_GET['cedula'].'.pdf','I');

?>