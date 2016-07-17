<?php
function asyncRequest($host, $url, $port=8082, $conn_timeout=30, $rw_timeout=86400) {
    $errno = '';
    $errstr = '';
    $fp = fsockopen($host, $port, $errno, $errstr, $conn_timeout);
    if (!$fp) {
       echo "Server error:$errstr($errno)";
       return false;
    }
    stream_set_timeout($fp, $rw_timeout);
    stream_set_blocking($fp, false);

    $rq = "GET $url HTTP/1.0\r\n";
    $rq .= "Host: $host\r\n";
    $rq .= "Connect: close\r\n\r\n";
    fwrite($fp, $rq);
    return $fp;
}

function asyncFetch(&$fp) {
   if ($fp === false) return false;

   if (feof($fp)) {
      fclose($fp);
      $fp = false;
      return false;
   }
   return fread($fp, 10000);
}

$fp1 = asyncRequest('localhost', '/bigpipeparal/data1.php');
$fp2 = asyncRequest('localhost', '/bigpipeparal/data2.php');
$fp3 = asyncRequest('localhost', '/bigpipeparal/data3.php');

include('normal_frame.html.php');
ob_flush();
flush();

while (true) {
    sleep(1);
    $r1 = asyncFetch($fp1);
    $r2 = asyncFetch($fp2);
    $r3 = asyncFetch($fp3);

    if ($r1 != false) {
        preg_match('/\|(.+)\|/i', $r1, $res);
        $var1 = $res[1];
        include('normal1.html.php');
    }

    if ($r2 != false) {
        preg_match('/\|(.+)\|/i', $r2, $res);
        $var2 = $res[1];
        include('normal2.html.php');
    }

    if ($r3 != false) {
        preg_match('/\|(.+)\|/i', $r3, $res);
        $var3 = $res[1];
        include('normal3.html.php');
    }

    if ($r1 == false && $r2 == false && $r3 == false) {
        break;
    }
    
    ob_flush();
    flush();
}
