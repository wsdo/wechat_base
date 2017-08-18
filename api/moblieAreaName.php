<?php

// header('Content-Type: text/html; charset=gbk'); //网页编码
// require_once('./Curl.php');
// print_r($data);

class AreaName
{
  public static function getData($data){
    $url = 'https://chongzhi.jd.com/json/order/search_searchPhone.action?mobile='.$data.'&_=1503037111350';
    // $data = file_get_contents($url);
    $data = Curl::CurlGet($url);
    $data = explode(',',$data);
    $sheng = $data[1];
    $sheng = explode(':',$sheng);
    $yys = $data[2];
    $yys = explode(':',$yys);
    $arr = ['sheng' => iconv('GB2312', 'UTF-8', $sheng[1]), 'yys' => iconv('GB2312', 'UTF-8', $yys[1])];
    // echo '<pre>';
    // $data = json_decode($data);
    // print_r($arr);
    // $data = stripslashes(html_entity_decode($data)); //$info是传递过来的json字符串
    // $data = json_encode($data);
    return $arr;
  }


}

// $data = AreaName::getData('18032067618');
// print_r($data);