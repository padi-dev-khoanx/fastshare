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
        .progress {
            position:relative;
            width:100%;
            height: 20px;
        }
        .bar {
            background-color: #498C25;
            width:0%;
            height:20px;
        }
        .percent {
            position:absolute;
            display:inline-block;
            margin: auto;
            text-align: center;
            color: #fff;
            z-index: 99;
            width: 100%;
            height: 20px;
        }
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

<script type="text/javascript">
    var droppedFiles = false;
    var fileName = '';
    var $dropzone = $('.dropzone');
    var $button = $('.upload-btn');
    var uploading = false;
    var $syncing = $('.syncing');
    var $done = $('.done');
    var $bar = $('.bar');
    var timeOut;

    $dropzone.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
    })
        .on('dragover dragenter', function() {
        $dropzone.addClass('is-dragover');
    })
        .on('dragleave dragend drop', function() {
        $dropzone.removeClass('is-dragover');
    })
        .on('drop', function(e) {
        droppedFiles = e.originalEvent.dataTransfer.files;
        fileName = droppedFiles[0]['name'];
        $('.filename').html(fileName);
        $('.dropzone .upload').hide();
    });

    $button.bind('click', function() {
        startUpload();
    });

    $("input:file").change(function (){
        fileName = $(this)[0].files[0].name;
        $('.filename').html(fileName);
        $('.dropzone .upload').hide();
    });

    function startUpload() {
        if (!uploading && fileName != '' ) {
            uploading = true;
            $button.html('Đang tải lên...');
            $dropzone.fadeOut();
            $syncing.addClass('active');
            $done.addClass('active');
            $bar.addClass('active');
            // timeoutID = window.setTimeout(showDone, 3200);
        }
    }

    // function showDone() {
    //     $button.html('Xong');
    // }

    var SITEURL = window.location.href;
    $(function() {
        $(document).ready(function()
        {
            var bar = $('.bar');
            var percent = $('.percent');
            $('form').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                complete: function(xhr) {
                    // alert('Link download: ' + SITEURL + 'upload/' + fileName);
                    // window.location.href = SITEURL;
                    $button.html('Xong');
                    value = 'ahihi'
                    $temp.val(value).select();
                    document.execCommand("copy");
                }
            });
        });
    });
</script>

</body>
</html>
