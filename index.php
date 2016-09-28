<?php

//测试

include_once('XmlParser.php');

$xml = '<xml><ToUserName><![CDATA[ouBTyw4kExNwmAPdLazEIK35JX9A]]></ToUserName><FromUserName><![CDATA[gh_1e25e2fb8845]]></FromUserName><CreateTime><![CDATA[1474537107]]></CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[你好]]></Content></xml>';

$arr = XmlParser::xml2arr($xml);

$obj = XmlParser::xml2obj($xml);

$test_arr = array(
    'name' => array(
        'first' => 'hu',
        'second' => 'yue'
    ),
    'age' => 20
);

$test_obj->name->first = 'hu';
$test_obj->name->second = 'yue';
$test_obj->age = 20;

var_dump($arr);

var_dump($obj);

echo XmlParser::arr2xml($test_arr, true);

echo XmlParser::obj2xml($test_obj, true);