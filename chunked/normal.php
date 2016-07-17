<?php
function getOneData() {
    usleep(2000000);
    $str = '';
    for ($i = 0; $i < 10000; $i++) {
        $str .= '我是取出的第一个数据';
    }
    return $str;
}

$var1 = getOneData();

// 渲染第一块儿
include('./normal1.html.php');
ob_flush();
flush();

function getTwoData() {
    usleep(2000000);
    $str = '';
    for ($i = 0; $i < 10000; $i++) {
        $str .= '我是取出的第二个数据';
    }
    return $str;
}
$var2 = getTwoData();

// 渲染第二块儿
include('./normal2.html.php');
ob_flush();
flush();

function getThreeData() {
    usleep(2000000);
    $str = '';
    for ($i = 0; $i < 10000; $i++) {
        $str .= '我是取出的第三个数据';
    }
    return $str;
}
$var3 = getThreeData();

// 渲染第三块儿
include('./normal3.html.php');
ob_flush();
flush();
