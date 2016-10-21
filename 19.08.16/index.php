<!DOCTYPE html>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userData = [
        "date" => $_SERVER['REQUEST_TIME'],
        "email" => filter_var($_POST["email"], FILTER_SANITIZE_EMAIL),
        "name" => filter_var($_POST["name"], FILTER_SANITIZE_STRING),
        "comment" => filter_var($_POST["comment"], FILTER_SANITIZE_STRING),
    ];
    if (!filter_var($userData["email"], FILTER_VALIDATE_EMAIL)) {
        echo "Error! Wrong email";
        }
    file_put_contents("database.txt", implode(" | ", $userData) . "\n", FILE_APPEND);

}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Testing Iskra 19.08.2016</title>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class = "row">
    <div class = "col-md-2"></div>
    <div class = "col-md-8">
        <form method = "post" action = "index.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name = "name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Comment</label>
                <textarea name = "comment" class="form-control" id="exampleInputEmail1" placeholder="Comment"></textarea>
            </div>


            <button type="submit" class="btn btn-default">Submit</button>

        </form>

        <br /><br />

    </div>
    <div class = "col-md-2"></div>

<?php
$comments = file_get_contents("database.txt");
$comments = explode ("\n", $comments);
$keys = ["date", "email", "name", "text"];
foreach ($comments as $key => $item){
    if (strlen($item) > 1){
        $data = explode("|", $item);
        $comments[$key] = array_combine($keys, $data);
    } else { unset ($comments[$key]);}

}
usort ($comments, function ($a, $b){
    return $a['date'] < $b['date'];
});

?>
<!--
</div>
<div class = "row">
    <div class = "col-md-2"></div>
    <div class = "col-md-8">
        <?php foreach ($comments as $item):?>
        <div class = "well">
            <h4>
                <?=date("H:i:s d/m/y", $item['date'])?>
                <a href="mailto:<?=$item['email']?>"><?=$item['name']?></a>
                wrote:
            </h4>
            <span>
                <?=$item['text'];?>
            </span>
        </div>
        <?php endforeach; ?>

    </div>
    <div class = "col-md-2"></div>
</div>
--!>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>