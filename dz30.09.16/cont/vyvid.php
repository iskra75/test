<?php 

class Vyvid {
			public $dani;
			public $html_file;
			public $buffer;
			public function __construct($dani, $html_file) {
						 $this->dani = $dani;
						 $this->html_file = $html_file;
						 include_once $this->html_file;
						 
			}

}
?>