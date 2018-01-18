@extends('front.layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($posts as $post)
                        <article class="post">
                            <div class="post-thumb">
                                <a href=""><img src="#" alt=""></a>
                            </div>
                            <div class="post-content">
                                <header class="entry-header text-left text-uppercase">
                                    <h1 class="entry-title"><a href="">{{$post->title}}</a></h1>
                                </header>
                                <div class="entry-content">
                                    <p>
                                        {!!$post->content!!}
                                    </p>

                                    <div class="btn-continue-reading text-center text-uppercase">
                                        <a href="" class="more-link">Показать подробнее</a>
                                    </div>
                                </div>
                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">
                                        Автор: {{$post->user->name}} <br/>
                                        @if($post->user->vk_url)
                                            <a style="color:#00BFF3" href="{{$post->user->vk_url}}">Перейти на страницу в VK</a>
                                        @endif
                                    </span>
                                    <ul class="text-center pull-right">
                                        <li><a class="s-facebook"><i class="glyphicon glyphicon-eye-open"></i> </a> {{$post->views}}</li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    {{--{{$posts->links()}}--}}
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