<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DZ19.08.16</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        label.label_link {cursor: pointer;}
    </style>
</head>
<body>
<?php

//Вносимо нового гравця
$perevirka = 0;
$validacija = 0;
if (empty($_POST["priz"])
    or empty($_POST["imja"])
    or $_POST["nomer"] == ""
    or empty($_POST["zrist"])
    or empty($_POST["vaha"])){
    $perevirka++;
    $validacija++;
}
if ($validacija == 0){
    if (!ctype_digit($_POST["nomer"])
    or !ctype_digit($_POST["zrist"])
    or !ctype_digit($_POST["vaha"])
    or !isset($_POST["positio"])){
    $perevirka++;
    echo "<h3><font color='red'>Помилка внесення даних! Повторіть спробу.</font></h3>";}
}

if ($perevirka == 0) {
    $novi_dani = [
        "priz" => filter_var($_POST["priz"], FILTER_SANITIZE_STRING),
        "imja" => filter_var($_POST["imja"], FILTER_SANITIZE_STRING),
        "nomer" => $_POST["nomer"],
        "zrist" => $_POST["zrist"],
        "vaha" => $_POST["vaha"],
        "positio" => $_POST["positio"]
    ];
    $novi_dani = implode(" | ", $novi_dani) . "\r\n";
    file_put_contents("command.txt", $novi_dani, FILE_APPEND);

}
unset($novi_dani);
unset($perevirka);
unset($validacija);

//Читаємо команду
$vsi_zapysy = file_get_contents("command.txt");
$vsi_zapysy = explode ("\r\n", $vsi_zapysy);

//Вносимо новий матч
if (!empty($_POST["nov_match"]) and $_POST["nov_match"] == "1"){
    if (strlen($_POST["data"]) > 0 and
    strlen($_POST["komanda1"]) > 0 and
    strlen($_POST["komanda2"]) > 0){
        $nov_match = [
            "data" => $_POST["data"],
            "komanda1" => filter_var($_POST["komanda1"], FILTER_SANITIZE_STRING),
            "komanda2" => filter_var($_POST["komanda2"], FILTER_SANITIZE_STRING),
            "rah1" => ".",
            "rah2" => "."
        ];
        $nov_match = implode(" | ", $nov_match) . "\r\n";
        file_put_contents("match.txt", $nov_match, FILE_APPEND);
    }
}
//Читаємо матчі
$vsi_matchi = file_get_contents("match.txt");
$vsi_matchi = explode("\r\n", $vsi_matchi);

//Вносимо рахунок
if (isset($_POST["nov_rah"]) and $_POST["nov_rah"] == "1"){
	$riadok = $_POST["riadok"];
	$kil_riad = 0;
	foreach ($vsi_matchi as $key => $value){
		if (strlen($value) < 1) break;
		$kil_riad++;
	}
	$nov_rah1 = $_POST["rah1"];
	$nov_rah2 = $_POST["rah2"];
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
	
	file_put_contents("match.txt", $nov_vsi_matchi);
}
?>



