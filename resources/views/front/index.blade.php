@extends('front.layout')

@section('content')
    <style>

        html, body {
            height: 100%;
            min-width: 320px;
        }


        .img-thumbnail {
            height: 75px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
        }

        #dropZone {
            color: #555;
            font-size: 18px;
            text-align: center;
            /*margin-top: 30px;*/
            width: 100%;
            padding: 20px;
            min-height: 153px;

            background: #eee;
            border: 1px solid #ccc;

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;

            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
        }

        .drag-and-drop {
            flex-basis: 100%;
        }

        #dropZone.hover {
            /* background: #ddd;
             border-color: #aaa;*/
            background: #afa;
            border-color: #0f0;
        }

        #dropZone.error {
            background: #faa;
            border-color: #f00;
        }

        #dropZone.drop {
            background: #afa;
            border-color: #0f0;
        }

        .subpost {
            /*margin-top: 30px;*/
            width: 100%; /* Ширина поля в процентах */
            height: 153px !important;
            resize: none; /* Запрещаем изменять размер */
        }

        .flex {
            margin: 30px 0;
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            min-height: 207px;
        }

        .flex__text {
            height: 153px;
            -ms-flex-preferred-size: calc(100% / 2 - 43px / 2);
            flex-basis: calc(100% / 2 - 43px / 2);
        }

        .flex__drop {
            -ms-flex-preferred-size: calc(100% / 2 - 43px / 2);
            flex-basis: calc(100% / 2 - 43px / 2);
        }

        .flex__btn {
            position: absolute;
            left: 0;
            top: 173px;
        }
        .show_content{
            max-height:  700px !important;
        }
        #entry-content{
            max-height: 300px;
            overflow: hidden;
            -webkit-transition: max-height 1s ease;
            -moz-transition: max-height 1s ease;
            -o-transition: max-height 1s ease;
            transition: max-height 1s ease;
        }
        .show_block{
            margin: 20px 0;
            display:none;
        }

        @media (max-width: 1024px) {
            .flex {
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-box-pack: start;
                -ms-flex-pack: start;
                justify-content: flex-start;
            }

            .flex__text {
                margin-bottom: 20px;
            }

            .flex__drop {
                margin-bottom: 20px;
            }

            .flex__btn {
                position: initial;
                left: initial;
                top: initial;
            }
        }
    </style>
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(Auth::check())
                        <article class="post">
                            <div class="post-content">
                                <header class="entry-header text-left text-uppercase">
                                    <h1 class="entry-title"><a>Предложить объявление</a></h1>
                                </header>
                                <form action="" method="post" class="flex">
                                    <div class="flex__text">
                                        <textarea class="subpost form-control" name="text"></textarea>
                                    </div>
                                    <div class="flex__drop">
                                        <div id="dropZone">
                                            <div class="drag-and-drop">
                                                <div class="upload-icon">
                                                    Перетащите изображения или кликните для выбора
                                                </div>
                                            </div>

                                            <span id="outputMulti">
                                            </span>
                                        </div>
                                        <input type="file" style="display:none;" id="fileMulti" name="fileMulti[]"
                                               multiple/>
                                    </div>
                                    <div class="flex__btn">
                                        <a href="#" class="more-link" id="upload">Отправить</a>
                                    </div>
                                </form>
                            </div>
                        </article>
                    @endif
                    @foreach($posts as $post)
                        <article class="post">
                            <div class="post-thumb">
                                <a href=""><img src="#" alt=""></a>
                            </div>
                            <div class="post-content">
                                <header class="entry-header text-left text-uppercase">
                                    <h1 class="entry-title"><a>{{$post->title}}</a></h1>
                                </header>
                                <div class="entry-content" id="entry-content">
                                    <div class="content-item">
                                        {!!$post->content!!}
                                    </div>
                                </div>
                                <div class="btn-continue-reading text-center">
                                    <a href="" class="show_block">Развернуть</a>
                                </div>
                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">
                                        Автор: {{$post->user->name}} <br/>
                                        @if($post->user->vk_url)
                                            <a style="color:#00BFF3" href="{{$post->user->vk_url}}">Перейти на страницу в VK</a>
                                        @endif
                                    </span>
                                    <ul class="text-center pull-right">
                                        <li><i class="glyphicon glyphicon-eye-open"></i> {{$post->views}}</li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    {{$posts->links()}}
                    {{--<ul class="pagination">--}}
                    {{--<li class="active"><a href="#">1</a></li>--}}
                    {{--<li><a href="#">2</a></li>--}}
                    {{--<li><a href="#">3</a></li>--}}
                    {{--<li><a href="#">4</a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>--}}
                    {{--</ul>--}}
                    {{----}}
                    {{--команда для вида пагинации--}}
                    {{--php artisan vendor:publish --tag=laravel-pagination--}}
                    {{----}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/add_post.js')}}"></script>
 @stop