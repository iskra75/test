<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
 <?php 
 if($_SERVER['REQUEST_METHOD'] == "POST"){
 		
		if(isset($_FILES['testFile']) && $_FILES['testFile']['error'] == 0 && $_FILES['testFile']['type'] == "image/jpeg"){
				if ($size = getimagesize($_FILES['testFile']['tmp_name'])){
					 if (!is_dir("uploads")){mkdir("uploads", 0775);}
					 $nov_imja = "image_" . time() . ".jpg";
					 $uploadFile = "uploads/" . $nov_imja;
					 move_uploaded_file($_FILES['testFile']['tmp_name'], $uploadFile);
					 }
				}
		if (isset($_POST["pidpys"])){
			 $pidpys = filter_var($_POST["pidpys"], FILTER_SANITIZE_STRING);
			 $nov_zapys = $nov_imja . " | " . $pidpys . "\r\n";
			 $file_zap = fopen("pidpys.txt", "a");
			 fwrite($file_zap, $nov_zapys);
			 fclose($file_zap);
			 }
		}
 
  ?>   
		
		<div class="row">
				 <div class="col-md-2"></div>
				 <div class="col-md-8">
				 <center><h3>Hello, world!</h3></center>
				 <form method="post" action="index.php" enctype="multipart/form-data">
				 			 <div class="form-group">
							 <label for="testFile">File input</label>
							 <input type="file" name="testFile" id="testFile" />
							 <br />
							 <input type="text" name="pidpys" /> –î–æ–¥–∞–π—Ç–µ –ø—ñ–¥–ø–∏—Å
							 </div>
							 
							 <button type="submit" class="btn btn-default">Submit</button>
				 </form>
				 </div>
				 <div class="col-md-2"></div>
		</div>
<br /><br />
<?php 
$handle = opendir("uploads");
$files = array();
while ($file = readdir($handle)){
			if (strstr($file, ".jpg")){
				 $files[] = $file;
				 }
			}
$files2 = glob("uploads/*.jpg");
closedir($handle);

 ?>
<div class="row">
 <div class="col-md-2"></div>
 <div class="col-md-8">
 <table align="center" cellpadding="5" width="100%">
 <?php 
 //◊ËÚ‡∫ÏÓ Ô≥‰ÔËÒË
 $vsi_zapysy = file_get_contents("pidpys.txt");
 $vsi_zapysy = explode("\r\n", $vsi_zapysy);
 $nomer = 0;
 foreach ($files as $file){
 			$nomer++;
			if (is_int(($nomer - 1) / 4)){
				 echo '<tr>';
				 }
			echo '<td align="center">';
			echo '<a href="';
			echo "uploads/" . $file;
			echo '" target="_blank">';
			echo '<img src="uploads/';
			echo $file;
			echo '" alt="..." width="120">';
			echo '</a>';
			foreach($vsi_zapysy as $zapys){
					$zapys = explode(" | ", $zapys);
					if ($zapys[0] == "$file"){
						 echo '<br /><b>' . $zapys[1] . '</b>';
						 break;
						 }
					}
			echo '</td>';
			if (is_int($nomer / 4)){
				 echo '</tr>';
				 }
			}
  
	?>
	</table>
	</div>
	<div class="col-md-2"></div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>