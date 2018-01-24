@extends('front.layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(Auth::check() && Auth::user()->status)
                        <article class="post">
                            <div class="post-content">
                                <header class="entry-header text-left text-uppercase">
                                    <h1 class="entry-title"><a class="title_post">Предложить объявление</a></h1>
                                </header>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-10 errors_post">

                                        </div>
                                    </div>
                                </div>
                                <form action="/addpost" method="post" class="flex add_post_admin">
                                    {{ csrf_field() }}
                                    <div class="flex__text">
                                        <textarea class="subpost form-control" placeholder="Текст объявления" name="content"></textarea>
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
                    @else
                        <article class="post">
                            <div class="post-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-10 errors_post">
                                            <h4>Чтобы добавить объявление, необходимо <a href="/register">зарегистироваться</a>, или
                                                <a href="/login">войти</a>  через вк</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endif
                    @foreach($posts as $post)
                        <article class="post post_item_object" data-id="{{$post->id}}">
                            <div class="fotorama" data-nav="thumbs">
                                <a href=""><img src="#" alt=""></a>
                            </div>
                            <div class="post-content">
                                {{--<header class="entry-header text-left text-uppercase">--}}
                                    {{--<h1 class="entry-title">--}}
                                        {{--<a class="title_post">--}}
                                            {{--Доска объявлений--}}
                                        {{--</a>--}}
                                    {{--</h1>--}}
                                {{--</header>--}}
                                <div class="entry-content" id="entry-content">
                                    <div class="content-item">
                                        <div class="text-post">
                                            {!!$post->content!!}
                                        </div>
                                        <div class="image_block">
                                            <div class="row">
                                                @foreach($post->images as $key=>$image)
                                                    @if (count($post->images) == 1)
                                                        <div class="col-xs-12">
                                                            <!--data-fancybox="gallery"-->
                                                            <a class="fancyimg grouped_elements" data-fancybox="group{{$post->id}}" href="{{$image->getImage($post->id)}}">
                                                                <img src="{{$image->getImage($post->id)}}">
                                                            </a>
                                                        </div>
                                                    @else
                                                    <div class="col-xs-4">
                                                        <a class="fancyimg grouped_elements" data-fancybox="group{{$post->id}}" href="{{$image->getImage($post->id)}}">
                                                            <img src="{{$image->getImageSmall($post->id)}}">
                                                        </a>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-continue-reading text-center">
                                    <a href="" class="show_block">Развернуть</a>
                                </div>
                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">
                                        <span class="social-share-title pull-left text-capitalize">
                                            Автор: <a href="#">  {{$post->user->name}}</a></span><br/>
                                            @if($post->user->vk_url && !$post->user->is_admin)
                                                <a style="color:#00BFF3" href="{{$post->user->vk_url}}">Перейти на страницу в VK</a>
                                            @endif
                                            Время: {{$post->getDate()}}
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
    <script src="{{asset('js/fancybox.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/add_post.js')}}"></script>
@stop
@section('styles')
    <link rel="stylesheet" href="{{asset('css/fancybox.css')}}" />
@stop
