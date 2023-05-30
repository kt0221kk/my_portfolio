<?php
/*
更新日時：2020.10.15

./var/www/html/

ログファイル書き込み
MySQL格納
*/

//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

//ログファイルの指定
$path = "/var/www/html/sensor_test.log";

//MySQL関連のパラメータ
$host = 'localhost';
$username = 'root';
$passwd = '55otsukalab!!';
//$dbname = 'Futaba';
//$tablename = 'BLEBeacon';
$sensordb = 'human_sensor';
$sensortable = 'human_sensor_table';
//ログファイルへのアクセス可否（確認用）
if (is_writable($path)) {
    print "FILE($path) :OK\r\n";
} else {
    print "FILE($path) :NG\r\n";
}
$sensorpath = "/var/www/html/logfile/sensor_test.log";
$file = fopen($sensorpath, 'a');
if($file == FALSE){
    print "FALE TO OPEN FILE..";
}
fwrite($file, "test php\r\n");
fclose($file);
//POSTを確認した時のみ処理
if(!empty($_POST) && is_writable($path) ) {
    //人感センサパラメータ
    $SENSORID = $_POST['id'];
    $RSSI = $_POST['rssi'];
    //キー取得
    $keys = array_keys($_POST);
    $path = "/var/www/html/logfile/sensor_test.log";
    print "DATA type :INVALID\r\n";
    //ログファイルへの書き込み（送信データ不適）
    $file = fopen($path, 'a');
    fwrite($file, "POST :" . date("Y/m/d H:i:s"));
    fwrite($file, json_encode ( $_POST ) . " \r\n");
    //処理の中断


    fclose($file);
    return FALSE;
} else {
    //GET受信時の処理
    print "GET\r\n";
}
//MySQLへのアクセス切断
//mysqli_close($link);
// mysqli_close($sensorlink);
?>

