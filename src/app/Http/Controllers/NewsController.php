<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
    $url = 'https://bkrs3waxwg.execute-api.ap-northeast-1.amazonaws.com/default/news';

    $options = array(
        // HTTPコンテキストオプションをセット
        'http' => array(
            'method'=> 'GET',
            'header'=> 'Content-type: application/json; charset=UTF-8' //JSON形式で表示
        )
    );
    
    // ストリームコンテキストの作成
    $context = stream_context_create($options);
    
    $raw_data = file_get_contents($url, false,$context);
    
    // debug
    //var_dump($raw_data);
    
    // json の内容を連想配列として $data に格納する
    $data = json_decode($raw_data,true);
    // dd($data);

    return view('user.news', compact('url', 'data'));
    }
    public function detail($id)
    {
    $url = 'https://bkrs3waxwg.execute-api.ap-northeast-1.amazonaws.com/default/news/' . $id;

    $options = array(
        // HTTPコンテキストオプションをセット
        'http' => array(
            'method'=> 'GET',
            'header'=> 'Content-type: application/json; charset=UTF-8' //JSON形式で表示
        )
    );
    
    // ストリームコンテキストの作成
    $context = stream_context_create($options);
    
    $raw_data = file_get_contents($url, false,$context);
    
    // debug
    //var_dump($raw_data);
    
    // json の内容を連想配列として $data に格納する
    $data = json_decode($raw_data,true);
    // dd($data);

    return view('user.news_post', compact('url', 'data'));
    }
}
