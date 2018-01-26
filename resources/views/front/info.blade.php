@extends('front.layout')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="leave-comment mr0">
                        <h3>Полезная информация</h3><br/>
                        @include('admin.errors')
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <h4 class="list-group-item-heading">Правила</h4><br/>
                                <p class="list-group-item-text">
                                    Объявление на сайт может добавить любой зарегестрированный и авторизированный пользователь<br/>
                                </p><br/>
                                <p class="list-group-item-text">
                                    Пользователь может зарегистрироваться и привязать свой vk<br/>
                                </p><br/>
                                <p class="list-group-item-text">
                                    Если пользователь сделает вход через vk, то регистрация будет произведена автоматически<br/>
                                </p><br/>
								  <p class="list-group-item-text">
                                    Если пользователь привязывает к сайту страницу вк, то ссылка на его страницу отображается в объявлении<br/>
                                </p><br/>
                                <p class="list-group-item-text">
                                    В своем профиле можно заполнить пароль и логин, а так же указать свою электронную почту<br/>
                                </p><br/>
                                <p class="list-group-item-text">
                                    Количество добавляемых картинок ограничено количеством - 3.<br/>
                                </p><br/>
                                <p class="list-group-item-text">
                                    Администрация не передает информацию третьим лицам!!!<br/>
                                </p><br/>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection