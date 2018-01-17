@extends('admin.layout')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавить пользователя
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	{{Form::open([
		'route'	=>	['users.update', $user->id],
		'method'	=>	'put',
		'files'	=>	true
	])}}
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Добавляем пользователя</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputil1">Имя</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="" value="{{$user->name}}">
            </div>
            <div class="form-group">
              <label for="exampleInputEm1">Логин</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="login" value="{{$user->login}}" placeholder="">
            </div>
            <div class="form-group">
              <label for="exampleInpail1">Vk</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="vk_url" value="{{$user->vk_url}}" placeholder="">
            </div>
            <div class="form-group">
              <label for="exampleInpumail1">E-mail</label>
              <input type="text" class="form-control" id="exampleInputEmail1" name="email" placeholder="" value="{{$user->email}}">
            </div>
            <div class="form-group">
              <label for="exampleInputEml1">Пароль</label>
              <input type="password" class="form-control" id="exampleInputEmail1" name="password" placeholder="">
            </div>
            <div class="form-group">
              <label>
                {{Form::checkbox('status', '1', $user->status, ['class'=>'minimal'])}}
              </label>
              <label>
                Активен
              </label>
            </div>
            <div class="form-group">
              <label>
                {{Form::checkbox('is_admin', '1', $user->is_admin, ['class'=>'minimal'])}}
              </label>
              <label>
                Администратор
              </label>
            </div>

        </div>
      </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-warning pull-right">Изменить</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
	{{Form::close()}}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection