<?php
//??????? ???????
class Vnesty_rah {
		public function __construct($get, $dani, $file) {
						 $data_file = $file;
						 $vsi_matchi = $dani;
						 $kil_riad = 0;
						 foreach ($vsi_matchi as $key => $value){
						 if (strlen($value) < 1) break;
						 $kil_riad++;
						 }
			$nov_rah1 = $get["rah1"];
			$nov_rah2 = $get["rah2"];
			$riadok = $get["riadok"];
			$nov_vsi_matchi = array();
			for ($i=0; $i< $kil_riad; $i++){
					$zapys = explode(" | ", $vsi_matchi[$i]);
					list($data, $komanda1, $komanda2, $rah1, $rah2) = $zapys;
			if ($i == $riadok){
				 $rah1 = $nov_rah1;
				 $rah2 = $nov_rah2;
				 }
			$zapys = $data . " | " . $komanda1 . " | " . $komanda2 . " | " . $rah1 . " | " . $rah2 . "\r\n";
		  $nov_vsi_matchi[$i] = $zapys;
			
	    }
	    
	    file_put_contents($data_file, $nov_vsi_matchi);
		}
}
?>