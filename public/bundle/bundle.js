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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
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

    showMessage : function(message, type) {
        toastr[type](message);
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
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__less_custom_style_less__ = __webpack_require__(8);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__less_custom_style_less___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__less_custom_style_less__);


/***/ }),
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__product_ProductAddController__ = __webpack_require__(6);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__product_ProductUpdateController__ = __webpack_require__(7);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__ga_GaController_js__ = __webpack_require__(5);
// System Product



// Ga


/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__system_entry_js__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__shop_entry_js__ = __webpack_require__(2);




/***/ }),
/* 5 */
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
/* 6 */
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
                        __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessageAndRedirect(response.message, 'success', response.redirect);
                    }
                }
            });
        });
    }

    return {
        init: init
    }
};

/***/ }),
/* 7 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__helper_helper__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__app__);



__WEBPACK_IMPORTED_MODULE_1__app___default.a.ProductUpdateController = function(params) {
    var _that = this;
    this.hasChild = params.has_child ? params.has_child : 0;

    function init() {
        // Biến xác nhận có tạo variant hay ko?
        var _fillAttr = _that.hasChild ? true : false;

        function initTagsInput() {
            // Input tags input
            $('.attribute-value-input').tagsInput({
                defaultText : '',
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
                        __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessageAndRedirect(response.message, 'success', response.redirect);
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

    }

    return {
        init: init
    }
}

/***/ }),
/* 8 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);
//# sourceMappingURL=bundle.js.map