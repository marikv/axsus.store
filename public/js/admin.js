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


var showHideProductGroupOptions = function () {
    if (document.getElementById('brand_id') && document.getElementById('product_group_id')) {
        var brand_id = document.getElementById('brand_id').value;
        var $gr = $('#product_group_id');
        $gr.find('option').removeAttr('hidden');
        if (brand_id) {
            $gr.val('');
            $gr.find('option').attr('hidden', true);
            $gr.find('option[brand_id="' + brand_id + '"]').removeAttr('hidden');
        }
    }
};
var editItem = function (jsonData) {

    var $form = $('.itemModal').find('form');
    $form.find('input[type="text"]').each(function () {
        if ($(this).attr('data-default-value')) {
            $(this).val($(this).attr('data-default-value'));
        } else {
            $(this).val('');
        }
    });

    $form.find('input[type="number"]').val('');
    $form.find('input[type="email"]').val('');
    $form.find('input[type="file"]').val('');
    $form.find('input[type="hidden"]').val('');
    $form.find('input[type="checkbox"]').attr('checked', false);
    $form.find('input[type="radio"]').attr('checked', false);
    $form.find('select').val('');
    $form.find('textarea').val('');
    $form.find('#photo_img').attr('src', '/uploads/no-image.png');

    var setValues = function() {
        $.each(jsonData, function(key, value) {
            if (key === 'categories' || key === 'language_id' || key === 'os') {
                $('.' + key + '-cb').attr("checked", false);
                if (key === 'categories' && value.length) {
                    var valueArr = [];
                    for(var i=0; i<value.length; i++) {
                        if (value[i].category_id) {
                            valueArr.push(value[i].category_id);
                        }
                    }
                } else {
                    var valueArr = String(value).split(',');
                }
                if (valueArr.length) {
                    for(var i=0; i<valueArr.length; i++) {
                        $('#' + key + '_' + valueArr[i]).attr("checked", true);
                    }
                }
            } else if ($('#'+key).length) {

                var ctrl = $('#'+key);

                if (ctrl.hasClass('my-wysiwyg')) {
                    tinyMCE.get(key).setContent(value ? String(value) : '');
                } else if (ctrl.prop("type") === 'file') {
                    var $img = $('img#'+key+'_img');
                    if ($img.length > 0) {
                        if (value) {
                            $img.attr('src', value);
                            if (key === 'photo' && document.getElementById('photoHidden')) {
                                document.getElementById('photoHidden').value = value;
                            }
                        } else {
                            $img.attr('src', '/uploads/no-image.png');
                            if (key === 'photo' && document.getElementById('photoHidden')) {
                                document.getElementById('photoHidden').value = '';
                            }
                        }
                    }
                } else if (ctrl.prop("type") === 'radio' || ctrl.prop("type") === 'checkbox') {
                    ctrl.each(function() {
                        if(String($(this).attr('value')) === String(value)) {
                            $(this).attr("checked", value);
                        }
                    });
                } else {
                    ctrl.val(value);
                }
            }
        });
    };
    setValues();
    $('.itemModal').modal('show');
    showHideProductGroupOptions();
    setValues();
};
var copyItem = function (jsonData) {
    jsonData.id = 0;
    editItem(jsonData);
    document.getElementById('meta_title').value = '';
    document.getElementById('meta_description').value = '';
    document.getElementById('meta_keywords').value = '';
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
            alert('Ошибка');
        }
    });
}


var deleteItem = function (t, id) {
    if (confirm('Вы уверены что хотите удалить?')) {
        $.ajax({
            type: 'DELETE',
            url: '/adm/delete' + t,
            data: { id },
            success: function (data) {
                $("#trItem" + id).remove();
            },
            error: function (e) {
            }
        });
    }
};

var copyValueTo = function (value, inputId) {
    var el = document.getElementById(inputId);
    if (value && el && !el.value) {
        el.value = value;
    }
};
