<?php
class Html_file {
			public $html_file;
			public $class_id;
			public function __construct($class_id) {
						 $this->class_id = $class_id;
						 $this->html_file = "html/" . $this->class_id . ".php";
						 if (!file_exists($this->html_file)) {
						 		$this->html_file = "html/index.php";	
								}							
						 }
			}
?>