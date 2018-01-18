@extends('front.layout')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="leave-comment mr0">
                        <h3>Восстановить</h3>
                        @include('admin.errors')
                        <br>
                        @if(!isset($user))
                        <form class="form-horizontal contact-form" role="form" method="post" action="/resetpass">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="login" name="email" value="{{old('email')}}" placeholder="Email">
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">Восстановить пароль</button>
                        </form>
                        @else
                            <form class="form-horizontal contact-form" role="form" method="post" action="/resetpass/{{$user->reset_token_pass}}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$user->id}}" name="user_id">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Новый Пароль">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" id="password2" name="password_confirmation" placeholder="Подтвердите пароль">
                                    </div>
                                </div>
                                <button type="submit" class="btn send-btn">Восстановить пароль</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection