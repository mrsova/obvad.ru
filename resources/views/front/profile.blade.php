@extends('front.layout')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="leave-comment mr0">
                        @if(session('statusProfile'))
                            <div class="alert alert-success">
                                {{session('statusProfile')}}
                            </div>
                        @endif
                        <h3 class="text-uppercase">Мой профиль</h3>
                        @include('admin.errors')
                        <br>
                        <form class="form-horizontal contact-form" role="form" method="post" action="/profile"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="exampleInputil1">Имя</label>
                                    <input type="text" class="form-control" id="exampleI1" name="name" placeholder="Имя"
                                           value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="exampleInputEm1">Логин</label>
                                    <input type="text" class="form-control" id="exampleInput1" name="login"
                                           value="{{$user->login}}" placeholder="Логин">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="exampleInpumail1">E-mail</label>
                                    <input type="text" class="form-control" id="exampleInputl1" name="email"
                                           placeholder="Email" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="exampleInputEml1">Пароль</label>
                                    <input type="password" class="form-control" id="exampleInputEm1" name="password"
                                           placeholder="Пароль">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="password" class="form-control" id="password2"
                                           name="password_confirmation" placeholder="Подтвердите пароль">
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">Обновить данные</button>
                            @if(!$user->uids)
                                <a class="btn send-btn" href="{{route('vklogin')}}">Привязать Vk</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection