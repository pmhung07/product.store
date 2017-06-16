/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

window.app = {};

module.exports = app;

/***/ }),
/* 1 */
/***/ (function(module, exports) {

var Helper = {

    number_format: function(number, decimals, dec_point, thousands_sep) {
        number = (number + '')
          .replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
          prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
          sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
          dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
          s = '',
          toFixedFix = function(n, prec) {
             var k = Math.pow(10, prec);
             return '' + (Math.round(n * k) / k)
                .toFixed(prec);
          };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
          .split('.');
        if (s[0].length > 3) {
          s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '')
          .length < prec) {
          s[1] = s[1] || '';
          s[1] += new Array(prec - s[1].length + 1)
             .join('0');
        }
        return s.join(dec);
    },


    formatCurrency: function(value) {
      return this.number_format(value, 0, '.', '.');
    },

    /**
     * Show validate error from laravel when ajax submit form
     */
    showValidateError : function(response) {
        var errors = response.responseJSON;
        for(var key in errors) {
            var error = errors[key];
            $('[name="'+key+'"]').addClass('in-valid-error').addClass('border-red');
            for( var j in error) {
                toastr.error(error[j], '');
            }
        }

        $('.in-valid-error').on('change', function() {
            $(this).removeClass('border-red');
        });
    },

    showMessage : function(message, type, timeOut = 800) {
        toastr[type](message, '', {
          timeOut: timeOut
        });
    },

    showMessageAndRedirect : function(message, type, url) {
        toastr[type](message, '', {
            timeOut: 800,
            onHidden: function() {
                window.location.href = url;
            }
        })
    }
}

module.exports = Helper;

/***/ }),
/* 2 */
/***/ (function(module, exports) {

///// PLUGIN
(function( $ ) {

    // Tag input
    $.fn.inficaTagsInput = function(options) {
        var _default = {
            width: '100%',
            height: 'auto',
            placeHolder: "Add a tag",
            maxTags : 10,
            items: [],
            onAddTag : function(tag) {},
            onRemoveTag: function(element) {}
        };

        options = $.extend(_default, options);

        return this.each(function() {
            var $this = $(this);

            // Ẩn control thật
            $this.hide();

            var tagItemsId = [];

            containerId = Math.round(Math.random(111111111,99999999)*100000000 + Math.floor(Date.now() / 1000));
            var $container = $('<div>').attr({
                id: 'infica-tags-input-container-'+containerId,
                class : 'infica-tags-input-container'
            }).css({
                width: options.width,
                height: options.height
            });

            var $input = $('<input />').attr({
                type: 'text',
                class: 'infica-tags-input-input',
                placeHolder: options.placeHolder
            });

            var items = options.items;

            function add_tag(tag) {
                items.push(tag);

                generate_tag();

                options.onAddTag(tag);
            }

            function handle_remove_tag(e) {
                console.log(e);
            }

            function generate_tag() {
                // Reset
                $container.empty();
                // Append

                var length = items.length;
                if(length > options.maxTags) length = options.maxTags;

                for(var i = 0; i < length; i ++) {
                    var item = items[i];

                    var $item = $('<span>').attr({
                        class: 'infica-tag-item',
                        'data-id' : item.id,
                        'data-label': item.label
                    }).html('<span>'+$.trim(item.label)+'</span>');

                    var $close = $('<i>').attr({
                        class : 'infica-tag-close',
                        'data-id' : item.id,
                        'data-label': $.trim(item.label)
                    }).text('x');

                    $item.append($close);

                    $container.append($item);
                }

                $container.append($input);
                $container.insertAfter($this);

                // Gắn giá trị vào control thật
                $this.attr('data-value', get_tag_values().join(','))
                     .val(get_tag_values().join(','));
            }

            function get_tag_ids() {
                var ids = [];
                for(var i = 0; i < items.length; i ++) {
                    ids.push(items[i].id);
                }

                return ids;
            }

            function get_tag_values() {
                var values = [];
                for(var i = 0; i < items.length; i ++) {
                    values.push(items[i].label);
                }

                return values;
            }

            generate_tag();

            // Keypress add tag
            $(document).on('keypress', '#infica-tags-input-container-'+containerId+' .infica-tags-input-input', function(e) {
                var keyCode = e.keyCode | e.which;

                if(keyCode == 44 || keyCode == 13) {
                    add_tag({
                        id: 0,
                        label: $(e.currentTarget).val()
                    });

                    generate_tag();

                    $(this).focus();

                    $(this).val('');

                    return false;
                }
            });

            // Remove tag
            $(document).on('click', '#infica-tags-input-container-'+containerId+' .infica-tag-close', function(e) {
                var _that = $(this);
                $(this).parents('.infica-tag-item').remove();

                for(var i = 0; i < items.length; i ++) {
                    if(_that.data('id') == items[i].id) {
                        items.splice(i, 1);
                    }
                }

                generate_tag();

                options.onRemoveTag(this);
            });
        });
    }
})( jQuery );

/***/ }),
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__helper_helper__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__app__);



