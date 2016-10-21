
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Match</title>

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

<div class="row">
<div class="col-xs-2"> </div>
<div class="col-xs-6">
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
			$vsi_matchi = $this->dani;
			$action = " action=" . Obrobnyk::$uri;
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
					echo '<form method="get"' . $action . '>';
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
</body>

</html>
