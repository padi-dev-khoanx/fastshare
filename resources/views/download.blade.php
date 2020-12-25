<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Fast Share - Chia sẻ nhanh của Khoa</title>
    <link rel="stylesheet" href="{{asset('/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
</head>
<body>
<div class="frame">
    <div class="center">
        <div class="upload-content">
            @if ($isExists)
            <div id="exists">
                <div class="title">Tải xuống file được chia sẻ</div>
                <form action="{{ url('download') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="dropzone">
                        <div class="content">
                            <span class="filename" name="fileName">{{$file->name}}</span>
                            <input name="filePath" value="{{$file->path}}" hidden>
                            <input name="fileName" value="{{$file->name}}" hidden>
                        </div>
                    </div>
                    <label class="upload-btn" for="submit">
                        Tải xuống
                    </label>
                    <input type="submit" id="submit" hidden>
                </form>
            </div>
            @else
                <h3 class="not_exist">Tập tin không tồn tại</h3>
            @endif
            <h3 class="not_exist_js">Tập tin không tồn tại</h3>
        </div>
    </div>
</div>
<script>

$("#submit").click(function (){
        $('#exists').fadeOut();
        $('.not_exist_js').fadeIn(1500);
});
</script>
</body>
</html>