__WEBPACK_IMPORTED_MODULE_1__app___default.a.GaController = function(params) {

    var chartData = params.chart_data;

    function chart_summary() {
        var data = {
            labels: chartData.labels,
            datasets: [
                {
                    label: "Page view",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(85,255,10,0.4)",
                    borderColor: "rgba(85,192,10,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(85,255,10,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(85,255,10,1)",
                    pointHoverBorderColor: "rgba(85,255,10,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: chartData.page_view.data,
                    spanGaps: false
                }
            ]
        };

        var ctx = document.getElementById('chart');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.formatCurrency(tooltipItems.yLabel);
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            // Create scientific notation labels
                            callback: function(value, index, values) {
                                return __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.formatCurrency(value);
                            }
                        }
                    }]
                }
            }
        });
    }

    function chart_visit() {
        var data = {
            labels: chartData.labels,
            datasets: [
                {
                    label: "Visit",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: chartData.visit.data,
                    spanGaps: false
                }
            ]
        };

        var ctx = document.getElementById('chart-visit');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.formatCurrency(tooltipItems.yLabel);
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            // Create scientific notation labels
                            callback: function(value, index, values) {
                                return __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.formatCurrency(value);
                            }
                        }
                    }]
                }
            }
        });
    }

    function chart_session_duration() {
        var data = {
            labels: chartData.labels,
            datasets: [
                {
                    label: "Session duration",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(25,11,10,0.4)",
                    borderColor: "rgba(25,11,10,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(25,11,10,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(25,11,10,1)",
                    pointHoverBorderColor: "rgba(25,11,10,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: chartData.session_duration.data,
                    spanGaps: false
                }
            ]
        };

        var ctx = document.getElementById('chart-session-duration');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                tooltips: {
                    enabled: true,
                    mode: 'single',
                    callbacks: {
                        label: function(tooltipItems, data) {
                            return __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.formatCurrency(tooltipItems.yLabel);
                        }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            // Create scientific notation labels
                            callback: function(value, index, values) {
                                return __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.formatCurrency(value);
                            }
                        }
                    }]
                }
            }
        });
    }


    function setup_date_picker() {
        $('.datepicker').datepicker({
            todayHighlight: true,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
        });
    }

    function init() {
        setup_date_picker();
        chart_summary();
        chart_visit();
        chart_session_duration();
    }

    return {
        init: init
    }
}

/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__helper_helper__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__app__);



