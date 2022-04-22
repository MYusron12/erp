<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
//require_once('assets/dompdf/autoload.inc.php');
//require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");

// $base  = "http://" . $_SERVER['HTTP_HOST'];
// $base .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

require 'vendor/autoload.php';


use Dompdf\Dompdf;

Class Mypdf

{
	protected $ci;

	public function __construct()
	{
		$this->ci = get_instance();
		
	}

	public function generate($view, $data = array(), $filename = 'Laporan', $paper = 'A4', $orientation = 'potrait')
	{
		
		
        $dompdf = new Dompdf();
		$html = $this->ci->load->view($view, $data, TRUE);
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper($paper, $orientation);

		// Render the HTML as PDF
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		// $font = Font_Metrics::get_font("arial", "bold");
		$canvas->page_text(10, 10, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
	    ob_clean();
	    $dompdf->stream( $filename . ".pdf", array("Attachment" => FALSE));





	 
	}
}