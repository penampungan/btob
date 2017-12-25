<?php

namespace console\controllers;

use yii\console\Controller;		
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class MasterDataController extends Controller
{
	
	/**===========
	 * EXAMPLE 1
	 **===========
	{
	   "apikey":"55c450f34a57c3160d5a8bf050f14068",
	   "page":"host2host-ppob",
	   "function":"get-info-kelompok",
	   "param":{
			"memberid":"ZON13121710",
			"tipe":"PRE"   
		}
		
	}
	*/
	
	public function actionKelompokPostpaid()
    {
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		//$urlApi="http://dev.api.aptmi.com";
		// echo \Yii::$app->params['page'];
		// die();
		
		$client = new \GuzzleHttp\Client();
		//$dataHeader = ["ID"=>5,"NAMA" => "EKAX"];
		$dataBody = [
			"apikey"=>\Yii::$app->params['apikey'],
			"page" =>\Yii::$app->params['page'],
			"function" => \Yii::$app->params['infoKelompok'],
			"param" => [
				'memberid'=>\Yii::$app->params['memberid'],
				'tipe'=>'POST'
			],			
		];
		// echo json_encode($dataBody);
		$res = $client->post(\Yii::$app->params['urlApi'], ['body' => json_encode($dataBody), 'future' => true]);
		//echo $res->getStatusCode();
		echo $res->getBody();	
				
	}
	
	public function actionKelompokPrepaid()
    {
		$client = new \GuzzleHttp\Client();
		$dataBody = [
			"apikey"=>\Yii::$app->params['apikey'],
			"page" =>\Yii::$app->params['page'],
			"function" => \Yii::$app->params['infoKelompok'],
			"param" => [
				'memberid'=>\Yii::$app->params['memberid'],
				'tipe'=>'PRE'
			],			
		];
		// echo json_encode($dataBody);
		$res = $client->post(\Yii::$app->params['urlApi'], ['body' => json_encode($dataBody), 'future' => true]);
		//echo $res->getStatusCode();
		echo $res->getBody();	
				
	}
	
	public function actionProduk()
    {
		$client = new \GuzzleHttp\Client();
		$dataBody = [
			"apikey"=>\Yii::$app->params['apikey'],
			"page" =>\Yii::$app->params['page'],
			"function" => \Yii::$app->params['infoProduk'],
			"param" => [
				'memberid'=>\Yii::$app->params['memberid'],
				'kategori_id'=>'114',
			],			
		];
		// echo json_encode($dataBody);
		$res = $client->post(\Yii::$app->params['urlApi'], ['body' => json_encode($dataBody), 'future' => false]);
		echo $res->getStatusCode();
		echo $res->getBody();					
	}
	
	
	
	
	
	
	
	
	
}

?>