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
            <form action="{{ url('upload_file') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="title">Kéo thả file vào đây để tải lên</div>
                <div class="sub-title">Tải lên file lên tới 100MB</div>
                <div class="progress">
                    <div class="bar"></div >
                    <div class="percent">0%</div >
                </div>
                <div class="dropzone">
                    <div class="content">
                        <img src="{{asset('/img/upload.svg')}}" class="upload">
                        <span class="filename"></span>
                        <input type="file" class="input" name="file_share" required>
                    </div>
                </div>
                <img src="{{asset('/img/syncing.svg')}}" class="syncing">
                <img src="{{asset('/img/checkmark.svg')}}" class="done">
                <label class="upload-btn" for="submit">
                    Tải lên
                </label>
                <input type="submit" id="submit" hidden>
            </form>
        </div>
        <div class="show-link">
            <div class="title">Đường dẫn chia sẻ</div>
            <div class="link-copy">
                <input type="text" class="link-input" id="link-input">
                <div id="link-value"></div>
                <div class="copy-btn" onclick="copyToClipboard('#link-value')">
                    <span id="copy-text"> Sao chép liên kết</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var droppedFiles = false;
    var fileName = '';
    var $dropzone = $('.dropzone');
    var $button = $('.upload-btn');
    var uploading = false;
    var $syncing = $('.syncing');
    var $done = $('.done');
    var SITEURL = window.location.href;
    var bar = $('.bar');
    var percent = $('.percent');
    var $upload_content = $('.upload-content');
    var $show_link = $('.show-link')
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
        }
    }

    $(function() {
        $(document).ready(function()
        {
            $('form').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    window.onbeforeunload = function ()
                    {
                        return "";
                    };
                    var percentVal = percentComplete + '%';
                    uploading = true;
                    bar.width(percentVal)
                    percent.html(percentVal);
                    $button.html('Đang tải lên...');
                    $syncing.addClass('active');
                    $dropzone.fadeOut();
                },
                complete: function(xhr) {
                    // alert('Link download: ' + SITEURL + 'upload/' + fileName);
                    // window.location.href = SITEURL;
                    window.onbeforeunload = function () {}
                    $button.html('Xong');
                    $syncing.removeClass('active');
                    $done.addClass('active');
                    setTimeout(function(){
                        $upload_content.fadeOut();
                        $show_link.fadeIn(1500);
                    }, 2000);
                    $('.link-input').val(SITEURL + 'upload/' + fileName);
                    $('#link-value').html(SITEURL + 'upload/' + fileName);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    });

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        $("#copy-text").text("Đã sao chép liên kết");
    }
</script>

</body>
</html>
