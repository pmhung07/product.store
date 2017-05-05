import Helper from '../helper/helper';

$(function() {

    function initTagsInput() {
        // Input tags input
        $('.attribute-value-input').tagsInput({
            defaultText : 'Nhập giá trị cách nhau bằng dấu phẩy. Kết thúc nhấn Enter',
            width: '100%',
            height: 100
        });
    }

    initTagsInput();

    // Show form add variant
    $('#add-variant').click(function(e) {
        e.preventDefault();
        $('#variant-container').toggleClass('hide');
    });

    // Cancel variant
    $('#cancel-variant').click(function() {
        $('#variant-container').addClass('hide');
    });

    // Append control to create variant
    $('#btn-add-new-attribute').click(function(e) {
        e.preventDefault();

        $(document.getElementById('template-new-attribute').innerHTML).insertAfter('.first-attribute');

        initTagsInput();

        if($('.attribute-row.append').length == 2) {
            $(this).addClass('hide');
        }
    });

    // Delete variant
    $(document).on('click', '.btn-delete-attribute', function(e) {
        e.preventDefault();
        $(this).parents('.attribute-row').remove();
    });

    // Get file data when i click choose file from computer
    var _image,
        _images = [];

    $('[name="image"]').change(function() {
        _image = this.files[0];
    });

    $('[name="images[]"]').change(function() {
        for(var i = 0; i < this.files.length; i ++) {
            _images.push(this.files[i]);
        }
    });

    // Submit form
    $('#form-data').on('submit', function(e) {
        e.preventDefault();

        var $form = $(this);

        var formData = new FormData();
        var arrayFormDataSubmit = $form.serializeArray();

        for(var i in arrayFormDataSubmit) {
            var control = arrayFormDataSubmit[i];
            formData.append(control.name, control.value);
        }

        if(_image) formData.append('image', _image);
        if(_images) {
            for( var i in _images ) {
                formData.append('images[]', _images[i]);
            }
        }

        $.ajax({
            url: $form.attr('action'),
            type: "POST",
            dataType: 'json',
            data : formData,
            cache: false,
            processData: false,
            contentType: false,
            error : function(response) {
                Helper.showValidateError(response);
            },

            success : function(response) {

            }
        });
    });
});