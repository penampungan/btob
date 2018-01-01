<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;		
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use yii\helpers\ArrayHelper;
use console\models\PpobMasterType;
use console\models\PpobMasterKelompok;
use console\models\PpobMasterKtg;
use console\models\PpobMasterFungsi;
use console\models\PpobMasterData;

class MasterDataController extends Controller
{	
	
	public function actionCoba(){		
		$allDataKelpmpok=Yii::$app->ppobh2h->ArrayKelompokAllType();
		//print_r($allDataKelpmpok);
		//[2]==== GET ARRAY KELOMPOK ====
		// foreach($allDataKelpmpok as $row2 => $value2){
			// $groupKelompok[]=$row2;
		// } 
		// $groupKelompok=self::simpanGroupKelompok($allDataKelpmpok);
		// print_r($groupKelompok);
		// $kategoryKelompok=self::simpanKategoriKelompok($allDataKelpmpok);
		// print_r($kategoryKelompok);
		$dataProduk=self::simpanDataProduk($allDataKelpmpok);
		print_r($dataProduk);
	}
	
	
	/*  TITTLE	: GROUP KELOMPOK
	 *  ACTION	: SIMPAN/UPDATE
	 *  TABLE	: ppob_master_kelompok
	*/
	private function simpanGroupKelompok($allDataKelpmpok=[]){		
		foreach($allDataKelpmpok as $row2 => $value2){
			$modalValidasi=PpobMasterKelompok::find()->where(['KELOMPOK'=>$row2])->one();
			if(!$modalValidasi){
				$model=new PpobMasterKelompok();
				$model->KELOMPOK=$row2;
				$model->save();				
			}
			$rslt[]= $row2;
		}
		return $rslt;
	}	
	
		
	/*  TITTLE	: KATEGORY KELOMPOK
	 *  ACTION	: SIMPAN/UPDATE
	 *  TABLE	: ppob_master_ktg
	*/
	private function simpanKategoriKelompok($allDataKelpmpok=[]){			
		foreach($allDataKelpmpok as $row1 => $value1){
			foreach($allDataKelpmpok[$row1] as $row2 => $value2){				
				$modelKtg= new PpobMasterKtg();
				$modelKtg->KTG_ID=(string)$value2['id'];
				$modelKtg->KTG_NM=(string)$value2['kategori'];
				$modelKtg->KELOMPOK=(string)$value2['kelompok'];
				$modelKtg->save();
				$dataKtg[]=$value2['id'];
				$dataKtg[]=$value2['kategori'];
				$dataKtg[]=$value2['kelompok'];
			}
		}		
		return $dataKtg;
	}	
	
	/*  TITTLE	: TYPE/GROUP/KATEGORY PRODUK
	 *  ACTION	: SIMPAN/UPDATE
	 *  TABLE	: ppob_master_data
	*/
	private function simpanDataProduk($allDataKelpmpok=[]){			
		foreach($allDataKelpmpok as $row1 => $value1){
			foreach($allDataKelpmpok[$row1] as $row2 => $value2){				
				//$modelKtg= new PpobMasterKtg();
				// $modelKtg->KTG_ID=(string)$value2['id'];
				// $modelKtg->KTG_NM=(string)$value2['kategori'];
				// $modelKtg->KELOMPOK=(string)$value2['kelompok'];
				//$modelKtg->save();
				// $dataKtg[]=$value2['id'];
				// $dataKtg[]=$value2['kategori'];
				// $dataKtg[]=$value2['kelompok'];
				//$dataProduk[]=Yii::$app->ppobh2h->ArrayProduk($value2['id']);
				$dataProduk[]=$value2['id'];
				//$dataProduk[]=Yii::$app->ppobh2h->ArrayProduk('96');
				// $dataProduk='';
				// $dataProduk=Yii::$app->ppobh2h->ArrayProduk($value2['id']);
				// $dataProduk[id] => 337
                    // [kode] => TOP45P
                    // [nama] => TV TOPAS Paket Pengetahuan
                    // [denom] => 50000
                    // [harga] => 45000
                    // [permit] => 1

			}
		}		
		return $dataProduk;
	}	
	
	
	
	
	
	
	
		/* 
			$groupKelompok[]="(".$row2.",".$value2[''].")";
			//$groupKelompok[]=$row2.',12';
			//			$groupKelompok[]='123';
			//$modelGroupKelompok=PpobMasterKelompok::find()->where		
		}  */
		//$values  = "('".str_replace(',',"'),('",implode(',', $groupKelompok))."')";
		//$values  = "('".str_replace(',',"'),('",implode(',', $groupKelompok))."')";
		/* $sqlstr="
			INSERT INTO ppob_master_kelompok(KELOMPOK) VALUES ".$values;
		// Yii::$app->db->createCommand($sqlstr)->execute();
		Yii::$app->db->createCommand($sqlstr)->execute();
		//return $groupKelompok;		 */
		
}

?>