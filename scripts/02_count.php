<?php
$basePath = dirname(__DIR__);
$count = [];
$total = [];
$zones = [
    1 => '後壁.白河.東山.鹽水.新營.柳營區',
    2 => '北門.學甲.將軍.七股.佳里.西港區',
    3 => '下營.六甲.麻豆.官田.大內區',
    4 => '楠西.南化.玉井.左鎮區',
    5 => '善化.安定.新市.山上.新化區',
    6 => '安南區',
    7 => '永康區',
    8 => '北.中西區',
    9 => '安平.南區',
    10 => '東區',
    11 => '仁德.歸仁.關廟.龍崎區',
    12 => '平地原住民',
    13 => '山地原住民',
];
foreach(glob($basePath . '/json/*.json') AS $jsonFile) {
    $json = json_decode(file_get_contents($jsonFile), true);
    foreach($json['seats'] AS $seat) {
        if(!isset($count[$seat['name']])) {
            $count[$seat['name']] = 0;
            $total[$seat['name']] = 0;
        }
        if($seat['status'] != 2) {
            ++$count[$seat['name']];
        }
        ++$total[$seat['name']];
    }
}
arsort($count);
foreach($count AS $k => $v) {
    $rate = round($v / $total[$k], 3) * 100;
    echo "{$k}: {$v} / {$total[$k]} = {$rate}%\n";
}
