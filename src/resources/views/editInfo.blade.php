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
    <section class="modal_first">
        <div class="study_contents inside modal_margin">
            <h1>アカウント情報</h1>
            <a href="{{ route('user_home') }}">戻る</a>
                <ul>
                    <form action="{{ route('user_change') }}" method="post" name="user_info">
                        @foreach($user_infos as $user)
                        @csrf
                        <li class="grey">名前</li>
                        <input type="text" value="{{$user->name}}" name="name">
                        <li class="grey">メールアドレス</li>
                        <input type="email" value="{{$user->email}}" name="email">
                        @endforeach
                        <button >更新</button>
                    </form>
                </ul>
                @csrf
        </div>
    </section>
</body>

</html>