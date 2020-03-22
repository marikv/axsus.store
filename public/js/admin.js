$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function readURL(input, n) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#'+n+'_img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$("#photo").change(function() {
    readURL(this, 'photo');
});


var editItem = function (jsonData) {
    $.each(jsonData, function(key, value) {
        var ctrl = $('#'+key);
        if (ctrl.length) {
            if (ctrl.hasClass('my-wysiwyg')) {
                tinyMCE.get(key).setContent(value ? String(value) : '');
            }
            switch(ctrl.prop("type")) {
                case "radio": case "checkbox":
                    ctrl.each(function() {
                        if($(this).attr('value') === value) $(this).attr("checked",value);
                    });
                    break;
                case "file":
                    var $img = $('img#'+key+'_img');
                    if ($img.length > 0) {
                        if (value) {
                            $img.attr('src', value);
                        } else {
                            $img.attr('src', '/uploads/no-image.png');
                        }
                    }
                    break;
                default:
                    ctrl.val(value);
            }
        }
    });
    $('.itemModal').modal('show');
};


var ajaxSubmitForm = function (formId) {
    var $form = $('#'+formId);
    var form = $form[0];
    var url = $form.attr('action');
    var data = new FormData(form);
    if (tinyMCE !== undefined && $form.find('.my-wysiwyg').length) {
        var tinyMCEid = $form.find('.my-wysiwyg').attr('id');
        data.append(tinyMCEid, tinyMCE.get(tinyMCEid).getContent());
    }
    $("#btnSubmit").prop("disabled", true);
    $.ajax({
        type: $form.attr('method') ? $form.attr('method') : 'POST',
        url: url,
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            $("#btnSubmit").prop("disabled", false);
            $('.itemModal').modal('hide');
            document.location.reload();
        },
        error: function (e) {
            $("#btnSubmit").prop("disabled", false);
            $('.itemModal').modal('hide')
        }
    });
}

var deleteBrand = function (id) {
    if (confirm('Вы уверены что хотите удалить?')) {
        $.ajax({
            type: 'DELETE',
            url: '/adm/deleteBrand',
            data: { id },
            success: function (data) {
                $("#trBrand" + id).remove();
            },
            error: function (e) {
            }
        });
    }
};
var deleteProduct = function (id) {
    if (confirm('Вы уверены что хотите удалить?')) {
        $.ajax({
            type: 'DELETE',
            url: '/adm/deleteProduct',
            data: { id },
            success: function (data) {
                $("#trProduct" + id).remove();
            },
            error: function (e) {
            }
        });
    }
};

var deletePage = function (id) {
    if (confirm('Вы уверены что хотите удалить?')) {
        $.ajax({
            type: 'DELETE',
            url: '/adm/deletePage',
            data: { id },
            success: function (data) {
                $("#trPage" + id).remove();
            },
            error: function (e) {
            }
        });
    }
};

var deleteCarousel = function (id) {
    if (confirm('Вы уверены что хотите удалить?')) {
        $.ajax({
            type: 'DELETE',
            url: '/adm/deleteCarousel',
            data: { id },
            success: function (data) {
                $("#trCarousel" + id).remove();
            },
            error: function (e) {
            }
        });
    }
};


var deleteFaq = function (id) {
    if (confirm('Вы уверены что хотите удалить?')) {
        $.ajax({
            type: 'DELETE',
            url: '/adm/deleteFaq',
            data: { id },
            success: function (data) {
                $("#trFaq" + id).remove();
            },
            error: function (e) {
            }
        });
    }
};
