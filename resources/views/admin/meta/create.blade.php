@extends('admin.layout')

@section('content')  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавить статью
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	{{Form::open([
		'route'	=> 'meta.store',
	])}}
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Добавляем Метатеги</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <textarea name="title" id="" cols="30" rows="10"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Keywords</label>
            <textarea name="keywords" id="" cols="30" rows="10"></textarea>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-default">Назад</button>
          <button class="btn btn-success pull-right">Добавить</button>
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