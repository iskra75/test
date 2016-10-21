<?php
class Dani {
			public $dani;
			public $data_file;
			public function __construct($data_file) {
						 $this->data_file = $data_file;
						 $this->dani = file_get_contents("$this->data_file");
						 $this->dani = explode ("\r\n", $this->dani);
						 }
			}
?>