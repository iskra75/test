<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
		<title>DZ30.09.16</title>
    <style>
        label.label_link {cursor: pointer;}
    </style>
</head>

<?php
$action = " action=" . Obrobnyk::$uri;
?>


<body>

<form method="get" <?php $action ?> ><input type="hidden" name="sort" value="nomer" >
    <input type="submit"style="display:none" id="nomer"></form>
<form method="get" <?php $action ?> ><input type="hidden" name="sort" value="positio">
    <input type="submit"style="display:none" id="positio"></form>
<form method="get" <?php $action ?> ><input type="hidden" name="sort" value="priz">
    <input type="submit"style="display:none" id="priz"></form>
<form method="get" <?php $action ?> ><input type="hidden" name="sort" value="imja">
    <input type="submit"style="display:none" id="imja"></form>
<form method="get" <?php $action ?> ><input type="hidden" name="sort" value="zrist">
    <input type="submit"style="display:none" id="zrist"></form>
<form method="get" <?php $action ?> ><input type="hidden" name="sort" value="vaha">
    <input type="submit"style="display:none" id="vaha"></form>
		
<div class="row">
<div class="col-xs-2"> </div>
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
        foreach($this->dani as $hrav => $dani){
            if (strlen($dani)<=1) {break;}
            $kil_hrav++;
            $dani = explode(" | ", $dani);
            $dani = array_combine($kliuchi, $dani);
            $vsi_hravci[] = $dani;
        }
        //Сортировка
        if(!isset($_GET["sort"])) $sort = "nomer"; else $sort = $_GET["sort"];
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

</div>
<div class="col-xs-2"> </div>
</div>
</body>
</html>