@extends('layout.default')
@section('title','添加商家分类')
@section('content')
    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">商家分类名：</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
        </div>
        <input type="hidden" name="logo" id="logo">
        <img id="img" src="" style="height: 50px" width="50px">


        <button type="submit" class="btn btn-primary">添加</button>
    </form>
    @stop
@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>

    <script>
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf: '/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/upload',
            formData:{_token:"{{ csrf_token() }}" },

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        //监听文件上传
        uploader.on( 'uploadSuccess', function( file,response ) {
//            $( '#'+file.id ).addClass('upload-state-done');
            var url = response.url;
            $("#img").attr('src',url);
            $("#logo").val(response.pic)
        });
    </script>

@stop