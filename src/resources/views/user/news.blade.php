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

    <table>
        <tr>
            <th>画像</th>
            <th>タイトル</th>
            <th>紹介文</th>
        </tr>
        @foreach($data as $key => $value)
        @if(is_array($value))
        <tr onclick="location.href='/webapp/home/news/{{$value['id']}}'">
                <td><img src="{{$value['thumbnail_url']}}" class="thumbnail_img" alt=""></td>
                <td>{{$value['title']}}</td>
                <td>{{$value['text']}}</td>
            </a>
        </tr>
        @endif
        @endforeach
    </table>
</body>

</html>