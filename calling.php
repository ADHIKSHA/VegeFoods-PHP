<?php
$host = "https://**.pythonanywhere.com";

$url = $host.'/1237R4';

echo http($url,["data"],'post');
function http($url,$data=[],$method='get'){
    $ch = curl_init();
    $chOpts = [
        CURLOPT_SSL_VERIFYPEER=>false,
        CURLOPT_HEADER=>false,
        CURLOPT_FOLLOWLOCATION=>true,
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_CONNECTTIMEOUT =>8,
        CURLOPT_TIMEOUT => 16,
        CURLOPT_HTTPHEADER,[
            'Content-Type: application/json'
        ]
    ];
    if($method=='post'){
        $chOpts[CURLOPT_POST]=true;
        $chOpts[CURLOPT_POSTFIELDS]=$data;
        $chOpts[CURLOPT_URL]=$url;
    }
    else{
        $url.='?'.is_array($data)?http_build_query($data):$data;
        $chOpts[CURLOPT_URL]=$url;
    }
    echo 'Request: '.$method.'['.$url.']'."\n";
    print_r($data);
    curl_setopt_array($ch, $chOpts);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
?>