<form method="post"><input type="hidden" name="sort" value="nomer"><input type="submit"style="display:none" id="nomer"></form>
<form method="post"><input type="hidden" name="sort" value="positio"><input type="submit"style="display:none" id="positio"></form>
<form method="post"><input type="hidden" name="sort" value="priz"><input type="submit"style="display:none" id="priz"></form>
<form method="post"><input type="hidden" name="sort" value="imja"><input type="submit"style="display:none" id="imja"></form>
<form method="post"><input type="hidden" name="sort" value="zrist"><input type="submit"style="display:none" id="zrist"></form>
<form method="post"><input type="hidden" name="sort" value="vaha"><input type="submit"style="display:none" id="vaha"></form>
<div class="row">
    <div class="col-xs-2"> </div>
    <div class="col-xs-2">
        <!--Додаємо гравця-->
        <br /><br /><br />
        <h4>Додати гравця</h4>
        <form method="post">
            <input type="text" name="priz" id="prizInput" placeholder="Прізвище" size="17">
            <br />
            <input type="text" name="imja" id="imjaInput" placeholder="Ім'я" size="17">
            <br />
            <input type="text" name="nomer" id="nomerInput" placeholder="№" size="5" maxlength="2">
            <br />
            <input type="text" name="zrist" id="zristInput" placeholder="Зріст (cm)" size="5" maxlength="3">
            <br />
            <input type="text" name="vaha" id="vahaInput" placeholder="Вага (kg)" size="5" maxlength="3">
            <br />
            <select name="positio">
                <option selected disabled value="NULL">Позиція</option>
                <option value="Cent">Center</option>
                <option value="PG">Point Guard</option>
                <option value="SG">Shooting Guard</option>
                <option value="SF">Small Forward</option>
                <option value="PF">Power Forward</option>
            </select>
            <br />
            <input type="submit" value="Внести дані">
        </form>
        <br />

        <!--Додаємо матч-->
        <h4>Додати матч</h4>
        <form method="post">
            <input type="hidden" name="nov_match" value="1">
            <input type="date" name="data">
            <br />
            <input type="text" name="komanda1" placeholder="Команда 1" size="17">
            <br />
            <input type="text" name="komanda2" placeholder="Команда 2" size="17">
            <br />
            <input type="submit" value="Внести дані">
        </form>

    </div>


    <div class="col-xs-6">
        <center><h3><b>Баскетбольна команда</b></h3></center>
        <table class="table" border="2" align="center">
            <tr align="center">
                <td align="center" width="5%">
                    <label for="nomer" class="label_link"><a><h4>Номер</h4></a></label>
                </td>
                <td align="center" width="5%">
                    <label for="positio" class="label_link"><h4><a>Позиція</a></h4></label>
                </td>
                <td align="center">
                    <label for="priz" class="label_link"><a><h4>Прізвище</h4></a></label>
                </td>
                <td align="center">
                    <label for="imja" class="label_link"><a><h4>Ім'я</h4></a></label>
                </td>
                <td align="center" width="10%">
                    <label for="zrist" class="label_link"><a><h4>Зріст</h4></a></label>
                </td>
                <td align="center" width="10%">
                    <label for="vaha" class="label_link"><a><h4>Вага</h4></a></label>
                </td>
            </tr>
            <?php
            $kliuchi = ["priz", "imja", "nomer", "zrist", "vaha", "positio"];
            $kil_hrav = 0;
            $vsi_hravci = array();
            foreach($vsi_zapysy as $hrav => $dani){
                if (strlen($dani)<=1) {break;}
                $kil_hrav++;
                $dani = explode(" | ", $dani);
                $dani = array_combine($kliuchi, $dani);
                $vsi_hravci[] = $dani;
            }
            //Сортировка
            if(!isset($_POST["sort"])) $sort = "nomer"; else $sort = $_POST["sort"];
            $zapysy_sort = array();
            foreach($vsi_hravci as $hrav => $dani){
                $zapysy_sort[$hrav] = $dani[$sort];
            }
            $zapysy_sort = array_multisort($zapysy_sort, $vsi_hravci);
            foreach ($vsi_hravci as $riadok => $dani){

                echo '<tr align="center">';
                echo '<td>';
                echo $dani["nomer"];
                echo '</td>';
                echo '<td>';
                echo $dani["positio"];
                echo '</td>';
                echo '<td>';
                echo $dani["priz"];
                echo '</td>';
                echo '<td>';
                echo $dani["imja"];
                echo '</td>';
                echo '<td>';
                echo $dani["zrist"];
                echo '</td>';
                echo '<td>';
                echo $dani["vaha"];
                echo '</td>';

                echo '</tr>';
            }



            ?>
        </table>
        <br />
        <center><h3><b>Розклад матчів</b></h3></center>
        <table class="table" border="2" align="center">
          <tr align="center">
              <td align="center" width="20%">
                 <h4><b>Дата</b></h4>
              </td>
              <td align="center" width="30%">
                  <h4><b>Команда 1</b></h4>
              </td>
              <td align="center" width="20%">
                  <h4><b>Рахунок</b></h4>
              </td>
              <td align="center" width="30%">
                  <h4><b>Команда 2</b></h4>
              </td>
          </tr>
            <?php
			$vsi_matchi = file_get_contents("match.txt");
			$vsi_matchi = explode("\r\n", $vsi_matchi);
            foreach ($vsi_matchi as $match => $match_dani){
                if (strlen($match_dani) < 1) break;
                $match_dani = explode (" | ", $match_dani);
                list ($data, $komanda1, $komanda2, $rah1, $rah2) = $match_dani;
                list($rik, $mis, $den) = explode("-", $data);
                echo '<tr align="center"';
                if ($rah1 != "." or $rah2 != ".") echo ' bgcolor="grey"';
                echo '>';
                echo '<td align="center">';
                echo $den . "." . $mis . "." . $rik;
                echo '</td>';
                echo '<td>';
                echo $komanda1;
                echo '</td>';
                echo '<td align="center">';
                if ($rah1 != "." or $rah2 != ".") echo $rah1 . ":" . $rah2;
				if ($rah1 == "." or $rah2 == "."){
					echo '<form method="post">';
					echo '<input type="hidden" name="nov_rah" value="1">';
					echo '<input type="hidden" name="riadok" value="' . $match . '">';
					echo '<input type="text" name="rah1" maxlength="3" size="1">';
					echo ":";
					echo '<input type="text" name="rah2" maxlength="3" size="1">';
					echo '<input type="submit"style="display:none" id="rah' . $match . '">';
					echo '</form>';
					echo '<label for="rah' . $match . '" class="label_link"><a>Внести</a></label>';
				}
                echo "";
                echo '</td>';
                echo '<td>';
                echo $komanda2;
                echo '</td>';
                echo '</tr>';
            }
            unset($_POST);
            ?>
        </table>

        


    </div>
    <div class="col-xs-2"> </div>
</div>
<br /><br /><br /><br /><br /><br /><br /><br />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>