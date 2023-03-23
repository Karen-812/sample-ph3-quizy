<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InputData;
use Illuminate\Support\Facade;
// Carbon
// require_once __DIR__ . '/vendor/autoload.php';
use Carbon\Carbon;


class WebappController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        // 現在の時刻からインスタンスを生成
        $current_year = Carbon::now()->format('Y');
        $current_month = Carbon::now()->format('m');
        $today = Carbon::now()->format('d');

        // トータル時間
        $total_sum = InputData::sum('hours');

        // 今月の合計時間
        $month_sum = InputData::whereYear('date', $current_year)->whereMonth('date', $current_month)->sum('hours');

        // 今日の合計時間
        $today_sum = InputData::whereYear('date', $current_year)->whereMonth('date', $current_month)->whereDay('date', $today)->sum('hours');


        /* グラフ     
        // 方針：PHPでしか使えない形 → エンコード → JS → グラフ用にさらに整形
        // PHPである程度整える →エンコードもあり
        */

        // 棒グラフ  日毎の勉強時間をGroupByで集計
        $chart_day = InputData::whereYear('date', $current_year)->whereMonth('date', $current_month)
            ->selectRaw('sum(hours) as `h`, date')
            ->groupByRaw('date')
            ->get();

        $c = json_encode($chart_day);

        // ドーナツグラフ1  言語毎の勉強時間
        /*
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["laguage", "portion"],
                    ["HTML", 30],
                    ["CSS", 20],
                    ["JavaScript", 10],
                    ["PHP", 5],
                    ["Laravel", 5],
                    ["SQL", 20],
                    ["SHELL", 20],
                    ["その他", 10],
                ]);
            */

        // $chart_language = InputData::whereYear('date', $current_year)->whereMonth('date', $current_month)
        // ->selectRaw('languages, (100.0 * sum(hours) / SUM(hours) AS lang_time')
        // ->groupByRaw('languages')
        // ->get();

        // $c2 = json_encode($chart_language);


        /* IDと学習言語名紐付け
        $test_prepare = $pdo->prepare(
            'SELECT language_num.language, (100.0 * SUM(`hours`) / (SELECT SUM(`hours`) FROM input_data) ) AS lang_time
            FROM input_data 
            -- AS test_time
            INNER JOIN language_num
            ON
            input_data.languages = language_num.id
            WHERE `date` LIKE :search 
            GROUP BY `languages`;'
        );
        $test_prepare->execute(['search' => $search]);
        $hours_by_test = $test_prepare->fetchAll();
        */

        // $c4 = json_encode($hours_by_test);



        // ドーナツグラフ2  コンテンツ毎の勉強時間
        /*
            var data = google.visualization.arrayToDataTable([
                ["content", "portion"],
                ["N予備校", 40],
                ["ドットインストール", 20],
                ["課題", 40],
            ]);
            */

        /* GROUP BY 使って集計
        $cont_prepare = $pdo->prepare(
            'SELECT `contents` , (100.0 * SUM(`hours`) / (SELECT SUM(`hours`) FROM input_data) ) AS cont_time
            FROM input_data WHERE `date` LIKE :search 
            GROUP BY `contents`'
        );
        $cont_prepare->execute(['search' => $search]);
        $hours_by_cont = $cont_prepare->fetchAll();

        $c3 = json_encode($hours_by_cont);

        /* IDと学習言語名紐付け
        $test_prepare = $pdo->prepare(
            'SELECT content_num.content, (100.0 * SUM(`hours`) / (SELECT SUM(`hours`) FROM input_data) ) AS cont_time
            FROM input_data
            INNER JOIN content_num
            ON
            input_data.contents = content_num.id
            WHERE `date` LIKE :search 
            GROUP BY `contents`;'
        );
        $test_prepare->execute(['search' => $search]);
        $hours_by_test2 = $test_prepare->fetchAll();
        */

        // $c5 = json_encode($hours_by_test2);
        return view('user.home', compact('total_sum', 'month_sum', 'today_sum', 'c'));
    }

    public function post(Request $request)
    {
        $contents = $request->contents;
        $contents_length = count($contents);

        $langs = $request->langs;
        $langs_length = count($langs);

        $hours = $request->hours;
        $hours_per_content = $hours/$contents_length;
        $hours_per_lang = $hours/$langs_length;

        if($contents_length > 1){
            foreach($contents as $content){
                    $input = new InputData();
                    $input->date = $request->date;
                    foreach($langs as $lang){
                    $input->languages = $lang; 
                    }
                    $input->contents = intval($content);
                    $input->hours = $hours_per_content;
                    $input->save();
                    // ✅カラムメイ、input
                }
            } else if($langs_length > 1){
                foreach($langs as $lang){
                    $input = new InputData();
                    $input->date = $request->date;
                    foreach($contents as $content){
                        $input->contents = $content; 
                        }
                    $input->languages = intval($lang); 
                $input->hours = $hours_per_lang;   
                $input->save();
            }
        }

            // 現在の時刻からインスタンスを生成
            $current_year = Carbon::now()->format('Y');
            $current_month = Carbon::now()->format('m');
            $today = Carbon::now()->format('d');
    
            // トータル時間
            $total_sum = InputData::sum('hours');
    
            // 今月の合計時間
            $month_sum = InputData::whereYear('date', $current_year)->whereMonth('date', $current_month)->sum('hours');
    
            // 今日の合計時間
            $today_sum = InputData::whereYear('date', $current_year)->whereMonth('date', $current_month)->whereDay('date', $today)->sum('hours');

            // 棒グラフ  日毎の勉強時間をGroupByで集計
            $chart_day = InputData::whereYear('date', $current_year)->whereMonth('date', $current_month)
                ->selectRaw('sum(hours) as `h`, date')
                ->groupByRaw('date')
                ->get();
    
            $c = json_encode($chart_day);

        return view('user.home', compact('total_sum', 'month_sum', 'today_sum', 'c'));
    }
}