__WEBPACK_IMPORTED_MODULE_1__app___default.a.ProductAddController = function() {

    function init() {
        // Biến xác nhận có tạo variant hay ko?
        var _fillAttr = false;

        function initTagsInput() {
            // Input tags input
            $('.attribute-value-input').tagsInput({
                defaultText : 'Nhập giá trị cách nhau bằng dấu phẩy hoặc nhấn Enter',
                width: '100%',
                height: 100
            });
        }

        initTagsInput();

        // Show form add variant
        $('#add-variant').click(function(e) {
            e.preventDefault();
            $('#variant-container').removeClass('hide');

            //  Ẩn hiện nút đóng
            if(!$('#variant-container').hasClass('hide')) {
                $('#cancel-variant').removeClass('hide');
            } else {
                $('#cancel-variant').addClass('hide');
            }

            _fillAttr = true;
        });

        // Cancel variant
        $('#cancel-variant').click(function() {
            $('#variant-container').addClass('hide');
            $(this).addClass('hide');

            _fillAttr = false;
        });

        // Append control to create variant
        $('#btn-add-new-attribute').click(function(e) {
            e.preventDefault();

            // $(document.getElementById('template-new-attribute').innerHTML).insertAfter('.first-attribute');
            $('#placement-new-attribute').append($(document.getElementById('template-new-attribute').innerHTML));

            initTagsInput();

            if($('.attribute-row').length == 3) {
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
            _back_image,
            _images = [];

        $('[name="image"]').change(function() {
            _image = this.files[0];
        });

        $('[name="back_image"]').change(function() {
            _back_image = this.files[0];
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
            if(_back_image) formData.append('back_image', _back_image);
            if(_images) {
                for( var i in _images ) {
                    formData.append('images[]', _images[i]);
                }
            }

            if(_fillAttr == false) {
                formData.delete('option[]');
                formData.delete('value[]');
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
                    __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showValidateError(response);
                },

                success : function(response) {
                    if(response.code == 1) {
                        if(saveAndExit == 0) {
                            __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessageAndRedirect(response.message, 'success', response.redirect);
                        } else {
                            __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessage(response.message, 'success', 600);
                            setTimeout(() => {
                                window.location.href = "/system/product/index";
                            }, 600)
                        }
                    }
                }
            });
        });

        // Ajax search product group
        $('#product-group').tokenInput('/system/ajax/product-group', {
            preventDuplicates: true,
            theme: 'facebook',
            hintText: "Nhóm sản phẩm",
            noResultsText: "Không có nhóm nào được tìm thấy",
            searchingText: "Đang tìm"
        });
    }

    return {
        init: init
    }
};

/***/ }),
/* 5 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__helper_helper__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__app__);



__WEBPACK_IMPORTED_MODULE_1__app___default.a.ProductUpdateController = function(params) {
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

            $('#placement-new-attribute').find('.btn-delete-attribute').attr('data-id', 0);

            if($('.attribute-row').length == 3) {
                $(this).addClass('hide');
            }
        });

        // Delete variant
        $(document).on('click', '.btn-delete-attribute', function(e) {
            e.preventDefault();
            var $this = $(this);
            $this.parents('.attribute-row').remove();

            $.ajax({
                url: "/system/product/option/"+$this.data('id')+"/delete",
                type: 'GET',
                dataType: "json",
                success: function(response) {
                    console.log(response);
                }
            });

            // Nếu xóa hết, cập nhật lại trạng thái _fillAttr
            if($('.attribute-row').length == 0) {
                _fillAttr = false;
            }
        });

        // Get file data when i click choose file from computer
        var _image,
            _back_image,
            _images = [];

        $('[name="image"]').change(function() {
            _image = this.files[0];
        });

        $('[name="back_image"]').change(function() {
            _back_image = this.files[0];
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
            if(_back_image) formData.append('back_image', _back_image);
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
                    __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showValidateError(response);
                },

                success : function(response) {
                    if(response.code == 1) {
                        if(saveAndExit == 0) {
                            __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessageAndRedirect(response.message, 'success', response.redirect);
                        } else {
                            __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessage(response.message, 'success', 600);
                            setTimeout(() => {
                                window.location.href = "/system/product/index";
                            }, 600)
                        }
                    } else if(response.code == 422) {
                        __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessage(response.message, 'error');
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
                        __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessage(response.message, response.type);
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
                    __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessageAndRedirect(response.message, response.type, response.redirect);
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


        // Preview image when you choice
        $('.input-file-hidden').on('change', function() {
            var $this = $(this);
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $this.prev().attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

    }

    return {
        init: init
    }
}

/***/ }),
/* 6 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 7 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__plugins_infica_tags_input_infica_tags_input_js__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__plugins_infica_tags_input_infica_tags_input_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__plugins_infica_tags_input_infica_tags_input_js__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__plugins_infica_tags_input_infica_tags_input_scss__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__plugins_infica_tags_input_infica_tags_input_scss___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__plugins_infica_tags_input_infica_tags_input_scss__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__plugins_mustache_min_js__ = __webpack_require__(12);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__plugins_mustache_min_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__plugins_mustache_min_js__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__product_ProductAddController__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__product_ProductUpdateController__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__email_marketing_EmailMarketingAddController__ = __webpack_require__(13);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__ga_GaController_js__ = __webpack_require__(3);
// Plugins





// System Product





// Ga


/***/ }),
/* 8 */,
/* 9 */,
/* 10 */,
/* 11 */,
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;(function defineMustache(global,factory){if(typeof exports==="object"&&exports&&typeof exports.nodeName!=="string"){factory(exports)}else if(true){!(__WEBPACK_AMD_DEFINE_ARRAY__ = [exports], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__))}else{global.Mustache={};factory(global.Mustache)}})(this,function mustacheFactory(mustache){var objectToString=Object.prototype.toString;var isArray=Array.isArray||function isArrayPolyfill(object){return objectToString.call(object)==="[object Array]"};function isFunction(object){return typeof object==="function"}function typeStr(obj){return isArray(obj)?"array":typeof obj}function escapeRegExp(string){return string.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&")}function hasProperty(obj,propName){return obj!=null&&typeof obj==="object"&&propName in obj}var regExpTest=RegExp.prototype.test;function testRegExp(re,string){return regExpTest.call(re,string)}var nonSpaceRe=/\S/;function isWhitespace(string){return!testRegExp(nonSpaceRe,string)}var entityMap={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;","/":"&#x2F;","`":"&#x60;","=":"&#x3D;"};function escapeHtml(string){return String(string).replace(/[&<>"'`=\/]/g,function fromEntityMap(s){return entityMap[s]})}var whiteRe=/\s*/;var spaceRe=/\s+/;var equalsRe=/\s*=/;var curlyRe=/\s*\}/;var tagRe=/#|\^|\/|>|\{|&|=|!/;function parseTemplate(template,tags){if(!template)return[];var sections=[];var tokens=[];var spaces=[];var hasTag=false;var nonSpace=false;function stripSpace(){if(hasTag&&!nonSpace){while(spaces.length)delete tokens[spaces.pop()]}else{spaces=[]}hasTag=false;nonSpace=false}var openingTagRe,closingTagRe,closingCurlyRe;function compileTags(tagsToCompile){if(typeof tagsToCompile==="string")tagsToCompile=tagsToCompile.split(spaceRe,2);if(!isArray(tagsToCompile)||tagsToCompile.length!==2)throw new Error("Invalid tags: "+tagsToCompile);openingTagRe=new RegExp(escapeRegExp(tagsToCompile[0])+"\\s*");closingTagRe=new RegExp("\\s*"+escapeRegExp(tagsToCompile[1]));closingCurlyRe=new RegExp("\\s*"+escapeRegExp("}"+tagsToCompile[1]))}compileTags(tags||mustache.tags);var scanner=new Scanner(template);var start,type,value,chr,token,openSection;while(!scanner.eos()){start=scanner.pos;value=scanner.scanUntil(openingTagRe);if(value){for(var i=0,valueLength=value.length;i<valueLength;++i){chr=value.charAt(i);if(isWhitespace(chr)){spaces.push(tokens.length)}else{nonSpace=true}tokens.push(["text",chr,start,start+1]);start+=1;if(chr==="\n")stripSpace()}}if(!scanner.scan(openingTagRe))break;hasTag=true;type=scanner.scan(tagRe)||"name";scanner.scan(whiteRe);if(type==="="){value=scanner.scanUntil(equalsRe);scanner.scan(equalsRe);scanner.scanUntil(closingTagRe)}else if(type==="{"){value=scanner.scanUntil(closingCurlyRe);scanner.scan(curlyRe);scanner.scanUntil(closingTagRe);type="&"}else{value=scanner.scanUntil(closingTagRe)}if(!scanner.scan(closingTagRe))throw new Error("Unclosed tag at "+scanner.pos);token=[type,value,start,scanner.pos];tokens.push(token);if(type==="#"||type==="^"){sections.push(token)}else if(type==="/"){openSection=sections.pop();if(!openSection)throw new Error('Unopened section "'+value+'" at '+start);if(openSection[1]!==value)throw new Error('Unclosed section "'+openSection[1]+'" at '+start)}else if(type==="name"||type==="{"||type==="&"){nonSpace=true}else if(type==="="){compileTags(value)}}openSection=sections.pop();if(openSection)throw new Error('Unclosed section "'+openSection[1]+'" at '+scanner.pos);return nestTokens(squashTokens(tokens))}function squashTokens(tokens){var squashedTokens=[];var token,lastToken;for(var i=0,numTokens=tokens.length;i<numTokens;++i){token=tokens[i];if(token){if(token[0]==="text"&&lastToken&&lastToken[0]==="text"){lastToken[1]+=token[1];lastToken[3]=token[3]}else{squashedTokens.push(token);lastToken=token}}}return squashedTokens}function nestTokens(tokens){var nestedTokens=[];var collector=nestedTokens;var sections=[];var token,section;for(var i=0,numTokens=tokens.length;i<numTokens;++i){token=tokens[i];switch(token[0]){case"#":case"^":collector.push(token);sections.push(token);collector=token[4]=[];break;case"/":section=sections.pop();section[5]=token[2];collector=sections.length>0?sections[sections.length-1][4]:nestedTokens;break;default:collector.push(token)}}return nestedTokens}function Scanner(string){this.string=string;this.tail=string;this.pos=0}Scanner.prototype.eos=function eos(){return this.tail===""};Scanner.prototype.scan=function scan(re){var match=this.tail.match(re);if(!match||match.index!==0)return"";var string=match[0];this.tail=this.tail.substring(string.length);this.pos+=string.length;return string};Scanner.prototype.scanUntil=function scanUntil(re){var index=this.tail.search(re),match;switch(index){case-1:match=this.tail;this.tail="";break;case 0:match="";break;default:match=this.tail.substring(0,index);this.tail=this.tail.substring(index)}this.pos+=match.length;return match};function Context(view,parentContext){this.view=view;this.cache={".":this.view};this.parent=parentContext}Context.prototype.push=function push(view){return new Context(view,this)};Context.prototype.lookup=function lookup(name){var cache=this.cache;var value;if(cache.hasOwnProperty(name)){value=cache[name]}else{var context=this,names,index,lookupHit=false;while(context){if(name.indexOf(".")>0){value=context.view;names=name.split(".");index=0;while(value!=null&&index<names.length){if(index===names.length-1)lookupHit=hasProperty(value,names[index]);value=value[names[index++]]}}else{value=context.view[name];lookupHit=hasProperty(context.view,name)}if(lookupHit)break;context=context.parent}cache[name]=value}if(isFunction(value))value=value.call(this.view);return value};function Writer(){this.cache={}}Writer.prototype.clearCache=function clearCache(){this.cache={}};Writer.prototype.parse=function parse(template,tags){var cache=this.cache;var tokens=cache[template];if(tokens==null)tokens=cache[template]=parseTemplate(template,tags);return tokens};Writer.prototype.render=function render(template,view,partials){var tokens=this.parse(template);var context=view instanceof Context?view:new Context(view);return this.renderTokens(tokens,context,partials,template)};Writer.prototype.renderTokens=function renderTokens(tokens,context,partials,originalTemplate){var buffer="";var token,symbol,value;for(var i=0,numTokens=tokens.length;i<numTokens;++i){value=undefined;token=tokens[i];symbol=token[0];if(symbol==="#")value=this.renderSection(token,context,partials,originalTemplate);else if(symbol==="^")value=this.renderInverted(token,context,partials,originalTemplate);else if(symbol===">")value=this.renderPartial(token,context,partials,originalTemplate);else if(symbol==="&")value=this.unescapedValue(token,context);else if(symbol==="name")value=this.escapedValue(token,context);else if(symbol==="text")value=this.rawValue(token);if(value!==undefined)buffer+=value}return buffer};Writer.prototype.renderSection=function renderSection(token,context,partials,originalTemplate){var self=this;var buffer="";var value=context.lookup(token[1]);function subRender(template){return self.render(template,context,partials)}if(!value)return;if(isArray(value)){for(var j=0,valueLength=value.length;j<valueLength;++j){buffer+=this.renderTokens(token[4],context.push(value[j]),partials,originalTemplate)}}else if(typeof value==="object"||typeof value==="string"||typeof value==="number"){buffer+=this.renderTokens(token[4],context.push(value),partials,originalTemplate)}else if(isFunction(value)){if(typeof originalTemplate!=="string")throw new Error("Cannot use higher-order sections without the original template");value=value.call(context.view,originalTemplate.slice(token[3],token[5]),subRender);if(value!=null)buffer+=value}else{buffer+=this.renderTokens(token[4],context,partials,originalTemplate)}return buffer};Writer.prototype.renderInverted=function renderInverted(token,context,partials,originalTemplate){var value=context.lookup(token[1]);if(!value||isArray(value)&&value.length===0)return this.renderTokens(token[4],context,partials,originalTemplate)};Writer.prototype.renderPartial=function renderPartial(token,context,partials){if(!partials)return;var value=isFunction(partials)?partials(token[1]):partials[token[1]];if(value!=null)return this.renderTokens(this.parse(value),context,partials,value)};Writer.prototype.unescapedValue=function unescapedValue(token,context){var value=context.lookup(token[1]);if(value!=null)return value};Writer.prototype.escapedValue=function escapedValue(token,context){var value=context.lookup(token[1]);if(value!=null)return mustache.escape(value)};Writer.prototype.rawValue=function rawValue(token){return token[1]};mustache.name="mustache.js";mustache.version="2.3.0";mustache.tags=["{{","}}"];var defaultWriter=new Writer;mustache.clearCache=function clearCache(){return defaultWriter.clearCache()};mustache.parse=function parse(template,tags){return defaultWriter.parse(template,tags)};mustache.render=function render(template,view,partials){if(typeof template!=="string"){throw new TypeError('Invalid template! Template should be a "string" '+'but "'+typeStr(template)+'" was given as the first '+"argument for mustache#render(template, view, partials)")}return defaultWriter.render(template,view,partials)};mustache.to_html=function to_html(template,view,partials,send){var result=mustache.render(template,view,partials);if(isFunction(send)){send(result)}else{return result}};mustache.escape=escapeHtml;mustache.Scanner=Scanner;mustache.Context=Context;mustache.Writer=Writer;return mustache});


/***/ }),
/* 13 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__helper_helper__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__app__);



__WEBPACK_IMPORTED_MODULE_1__app___default.a.EmailMarketingAddController = function(args) {
    var that = this;
    function init() {
        // Register all events with the handle
        eventRegister();
    }

    function onChangeTimer(e) {
        e.preventDefault();
        $('#modal-timer').modal('show');
    }

    function onDeleteTimer(e) {
        e.preventDefault();
        var $this = $(this);
        if(confirm("Bạn có chắc chắn muốn xóa mẫu này không?")) {
            $this.parents('.email-template-selected-item').remove();
        }
    }

    function toggleSendBtnRightNow(e) {
        var $this = $(this);
        if($this.is(':checked')) {
            $this.parents('form')
                .find('.form-control')
                .attr('disabled', 'disabled');
        } else {
            $this.parents('form')
                .find('.form-control')
                .removeAttr('disabled');
        }
    }

    function eventRegister() {
        $(document).on('click',  '.btn-timer', onChangeTimer);
        $(document).on('click',  '.btn-delete', onDeleteTimer);
        $('#timer-checkbox-right-now').on('change', toggleSendBtnRightNow);
    }

    return {
        init: init
    }
}


/***/ })
/******/ ]);
//# sourceMappingURL=bundle.js.map