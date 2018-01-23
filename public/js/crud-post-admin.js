//(function () {

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var ArrImg = [];
var ImgRemove = [];

var dropZone = $('#dropZone');
$('#fileMulti').change(function () {
    var files = $(this).prop('files');
    lengthImg = $('#outputMulti a').length;
    razn = 1;
    if(lengthImg){
        razn = lengthImg - files.length;
    }
    if (ArrImg.length > 3 || files.length > 3 || lengthImg >= 3 || razn < 0) {
        alert("Количество загружаемых изображений должно быть не больше трех");
        return false;
    }
    dragFiles(ArrImg, files);
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
                    span.onclick = function() {
                        removeImage($(this));
                    }
                    span.innerHTML = ['<img class="img-thumbnail" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('outputMulti').insertBefore(span, null);
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
}

function removeImage(thisimg){
    img = thisimg.children().data('id');
    if (img) {
        ImgRemove.push(img);
    }

    $('input[name="removeImg"]').val(ImgRemove);
    event.preventDefault();
    event.stopPropagation();
    for (key in ArrImg) {
        if (ArrImg[key].name == thisimg.children().attr("title")) {
            delete ArrImg.splice(key, 1);
        }
    }
    thisimg.remove();
    lengthImg = $('#outputMulti a').length;
}



//})();
