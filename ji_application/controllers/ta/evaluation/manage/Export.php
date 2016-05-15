<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'manage';
		$this->data['page_name'] = 'TA Evaluation System: Export to Excel';
		$this->data['banner_id'] = 5;
		$this->Mta_site->redirect_login($this->data['type']);
	}
	
	public function index()
	{
		$data = $this->data;
		$this->load->view('ta/evaluation/report/export', $data);
	}

	public function test()
	{
		$this->load->library('PHPExcel');

		define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		echo date('H:i:s'), " Create new PHPExcel object", EOL;
		$objPHPExcel = new PHPExcel();

		// Set document properties
		echo date('H:i:s'), " Set document properties", EOL;
		$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
		            ->setLastModifiedBy("Maarten Balliauw")->setTitle("PHPExcel Test Document")
		            ->setSubject("PHPExcel Test Document")
		            ->setDescription("Test document for PHPExcel, generated using PHP classes.")
		            ->setKeywords("office PHPExcel php")->setCategory("Test result file");


		// Add some data
		echo date('H:i:s'), " Add some data", EOL;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Hello')
		            ->setCellValue('B2', 'world!')->setCellValue('C1', 'Hello')
		            ->setCellValue('D2', 'world!');

		// Miscellaneous glyphs, UTF-8
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Miscellaneous glyphs')
		            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');


		$objPHPExcel->getActiveSheet()->setCellValue('A8', "Hello\nWorld");
		$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);


		// Rename worksheet
		echo date('H:i:s'), " Rename worksheet", EOL;
		$objPHPExcel->getActiveSheet()->setTitle('Simple');


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Save Excel 2007 file
		echo date('H:i:s'), " Write to Excel2007 format", EOL;
		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save(getcwd() . '/ji_file/ta/evaluation/1.xlsx');
		$callEndTime = microtime(true);
		$callTime = $callEndTime - $callStartTime;

		echo date('H:i:s'), " File written to ", str_replace('.php', '.xlsx', pathinfo(__FILE__,
		                                                                               PATHINFO_BASENAME)), EOL;
		echo 'Call time to write Workbook was ', sprintf('%.4f', $callTime), " seconds", EOL;
		// Echo memory usage
		echo date('H:i:s'), ' Current memory usage: ', (memory_get_usage(true) / 1024 /
		                                                1024), " MB", EOL;

		// Echo done
		echo date('H:i:s'), " Done writing files", EOL;
		echo 'Files have been created in ', getcwd() . '/ji_file/ta/evaluation/', EOL;
	}
}
