@extends('admin.layout')

@section('content')
    <style>
        /**
Добавление поста для фронтенда
 */
        .img-thumbnail {
            height: 75px;
            border: 1px solid #eee;
            margin: 10px 5px 0 0;
            position: relative;
            display: inline-block;
        }

        #outputMulti {
            display: block;
            margin: 0 auto;
        }

        #outputMulti a {
            position: relative;
            display: inline-block;
            cursor: pointer;
            margin-right: 17px;
        }

        #outputMulti a:after {
            content: "x";
            display: block;
            position: absolute;
            height: 25px;
            width: 26px;
            color: #000;
            background: #fff;
            top: 0px;
            right: -4px;
            border-radius: 18px 16px;
        }

        #dropZone {
            color: #555;
            font-size: 18px;
            text-align: center;
            /*margin-top: 30px;*/
            width: 100%;
            padding: 20px;
            min-height: 153px;

            background: #eee;
            border: 1px solid #ccc;

            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;

            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
        }

        .drag-and-drop {
            flex-basis: 100%;
        }

        #dropZone.hover {
            /* background: #ddd;
             border-color: #aaa;*/
            background: #afa;
            border-color: #0f0;
        }

        #dropZone.error {
            background: #faa;
            border-color: #f00;
        }

        #dropZone.drop {
            background: #afa;
            border-color: #0f0;
        }

        .subpost {
            /*margin-top: 30px;*/
            width: 100%; /* Ширина поля в процентах */
            height: 153px !important;
            resize: none; /* Запрещаем изменять размер */
        }

        .flex {
            margin: 30px 0;
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            min-height: 207px;
        }

        .flex__text {
            height: 153px;
            -ms-flex-preferred-size: calc(100% / 2 - 43px / 2);
            flex-basis: calc(100% / 2 - 43px / 2);
        }

        .flex__drop {
            -ms-flex-preferred-size: calc(100% / 2 - 43px / 2);
            flex-basis: calc(100% / 2 - 43px / 2);
        }

        .flex__btn {
            position: absolute;
            left: 0;
            top: 173px;
        }

        #entry-content {
            max-height: 434px;
            overflow: hidden;
            -webkit-transition: max-height 0.6s ease;
            -moz-transition: max-height 0.6s ease;
            -o-transition: max-height 0.6s ease;
            transition: max-height 0.6s ease;
            margin-bottom: 5px;
        }

        .show_content {
            max-height: 100000px !important;
        }

        .show_block {
            margin: 20px 0;
            display: none;
        }

        .title_post {
            font-size: 15px !important;
        }

        .text-post {
            margin: 15px 0px 15px 0px;
        }

        .image_block {
            display: inline;
            text-align: center;
        }

        @media (max-width: 1024px) {
            .flex {
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-box-pack: start;
                -ms-flex-pack: start;
                justify-content: flex-start;
            }

            .flex__text {
                margin-bottom: 20px;
            }

            .flex__drop {
                margin-bottom: 20px;
            }

            .flex__btn {
                position: initial;
                left: initial;
                top: initial;
            }

        }
    </style>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редактировать объявление
                <small>Вы можете отредактировать объявление</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open([
            'route'	=>	['posts.update', $post->id],
            'files'	=>	true,
            'method'	=>	'put',
            'class'=>'form_admin'
        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Редактировать объявление</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Объявление</label>
                        <textarea name="content" id="" cols="30" rows="10"
                                  class="form-control">{{$post->content}}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="flex__drop">
                            <div id="dropZone">
                                <div class="drag-and-drop">
                                    <div class="upload-icon">
                                        Перетащите изображения или кликните для выбора
                                    </div>
                                </div>

                                <span id="outputMulti">
                                     @foreach($post->images as $key=>$image)
                                        <a href="javascript:void(0)" onclick="removeImage($(this))">
                                        <img data-id="{{$image->id}}" src="{{$image->getImage($post->id)}}" class="img-thumbnail" width="100" height="100">
                                        </a>
                                    @endforeach
                                </span>
                            </div>
                            <input type="file" style="display:none;" id="fileMulti" name="fileMulti[]"
                                   multiple/>
                            <input type="hidden" name="removeImg" value=""/>
                        </div>
                    </div>
                    <!-- checkbox -->
                    <div class="form-group">
                        <label>
                            {{Form::checkbox('status','1', $post->status, ['class'=>'minimal'])}}
                        </label>
                        <label>
                            Опубликовано
                        </label>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button id="upload" data-id="{{$post->id}}" class="btn btn-warning pull-right">Изменить</button>
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
@section('scripts')
    <script type="text/javascript" src="{{asset('js/crud-post-admin.js')}}"></script>
@stop