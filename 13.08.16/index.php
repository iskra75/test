<html>
<?php

$hr1 = array('num' => 0, 'poz' => 'З/Ф', 'imja' => 'Ник', 'priz' => 'Янг', 'zr' => 201, 'vaha' => 95);
$hr2 = array('num' => 1, 'poz' => 'З', 'imja' => 'Д\'Анджело', 'priz' => 'Расселл', 'zr' => 196, 'vaha' => 86);
$hr3 = array('num' => 2, 'poz' => 'Ф', 'imja' => 'Брендон', 'priz' => 'Басс', 'zr' => 203, 'vaha' => 113);
$hr4 = array('num' => 3, 'poz' => 'З/Ф', 'imja' => 'Ентоні', 'priz' => 'Браун', 'zr' => 201, 'vaha' => 98);
$hr5 = array('num' => 4, 'poz' => 'Ф', 'imja' => 'Райані', 'priz' => 'Келлі', 'zr' => 211, 'vaha' => 104);
$komanda = array($hr1, $hr2, $hr3, $hr4, $hr5);

echo '<b>';
echo 'Сортировка по зросту';
echo '</b>';
echo '<br />';
$po_zrostu = array();
foreach ($komanda as $key=>$val){
    $po_zrostu[$key]=$val['zr'];
}
array_multisort($po_zrostu, $komanda);
for ($n=0; $n<5; $n++){
    $hravec = $komanda[$n];
    echo $hravec['zr'];
    echo "cm";
    echo '&nbsp;';
    echo $hravec['imja'];
    echo '&nbsp;';
    echo $hravec['priz'];
    echo '&nbsp;';
    echo '№';
    echo $hravec['num'];
    echo '<br />';
}

/*
echo '<pre>';
print_r($komanda);
echo '</pre>';*/


echo '<br />';
echo '<b>';
echo 'Сортировка по імені';
echo '</b>';
echo '<br />';
$po_imeni = array();
foreach($komanda as $kluch=>$znach){
    $po_imeni[$kluch] = $znach['priz'];
}
array_multisort($po_imeni, $komanda);
for ($n=0; $n<5; $n++){
    $hravec = $komanda[$n];
    echo $hravec['imja'];
    echo '&nbsp;';
    echo $hravec['priz'];
    echo '&nbsp;';
    echo '№';
    echo $hravec['num'];
    echo '<br />';
}


?>
</html>

