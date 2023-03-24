<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- font awesome, calender -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- stylesheet -->
    <link href="https://unpkg.com/sanitize.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('./style.css')}}">
</head>

<body>

    @foreach($data as $key => $value)
    @if(is_array($value))
    <tr>
        <img src="{{$value['thumbnail_url']}}" class="top_img" alt=""></td>
        <h1>
            {{$value['title']}}
        </h1>
        <p>
            {{$value['text']}}
        </p>
        <h2>
            筆者のプロフィール
        </h2>
        <img src="{{$value['author']['picture_url']}}" class="author_img" alt="">
        {{$value['author']['name']}}
    </tr>
    @endif
    @endforeach

</body>

</html>