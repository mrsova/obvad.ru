@extends('front.layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="leave-comment mr0">
                        <h3>Регистрация</h3>
                        @include('admin.errors')
                        <br>
                        <form class="form-horizontal contact-form" role="form" method="post" action="/register">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Имя">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="login" name="login" value="{{old('login')}}" placeholder="Логин">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" id="password2" name="password_confirmation" placeholder="Подтвердите пароль">
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn send-btn">Регистрация</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection