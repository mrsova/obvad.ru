$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ArrImg = [];
    var isArray;

    var dropZone = $('#dropZone');

    if (typeof(window.FileReader) == 'undefined') {
        dropZone.text('Не поддерживается браузером!');
        dropZone.addClass('error');
    }


    dropZone[0].ondragover = function () {
        dropZone.addClass('hover');
        return false;
    };

    dropZone[0].ondragleave = function () {
        dropZone.removeClass('hover');
        return false;
    };

    dropZone[0].ondrop = function (event) {
        event.preventDefault();
        dropZone.removeClass('hover');
        files = event.dataTransfer.files;
        dragFiles(ArrImg, files);
    };

    $('#fileMulti').change(function () {
        var files = $(this).prop('files');
        dragFiles(ArrImg, files);
    });

    $('#upload').on('click', function (e) {
        e.preventDefault();
        var content = $('form textarea').val();
        var form_data = new FormData();

        for (key in ArrImg) {
            form_data.append('file-' + key, ArrImg[key]);
        }
        form_data.append('content', content);
        $.ajax({
            url: '/addpost',
            cache: false,
            dataType: 'text',
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            success: function (data) {
                console.log(data);
            }
        });
    });


    dropZone.on('click', function () {
        $(this).next().click();
    });

    function dragFiles(ArrImg, files) {
        for (var i = 0, f; f = files[i]; i++) {
            isArray = 1;
            var reader = new FileReader();

            if (!f.type.match('image.*')) {
                alert('Только изображения');
                return false;
            }
            for (key in ArrImg) {
                if (ArrImg[key].name == f.name) {
                    isArray = 0;
                }
            }
            if (isArray) {
                ArrImg.push(f);
                reader.onload = (function (theFile) {
                    return function (e) {
                        // Render thumbnail.
                        var span = document.createElement('span');
                        span.innerHTML = ['<img class="img-thumbnail" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                        document.getElementById('outputMulti').insertBefore(span, null);
                    };
                })(f);
                reader.readAsDataURL(f)
            }
        }
    }

    $('.show_block').on('click', function (event) {
        event.preventDefault();
        var blockId = $(this).parent().prev();
        if(!blockId.hasClass('show_content')){
            blockId.addClass('show_content');
            $(this).text('Свернуть');
        }else{
            blockId.removeClass('show_content');
            $(this).text('Развернуть');
        }
    });

    $('.content-item').each(function(i,elem){

        if ($(this).height() > 300){
            console.log(1);
            console.log($(elem).parent().next().find('.show_block').css('display','inline-block'));
        }
    });
});