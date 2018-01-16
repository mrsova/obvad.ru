<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    {{Form::open([
            'route'	=> 'posts.store',
            'files'	=>	true
    ])}}
    <input type="file" id="exampleInputFile" name="image">
    <button class="btn btn-success pull-right">Добавить</button>
    {{Form::close()}}
    <hr>
    @foreach($posts as $post)
        @foreach($post->images as $image)
            Картинка {{$image->id}} - {{$image->url}} <br/>
        @endforeach
        <hr>
        {{Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'delete'])}}
        <button onclick="return confirm('are you sure?')" type="submit" class="delete">
            Удалить
        </button>
        {{Form::close()}}
    @endforeach
</body>
</html>
