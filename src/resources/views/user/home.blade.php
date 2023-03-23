@extends('layouts.home')

@section('title', "WEBAPP")

@section('week', "4")
@section('Today', $today_sum)
@section('Month', $month_sum)
@section('Total', $total_sum)


<!-------------- ここからPhase2 -------------->

<!--Load the Ajax API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>