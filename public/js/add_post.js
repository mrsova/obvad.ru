(function() {
    init();
    $(window).resize(function() {
        init();
    });
    function init(){
        $('.show_block').on('click', function (event) {
            event.preventDefault();
            var blockId = $(this).parent().prev();
            var blockIdNext = $(this).parent().prev().parent().prev().parent();
            if(!blockId.hasClass('show_content')){
                blockId.addClass('show_content');
                $(this).text('Свернуть');

            }else{
                blockId.removeClass('show_content');
                $(this).text('Развернуть');
                $('html, body').animate({ scrollTop: $(blockIdNext).offset().top}, 600);
            }
        });

        $('.content-item').each(function(i,elem){
            if ($(this).height() > 300){
                $(elem).parent().next().find('.show_block').css('display','inline-block');
            }
        });

    }
    //Добавление просмотров к посту
    $('.post_item_object').on('click', function (event) {
        var id = $(this).data('id');
        $.ajax({
            url: '/setviews',
            dataType : 'json',
            data: {id: id},
            type: 'POST',
            success: function (data) {
                //var result = JSON.parse(data);
            }
        });
    });

    if($(".add_post_admin").html()) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var ArrImg = [];
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
            if(ArrImg.length > 2 || files.length > 3){
                alert("Количество загружаемых изображений должно быть не больше трех");
                return false;
            }
            dragFiles(ArrImg, files);
        };

        $('#fileMulti').change(function () {
            var files = $(this).prop('files');
            if(ArrImg.length > 3 || files.length > 3){
                alert("Количество загружаемых изображений должно быть не больше трех");
                return false;
            }
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
                    var result = JSON.parse(data);
                    if(result.success == true){

                        $('.errors_post').html('<div class="alert alert-success"><ul><li>Объявление добавлено, на проверке у модератора</li></ul></div>');
                        $('.add_post_admin textarea').val(' ');
                        $('#outputMulti').html(' ');
                        ArrImg = null;

                    }else{
                        $('.errors_post').html('<div class="alert alert-danger"><ul><li>'+result.content+'</li></ul></div>')
                    }
                }
            });
        });

        dropZone.on('click', function (event) {
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
                            var span = document.createElement('a');
                            span.innerHTML = ['<img class="img-thumbnail" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                            document.getElementById('outputMulti').insertBefore(span, null);
                            $('#outputMulti a').on('click', function(event){
                                event.preventDefault();
                                event.stopPropagation();
                                for (key in ArrImg) {
                                    if (ArrImg[key].name == $(this).children().attr("title")) {
                                        delete ArrImg.splice(key, 1);
                                    }
                                }
                                $(this).remove();
                            });
                        };
                    })(f);
                    reader.readAsDataURL(f);
                }
            }
        }
    }
})();
