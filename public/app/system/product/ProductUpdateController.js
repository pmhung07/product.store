import Helper from '../helper/helper';
import app from '../app';

app.ProductUpdateController = function(params) {
    var _that = this;
    this.hasChild = params.has_child ? params.has_child : 0;

    /**
     * Request delete option value
     */
    function requestDeleteOptionvalue(variantId, valueId) {
        // console.log(e);
        $.ajax({
            url: "/ajax/delete-option-value",
            type: "POST",
            data: {
                variant_id : variantId,
                valueId: valueId
            }
        });
    }

    function init() {
        // Biến xác nhận có tạo variant hay ko?
        var _fillAttr = _that.hasChild ? true : false;

        // Append control to create variant
        $('#btn-add-new-attribute').click(function(e) {
            e.preventDefault();

            // $(document.getElementById('template-new-attribute').innerHTML).insertAfter('.first-attribute');
            $('#placement-new-attribute').append($(document.getElementById('template-new-attribute').innerHTML));

            $('#placement-new-attribute .attribute-value-input:last').inficaTagsInput({
                placeHolder: "VD: Xanh,Đỏ,Vàng"
            });

            if($('.attribute-row').length == 3) {
                $(this).addClass('hide');
            }
        });

        // Delete variant
        $(document).on('click', '.btn-delete-attribute', function(e) {
            e.preventDefault();
            $(this).parents('.attribute-row').remove();

            // Nếu xóa hết, cập nhật lại trạng thái _fillAttr
            if($('.attribute-row').length == 0) {
                _fillAttr = false;
            }
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

        var saveAndExit = 0;
        $('#btn-save-and-exit').click(function(e) {
            e.preventDefault();
            saveAndExit = 1;
            $('#form-data').submit();
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
                    if(response.code == 1) {
                        if(saveAndExit == 0) {
                            Helper.showMessageAndRedirect(response.message, 'success', response.redirect);
                        } else {
                            Helper.showMessage(response.message, 'success', 600);
                            setTimeout(() => {
                                window.location.href = "/system/product/index";
                            }, 600)
                        }
                    } else if(response.code == 422) {
                        Helper.showMessage(response.message, 'error');
                    }
                }
            });
        });

        // Upload image variant
        var _tempIndexVariantImage = -1;
        $('.variant-upload-image').click(function() {
            $('#input-file-hidden').trigger('click');
            _tempIndexVariantImage = $(this).data('key');
        });

        $('#input-file-hidden').on('change', function(e) {
            var $this = $(this);
            var _file = this.files[0];
            var formdata = new FormData();
            formdata.append('file', _file);
            formdata.append('_token', App.config.token);

            $.ajax({
                url : "/ajax/upload-image",
                type : "POST",
                dataType: 'json',
                data : formdata,
                contentType: false,
                processData: false,
                beforeSend : function() {
                    $('#variant-upload-image-' + _tempIndexVariantImage).attr('src', '/img/ajax-loader.gif');
                },
                success : function(response) {
                    $('#variant-upload-image-' + _tempIndexVariantImage).attr('src', response.url);
                    $('#variant-image-' + _tempIndexVariantImage).attr('value', response.filename);
                }
            })
        });


        // Xóa variant
        $('.action-delete-variant').click(function(e) {
            e.preventDefault();
            var $this = $(this);
            if(confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                $.ajax({
                    url: "/system/product/variant/"+$this.data('variant_id')+"/delete",
                    type: "GET",
                    data: {},
                    dataType: "json",
                    success: function(response) {
                        Helper.showMessage(response.message, response.type);
                        window.location.reload();
                    }
                });
            }
        });

        // Update option
        $('#form-create-option').on('submit', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $this = $(this);
            $.ajax({
                url: "/system/product/option/update",
                type: "POST",
                data: $this.serialize(),
                dataType: "json",
                success: function(response) {
                    Helper.showMessageAndRedirect(response.message, response.type, response.redirect);
                    $('#modal-show-change-option').modal('hide');
                }
            })
        });

        // Ajax search product group
        $('#product-group').tokenInput('/system/ajax/product-group', {
            preventDuplicates: true,
            theme: 'facebook',
            hintText: "Nhóm sản phẩm",
            noResultsText: "Không có nhóm nào được tìm thấy",
            searchingText: "Đang tìm",
            prePopulate: params.group_data_input_token
        });

        $('.js-action-delete-product-image').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            if(confirm("Bạn có chắc chắn muốn xóa ảnh này?")) {
                $.ajax({
                    url : "/system/product/ajax/delete-image-item",
                    type: "POST",
                    dataType : "json",
                    data : {
                        id: $this.data('id'),
                        _token: App.config.token
                    },
                    success: function(response) {
                        $this.parent().remove();
                    }
                });
            }
        });

    }

    return {
        init: init
    }
}