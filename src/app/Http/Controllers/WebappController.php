<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InputData;
use App\Models\Content;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facade;
use Illuminate\Support\Facades\Auth;
// Carbon
// require_once __DIR__ . '/vendor/autoload.php';
use Carbon\Carbon;


class WebappController extends Controller
{

    public function user_edit(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        dd($user);
        return view('user.edit_info', compact('user'));
    }

    public function index(Request $request)
    {
        $id = Auth::id();
        $user_name = Auth::user()->name;

        // 現在の時刻からインスタンスを生成
        $current_year = Carbon::now()->format('Y');
        $current_month = Carbon::now()->format('m');
        $today = Carbon::now()->format('d');

        // トータル時間
        $total_sum = InputData::where('user', $id)->sum('hours');

        // 今月の合計時間
        $month_sum = InputData::where('user', $id)->whereYear('date', $current_year)->whereMonth('date', $current_month)->sum('hours');

        // 今日の合計時間
        $today_sum = InputData::where('user', $id)->whereYear('date', $current_year)->whereMonth('date', $current_month)->whereDay('date', $today)->sum('hours');

        // 棒グラフ  日毎の勉強時間をGroupByで集計
        $chart_day = InputData::where('user', $id)->whereYear('date', $current_year)->whereMonth('date', $current_month)
        ->selectRaw('sum(hours) as `h`, date')
        ->groupByRaw('date')
        ->get();
        $c = json_encode($chart_day);

        // ドーナツグラフ1  言語毎の勉強時間
        // 疑問：join句以外のやり方
        $chart_languages = InputData::join('languages', 'languages.id', '=', 'input_data.language_id')
        ->whereYear('date', $current_year)->whereMonth('date', $current_month)
        ->selectRaw('languages.name, sum(hours) AS lang_time')
        ->groupByRaw('languages.name')
        ->get();
        
        foreach($chart_languages as $chart_language){
            $chart_language['lang_time'] = 100 * $chart_language['lang_time']/$total_sum;
        }
        $c2 = json_encode($chart_languages);



        // ドーナツグラフ2  コンテンツ毎の勉強時間
        $chart_contents = InputData::join('contents', 'contents.id', '=', 'input_data.content_id')
            ->whereYear('date', $current_year)->whereMonth('date', $current_month)
            ->selectRaw('contents.name, SUM(hours) AS cont_time')
            ->groupByRaw('contents.name')
            ->get();
        $c3 = json_encode($chart_contents);

        // コンテンツ名
        $contents = Content::where('is_modal', '1')->get();
        // 言語名
        $languages = Language::where('is_modal', '1')->get();
        return view('user.home', compact('total_sum', 'month_sum', 'today_sum', 'c', 'c2', 'c3', 'user_name','contents', 'languages'));
    }

    public function post(Request $request)
    {
        $id = Auth::id();
        $user_name = Auth::user()->name;
        $contents = $request->contents;
        $contents_length = count($contents);

        $langs = $request->langs;
        $langs_length = count($langs);

        $hours = $request->hours;
        $hours_per_content = $hours / $contents_length;
        $hours_per_lang = $hours / $langs_length;

        if ($contents_length > 1) {
            foreach ($contents as $content) {
                $input = new InputData();
                $input->date = $request->date;
                $input->user = $id;
                foreach ($langs as $lang) {
                    $input->language_id = $lang;
                }
                $input->content_id = intval($content);
                $input->hours = $hours_per_content;
                $input->save();
                // ✅カラムメイ、input
            }
        } else if ($langs_length > 1) {
            foreach ($langs as $lang) {
                $input = new InputData();
                $input->date = $request->date;
                $input->user = $id;
                foreach ($contents as $content) {
                    $input->content_id = $content;
                }
                $input->language_id = intval($lang);
                $input->hours = $hours_per_lang;
                $input->save();
            }
        }else{
            $input = new InputData();
            $input->date = $request->date;
            $input->user = $id;
            foreach ($contents as $content) {
                $input->content_id = $content;
            }
            foreach ($langs as $lang) {
                $input->language_id = $lang;
            }
            $input->hours = $hours;
            $input->save();
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
            ->selectRaw('sum(hours) as `h`, date')->groupByRaw('date')->get();
        $c = json_encode($chart_day);

        // ドーナツグラフ1  言語毎の勉強時間
        $chart_languages = InputData::join('languages', 'languages.id', '=', 'input_data.language_id')
        ->whereYear('date', $current_year)->whereMonth('date', $current_month)
        ->selectRaw('languages.name, sum(hours) AS lang_time')
        ->groupByRaw('languages.name')
        ->get();
        
        foreach($chart_languages as $chart_language){
            $chart_language['lang_time'] = 100 * $chart_language['lang_time']/$total_sum;
        }

        $c2 = json_encode($chart_languages);

        // ドーナツグラフ2  コンテンツ毎の勉強時間
        $chart_contents = InputData::join('contents', 'contents.id', '=', 'input_data.content_id')
            ->whereYear('date', $current_year)->whereMonth('date', $current_month)
            ->selectRaw('contents.name, SUM(hours) AS cont_time')
            ->groupByRaw('contents.name')
            ->get();
        $c3 = json_encode($chart_contents);
        // コンテンツ名
        $contents = Content::where('is_modal', '1')->get();
        // 言語名
        $languages = Language::where('is_modal', '1')->get();
        return view('user.home', compact('total_sum', 'month_sum', 'today_sum', 'c', 'c2', 'c3', 'user_name','contents', 'languages'));
    }
}
