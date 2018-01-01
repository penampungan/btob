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
				//$dataProduk[]=$value2['id'];
				// if ($value2['id']=='96'){											// ==CHECK ONLY ONE KATEGORY
					// $dataProduk=Yii::$app->ppobh2h->ArrayProduk('96');				// ==CHECK ONLY ONE KATEGORY
					$dataProduk=Yii::$app->ppobh2h->ArrayProduk($value2['id']);
					foreach($dataProduk as $row3 => $value3){
						$model= new PpobMasterData();
							//== TYPE KELOMPOK ==
							$dataProdukDetail['TYPE_NM']=$value2['kelompok']=='PASCABAYAR'?$value2['kelompok']:'PRABAYAR';
							//== GROUP KELOMPOK ==
							$dataProdukDetail['KELOMPOK']=$value2['kelompok'];
							//== KELOMPOK KATEGORY==
							$dataProdukDetail['KTG_ID']=$value2['id'];
							$dataProdukDetail['KTG_NM']=$value2['kategori'];						
							//== DETAIL PRODUK ==
							$dataProdukDetail['ID_CODE']=$value3['id'];
							$dataProdukDetail['CODE']=$value3['kode'];
							$dataProdukDetail['NAME']=$value3['nama'];
							$dataProdukDetail['DENOM']=$value3['denom'];
							$dataProdukDetail['HARGA']=$value3['harga'];
							$dataProdukDetail['PERMIT']=$value3['permit'];
						//== TYPE KELOMPOK ==
						$model->TYPE_NM=(string)$value2['kelompok']=='PASCABAYAR'?$value2['kelompok']:'PRABAYAR';
						//== GROUP KELOMPOK ==
						$model->KELOMPOK=(string)$value2['kelompok'];
						//== KELOMPOK KATEGORY==
						$model->KTG_ID=(string)$value2['id'];
						$model->KTG_NM=(string)$value2['kategori'];						
						//== DETAIL PRODUK ==
						$model->ID_CODE=(string)$value3['id'];
						$model->CODE=(string)$value3['kode'];
						$model->NAME=(string)$value3['nama'];
						$model->DENOM=(string)$value3['denom'];
						$model->HARGA=(string)$value3['harga'];
						$model->PERMIT=(string)$value3['permit'];
						$model->save();
					}
				//} // CHECK ONLY ONE KATEGORY
			}
		}		
		// return $dataProduk;
		return $dataProdukDetail;
	}			
}

?>