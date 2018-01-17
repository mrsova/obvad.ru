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
                        <form class="form-horizontal contact-form" role="form" method="post" action="/resetpass">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="login" name="email" value="{{old('email')}}" placeholder="Email">
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">Восстановить пароль</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection