@extends('front.layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="leave-comment mr0"><!--leave comment-->
                        <h3>Войти</h3>
                        @include('admin.errors')
                        @if(session('statusLogin'))
                            <div class="alert-danger alert">
                                {{session('statusLogin')}}
                            </div>
                        @endif
                        <br>
                        <form class="form-horizontal contact-form" role="form" method="post" action="/login">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="login" name="login" value="{{old('login')}}" placeholder="Логин">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">Вход</button>
                            <a class="btn send-btn" href="{{route('vklogin')}}">Войти через VK</a>
                        </form>
                    </div><!--end leave comment-->

                </div>
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection