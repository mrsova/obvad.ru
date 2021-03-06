@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Пользователи
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{route('users.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Uids</th>
                  <th>Имя</th>
                  <th>Логин</th>
                  <th>Vk</th>
                  <th>Email</th>
                  <th>Роль</th>
                  <th>Cтатус</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->uids}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->login}}</td>
                    <td><a href="{{$user->vk_url}}">{{$user->vk_url}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>
                      @if($user->is_admin)
                        Администратор
                      @else
                        Пользователь
                      @endif
                    </td>
                    <td>
                      @if($user->status)
                        Активен
                      @else
                        Не актвен
                      @endif
                    </td>
                    <td>
                      <a href="{{route('users.edit', $user->id)}}" class="fa fa-pencil"></a>
                      {{Form::open(['route'=>['users.destroy', $user->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('Вы действительно хотите удалить?')" type="submit" class="delete">
                        <i class="fa fa-remove"></i>
                      </button>
                      {{Form::close()}}
                    </td>
                  </tr>
                @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection