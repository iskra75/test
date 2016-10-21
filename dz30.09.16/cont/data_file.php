<?php
class Data_file {
			public $data_file;
			public $class_id;
			public function __construct($class_id) {
						 $this->class_id = $class_id;
						 $this->data_file = "modul/" . $this->class_id . ".txt";
						 if (!file_exists($this->data_file)) {
						 		$this->data_file = "modul/index.txt";
						 }
			}

}
?>