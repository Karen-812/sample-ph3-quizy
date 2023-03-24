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
            <p>ユーザー一覧</p>
            <table class="grey">
                <tr>
                    <th>管理者</th>
                    <th>一般</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th></th>
                </tr>
                @foreach($users as $user)
                <form action="{{ route('admin.user_change') }}" method="post" name="user{{$user->id}}">
                @csrf
                <tr>
                    <td>
                        <input type="radio" name="is_admin_{{$user->id}}" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="radio" name="is_admin_{{$user->id}}" value="0" {{ $user->is_admin ? '' : 'checked' }}>
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
                </form>
                @endforeach

                <form action="{{ route('admin.user_add') }}" method="post" name="user{{$user->id}}">
                @csrf
                <tr>
                    <td>
                        <input type="radio" name="is_admin_new" value="1">
                    </td>
                    <td>
                        <input type="radio" name="is_admin_new" value="0" checked>
                    </td>
                    <td>
                        <input type="text" name="user_name" value="<<新規追加>>" checked>
                    </td>
                    <td>
                    <input type="email" name="user_email" value="メールアドレス"  > 
                    </td>
                    <td>
                        <button >追加</button>
                    </td>
                </tr>
                </form>

            </table>

        </div>
        </div>
    </section>
</body>

</html>