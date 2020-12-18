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
    <style>
        .progress { position:relative; width:100%; }
        .bar { background-color: #00ff00; width:0%; height:20px; }
        .percent { position:absolute; display:inline-block; left:50%; color: #040608;}
   </style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="frame">
    <form action="{{ url('upload_file') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="center">
        <div class="bar"></div>
        <div class="title">Kéo thả file vào đây để tải lên</div>
        <div class="dropzone">
            <div class="content">
                <img src="{{asset('/img/upload.svg')}}" class="upload">
                <span class="filename"></span>
                <input type="file" class="input" name="file_share" required>
            </div>
        </div>
        <img src="{{asset('/img/syncing.svg')}}" class="syncing">
        <img src="{{asset('/img/checkmark.svg')}}" class="done">
        <div class="progress">
            <div class="bar"></div >
            <div class="percent">0%</div >
        </div>
        <button class="upload-btn" type="submit">Tải lên</button>
    </div>
    </form>
</div>
<!-- partial -->
<script src="{{asset('/js/script.js')}}">
<script type="text/javascript">

</script>
</body>
</html>
