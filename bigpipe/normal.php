<?php
// 渲染第一块儿的架子，还未获取内容
include('./normal1.html.php');
ob_flush();
flush();

// 获取第二块儿数据较快
function getTwoData() {
    $str = '';
    for ($i = 0; $i < 50; $i++) {
        $str .= '我是取出的第二个数据';
    }
    return $str;
}
$var2 = getTwoData();

// 渲染第二块儿
include('./normal2.html.php');
ob_flush();
flush();

// 获取地三块儿数据也较快
function getThreeData() {
    $str = '';
    for ($i = 0; $i < 70; $i++) {
        $str .= '我是取出的第三个数据';
    }
    return $str;
}
$var3 = getThreeData();
// 渲染第三块儿
include('./normal3.html.php');
ob_flush();
flush();

// 获取第一块儿数据最慢
function getOneData() {
    usleep(2000000);
    $str = '';
    for ($i = 0; $i < 50; $i++) {
        $str .= '我是取出的第一个数据';
    }
    return $str;
}

$var1 = getOneData();
// 渲染回填第一块儿
include('./normal4.html.php');
ob_flush();
flush();
