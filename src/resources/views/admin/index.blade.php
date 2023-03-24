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
            <p>学習コンテンツ</p>
            <table class="grey">
                <tr>
                    <th>表示</th>
                    <th>非表示</th>
                    <th>名前</th>
                    <th></th>
                </tr>
                @foreach($contents as $content)
                <form action="{{ route('admin.content_change') }}" method="post" name="content{{$content->id}}">
                @csrf
                <input type="hidden" name="content_id" value="{{$content->id}}">
                <tr >
                    <td>
                        <input type="radio" name="content_display" value="1" {{ $content->is_modal ? 'checked' : '' }} >
                    </td>
                    <td>
                        <input type="radio" name="content_display" value="0"  {{ $content->is_modal ? '' : 'checked' }}>
                    </td>
                    <td>
                    <input type="text" name="content_name" value="{{$content->name}}"  > 
                    </td>
                    <td>
                        <button >更新</button>
                    </td>
                </tr>
                </form>
                @endforeach
                <form action="{{ route('admin.content_add') }}" method="post">
                    @csrf
                <tr >
                    <td>
                        <input type="radio" name="content_display" value="1" checked>
                    </td>
                    <td>
                        <input type="radio" name="content_display" value="0" >
                    </td>
                    <td>
                    <input type="text" name="content_name" value="<<新規作成>>"> 
                    </td>
                    <td>
                        <button >更新</button>
                    </td>
                </tr>
                </form>
            </table>
        </div>
        <div class="study_languages inside modal_margin">
            <p>学習言語</p>
            <table class="grey">
                <tr>
                    <th>表示</th>
                    <th>非表示</th>
                    <th>名前</th>
                    <th></th>
                </tr>
                @foreach($languages as $language)
                <form action="{{ route('admin.language_change') }}" method="post" name="language{{$language->id}}">
                @csrf
                <input type="hidden" name="language_id" value="{{$language->id}}">
                <tr >
                    <td>
                        <input type="radio" name="language_display" value="1" {{ $language->is_modal ? 'checked' : '' }} >
                    </td>
                    <td>
                        <input type="radio" name="language_display" value="0"  {{ $language->is_modal ? '' : 'checked' }}>
                    </td>
                    <td>
                    <input type="text" name="language_name" value="{{$language->name}}"  > 
                    </td>
                    <td>
                        <button >更新</button>
                    </td>
                </tr>
                </form>
                @endforeach
                <form action="{{ route('admin.language_add') }}" method="post">
                @csrf
                <tr >
                    <td>
                        <input type="radio" name="language_display" value="1" checked>
                    </td>
                    <td>
                        <input type="radio" name="language_display" value="0" >
                    </td>
                    <td>
                    <input type="text" name="language_name" value="<<新規作成>>"> 
                    </td>
                    <td>
                        <button >更新</button>
                    </td>
                </tr>
                </form>
            </table>
        </div>
    </section>
</body>

</html>