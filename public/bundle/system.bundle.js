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
/******/ 	return __webpack_require__(__webpack_require__.s = 13);
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
/***/ (function(module, exports) {

(function($){
    $.unserialize = function(str){
        var items = str.split('&');
        var ret = "{";
        var arrays = [];
        var index = "";
        for (var i = 0; i < items.length; i++) {
            var parts = items[i].split(/=/);
            //console.log(parts[0], parts[0].indexOf("%5B"),  parts[0].indexOf("["));
            if (parts[0].indexOf("%5B") > -1 || parts[0].indexOf("[") > -1){
                //Array serializado
                index = (parts[0].indexOf("%5B") > -1) ? parts[0].replace("%5B","").replace("%5D","") : parts[0].replace("[","").replace("]","");
                //console.log("array detectado:", index);
                //console.log(arrays[index] === undefined);
                if (arrays[index] === undefined){
                    arrays[index] = [];
                }
                arrays[index].push( decodeURIComponent(parts[1].replace(/\+/g," ")));
                //console.log("arrays:", arrays);
            } else {
                //console.log("common item (not array)");
                if (parts.length > 1){
                    ret += "\""+parts[0] + "\": \"" + decodeURIComponent(parts[1].replace(/\+/g," ")).replace(/\n/g,"\\n").replace(/\r/g,"\\r") + "\", ";
                }
            }

        };

        ret = (ret != "{") ? ret.substr(0,ret.length-2) + "}" : ret + "}";
        //console.log(ret, arrays);
        var ret2 = JSON.parse(ret);
        //proceso los arrays
        for (arr in arrays){
            ret2[arr] = arrays[arr];
        }
        return ret2;
    }
})(jQuery);

/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__helper_helper__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__app__);



__WEBPACK_IMPORTED_MODULE_1__app___default.a.EmailMarketingAddController = function(args) {
    var that = this;
    that.args = args;
    that.lastEmailTemplateChangeTimer = 0;
    that.fileSelected = false;
    that.formData = {
        title: "",
        email_template_selected: {}
    };

    const formData = new FormData();

    function init() {
        // Register all events with the handle
        eventRegister();
    }

    function onSelectEmailTemplate(e) {
        let $this = $(this);

        if($('#email-selected-container').find('#selected-item-id-'+$this.data('id')).length == 0) {
            let template = Mustache.render($('#tpl-email-selected').html(), {
                id: $this.data('id'),
                title: $this.data('title'),
                time: 'Chưa cài đặt'
            });

            $('#email-selected-container').append($(template));
        }

    }

    function onOpenPopupSetTimer(e) {
        e.preventDefault();
        var $this = $(this);

        let $modalTimer = $('#modal-timer');
        $modalTimer.modal('show');
        $modalTimer.attr('last-selected-id', $this.data('id'));

        let time = $this.data('time');
        if(time > 0) {
            let date = new Date(time * 1000);
            let year = date.getFullYear();
            let month = date.getMonth()+1;
            let day = date.getDate();
            let hour = date.getHours();
            let minute = date.getMinutes();

            $modalTimer.find('[name="year"]').val(year);
            $modalTimer.find('[name="month"]').val(month);
            $modalTimer.find('[name="day"]').val(day);
            $modalTimer.find('[name="hour"]').val(hour);
            $modalTimer.find('[name="minute"]').val(minute);
        }
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

    function onSetTimerSubmit(e) {
        e.preventDefault();
        var $this = $(this);
        var year = $('#form-set-timer').find('[name="year"]').val();
        var month = $('#form-set-timer').find('[name="month"]').val();
        var day = $('#form-set-timer').find('[name="day"]').val();
        var hour = $('#form-set-timer').find('[name="hour"]').val();
        var minute = $('#form-set-timer').find('[name="minute"]').val();
        var now = $('#form-set-timer').find('[name="now"]').is(':checked');

        $('#modal-timer').modal('hide');

        let timestamp = 0;
        let timeString = '';
        if(!now) {
            timestamp = moment([year,month,day].join('-') + ' ' + [hour,minute].join(':')).unix();
            timeString = day+'/'+month+'/'+year+' '+hour+':'+minute;
        }

        let $itemEmailTemplate = $('#selected-item-id-'+$('#modal-timer').attr('last-selected-id'));
        $itemEmailTemplate.find('.btn-timer').data('time', timestamp);

        if(now) {
            timeString = 'Ngay lập tức';
            $('#selected-item-id-'+$('#modal-timer').attr('last-selected-id')).find('.btn-timer').data('time', 0);
        }
        $('#selected-item-id-'+$('#modal-timer').attr('last-selected-id')).find('.time').text(timeString);
    }

    function onSubmitMainForm(e) {
        e.preventDefault();
        var $this = $(this);
        formData.append('name', $this.find('[name="name"]').val());
        formData.append('_token', args.token);

        if($('.email-template-selected-item').length == 0) {
            alert('Vui lòng chọn một mẫu email để tiếp tục');
            return;
        }

        if(!that.fileSelected) {
            alert("Vui lòng chọn tập khách hàng từ máy tính");
            $('#file-customers').trigger('click');
            return;
        }

        $('.email-template-selected-item').each((index, el) => {
            let time = $(el).find('.btn-timer').data('time');

            if(time > 0) {
                let date = new Date(time * 1000);
                let year = date.getFullYear();
                let month = date.getMonth()+1;
                let day = date.getDate();
                let hour = date.getHours();
                let minute = date.getMinutes();

                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][id]", $(el).find('.btn-timer').data('id'));
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][year]", year);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][month]", month);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][day]", day);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][hour]", hour);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][minute]", minute);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][now]", 'false');
            } else {
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][id]", $(el).find('.btn-timer').data('id'));
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][now]", 'true');
            }
        });

        $.ajax({
            url: "/system/crm/email-marketing/create",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(e) {
                $this.find('button[type="submit"]').attr('disabled', 'disabled');
            },
            success: function(response) {
                if(response.code == 200) {
                    __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessage(response.message, 'success', 600);
                    setTimeout(() => {
                        window.location.href = '/system/crm/email-marketing/index';
                    }, 500);
                }
            }
        });
    }

    function onOpenPopUpNewEmailTemplate(e) {
        e.preventDefault();
        var $this = $(this);
        $('#modal-form-new-email-template').modal('show');
    }

    function onSubmitNewEmailTemplate(e) {
        e.preventDefault();
        var $this = $(this);

        let data = $.unserialize($this.serialize());
        data.content = tinymce.get('tiny-editor-new-email-template').getContent();

        $.ajax({
            url: '/system/email-template/create?_token='+that.args.token,
            type: 'POST',
            data: data,
            beforeSend: function() {
                $this.find('.btn-submit').attr('disabled', 'disabled');
            },
            success: function(response) {
                $this.find('.btn-submit').removeAttr('disabled');
                $('#modal-form-new-email-template').modal('hide');
                if(response.code == 200) {
                    let item = response.item;
                    let newEmailTemplate = Mustache.render($('#tpl-email-template').html(), {
                        id: item.id,
                        title: item.title
                    });

                    $('#email-template-container').append(newEmailTemplate);
                }
            }
        });
    }

    function eventRegister() {
        $(document).on('click', '.btn-action-select-template-email', onSelectEmailTemplate);
        $(document).on('click',  '.btn-timer', onOpenPopupSetTimer);
        $(document).on('click',  '.btn-delete', onDeleteTimer);
        $('#timer-checkbox-right-now').on('change', toggleSendBtnRightNow);

        $('#form-set-timer').on('submit', onSetTimerSubmit);

        $('#form-main').on('submit', onSubmitMainForm);

        $('.btn-action-new-email-template').on('click', onOpenPopUpNewEmailTemplate);

        $('#form-new-email-template').on('submit', onSubmitNewEmailTemplate);

        $('#file-customers').on('change', function() {
            formData.append('file-customers', this.files[0]);
        });

        $('#file-customers').on('change', function() {
            that.fileSelected = true;
            formData.append('file-customers', this.files[0]);
        });
    }

    return {
        init: init
    }
}


/***/ }),
/* 5 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__helper_helper___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__helper_helper__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__app___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__app__);



__WEBPACK_IMPORTED_MODULE_1__app___default.a.EmailMarketingEditController = function(args) {
    var that = this;
    that.args = args;
    that.lastEmailTemplateChangeTimer = 0;
    that.lastTimeStampChange = 0;
    that.formData = {
        title: "",
        email_template_selected: {}
    };

    that.fileSelected = false;
    const formData = new FormData();

    function init() {
        // Register all events with the handle
        eventRegister();
    }

    function onSelectEmailTemplate(e) {
        let $this = $(this);

        if($('#email-selected-container').find('#selected-item-id-'+$this.data('id')).length == 0) {
            console.log('template');
            let template = Mustache.render($('#tpl-email-selected').html(), {
                id: $this.data('id'),
                title: $this.data('title'),
                time: 'Chưa cài đặt'
            });

            $('#email-selected-container').append($(template));
        }

    }

    function onOpenPopupSetTimer(e) {
        e.preventDefault();
        var $this = $(this);

        that.lastEmailTemplateChangeTimer = $this.data('id');

        let time = $this.data('time');

        let $modalTimer = $('#modal-timer');
        $modalTimer.modal('show');

        // Gắn id vào modal để sau truy xuất ngược
        $modalTimer.attr('last-selected-id', $this.data('id'));

        if(time > 0) {
            let date = new Date(time * 1000);
            let year = date.getFullYear();
            let month = date.getMonth()+1;
            let day = date.getDate();
            let hour = date.getHours();
            let minute = date.getMinutes();

            $modalTimer.find('[name="year"]').val(year);
            $modalTimer.find('[name="month"]').val(month);
            $modalTimer.find('[name="day"]').val(day);
            $modalTimer.find('[name="hour"]').val(hour);
            $modalTimer.find('[name="minute"]').val(minute);
        }
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

    function onSetTimerSubmit(e) {
        e.preventDefault();
        var $this = $(this);
        var year = $('#form-set-timer').find('[name="year"]').val();
        var month = $('#form-set-timer').find('[name="month"]').val();
        var day = $('#form-set-timer').find('[name="day"]').val();
        var hour = $('#form-set-timer').find('[name="hour"]').val();
        var minute = $('#form-set-timer').find('[name="minute"]').val();
        var now = $('#form-set-timer').find('[name="now"]').is(':checked');

        let timestamp = 0;
        let timeString = '';
        if(!now) {
            timestamp = moment([year,month,day].join('-') + ' ' + [hour,minute].join(':')).unix();
            timeString = day+'/'+month+'/'+year+' '+hour+':'+minute;
        }

        // Set lại timestamp để hiện cho đúng
        $('#selected-item-id-'+$('#modal-timer').attr('last-selected-id')).find('.btn-timer').data('time', timestamp);
        $('#modal-timer').modal('hide');

        if(now) {
            timeString = 'Ngay lập tức';
            $('#selected-item-id-'+$('#modal-timer').attr('last-selected-id')).find('.btn-timer').data('time', 0);
        }
        $('#selected-item-id-'+that.lastEmailTemplateChangeTimer).find('.time').text(timeString);
    }

    function onSubmitMainForm(e) {
        e.preventDefault();
        var $this = $(this);
        formData.append('name', $this.find('[name="name"]').val());
        formData.append('_token', args.token);

        if($('.email-template-selected-item').length == 0) {
            alert('Vui lòng chọn một mẫu email để tiếp tục');
            return;
        }

        $('.email-template-selected-item').each((index, el) => {
            let time = $(el).find('.btn-timer').data('time');

            if(time > 0) {
                let date = new Date(time * 1000);
                let year = date.getFullYear();
                let month = date.getMonth()+1;
                let day = date.getDate();
                let hour = date.getHours();
                let minute = date.getMinutes();

                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][id]", $(el).find('.btn-timer').data('id'));
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][year]", year);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][month]", month);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][day]", day);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][hour]", hour);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][minute]", minute);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][now]", 'false');
            } else {
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][id]", $(el).find('.btn-timer').data('id'));
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][now]", 'true');
            }
        });

        $.ajax({
            url: "/system/crm/email-marketing/"+that.args.campain_id+"/edit",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function(e) {
                $this.find('button[type="submit"]').attr('disabled', 'disabled');
            },
            success: function(response) {
                if(response.code == 200) {
                    __WEBPACK_IMPORTED_MODULE_0__helper_helper___default.a.showMessage(response.message, 'success', 600);
                    setTimeout(() => {
                        window.location.href = '/system/crm/email-marketing/index';
                    }, 500);
                }
            }
        });
    }

    function onOpenPopUpNewEmailTemplate(e) {
        e.preventDefault();
        var $this = $(this);
        $('#modal-form-new-email-template').modal('show');
    }

    function onSubmitNewEmailTemplate(e) {
        e.preventDefault();
        var $this = $(this);

        let data = $.unserialize($this.serialize());
        data.content = tinymce.get('tiny-editor-new-email-template').getContent();

        $.ajax({
            url: '/system/email-template/create?_token='+that.args.token,
            type: 'POST',
            data: data,
            beforeSend: function() {
                $this.find('.btn-submit').attr('disabled', 'disabled');
            },
            success: function(response) {
                $this.find('.btn-submit').removeAttr('disabled');
                $('#modal-form-new-email-template').modal('hide');
                if(response.code == 200) {
                    let item = response.item;
                    let newEmailTemplate = Mustache.render($('#tpl-email-template').html(), {
                        id: item.id,
                        title: item.title
                    });

                    $('#email-template-container').append(newEmailTemplate);
                }
            }
        });
    }

    function eventRegister() {
        $(document).on('click', '.btn-action-select-template-email', onSelectEmailTemplate);
        $(document).on('click',  '.btn-timer', onOpenPopupSetTimer);
        $(document).on('click',  '.btn-delete', onDeleteTimer);
        $('#timer-checkbox-right-now').on('change', toggleSendBtnRightNow);

        $('#form-set-timer').on('submit', onSetTimerSubmit);

        $('#form-main').on('submit', onSubmitMainForm);

        $('.btn-action-new-email-template').on('click', onOpenPopUpNewEmailTemplate);

        $('#form-new-email-template').on('submit', onSubmitNewEmailTemplate);

        $('#file-customers').on('change', function() {
            formData.append('file-customers', this.files[0]);
            this.fileSelected = true;
        });
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
/* 7 */
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
/* 8 */
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

            formData.append('spec', tinymce.get('spec').getContent());
            formData.append('content', tinymce.get('content').getContent());
            formData.append('introduce', tinymce.get('introduce').getContent());

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
/* 9 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 10 */,
/* 11 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 12 */,
/* 13 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__plugins_infica_tags_input_infica_tags_input_js__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__plugins_infica_tags_input_infica_tags_input_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__plugins_infica_tags_input_infica_tags_input_js__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__plugins_infica_tags_input_infica_tags_input_scss__ = __webpack_require__(11);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__plugins_infica_tags_input_infica_tags_input_scss___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__plugins_infica_tags_input_infica_tags_input_scss__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__less_common_less__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__less_common_less___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__less_common_less__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__plugins_unserialize_js__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__plugins_unserialize_js___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__plugins_unserialize_js__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__product_ProductAddController__ = __webpack_require__(7);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__product_ProductUpdateController__ = __webpack_require__(8);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__email_marketing_EmailMarketingAddController__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__email_marketing_EmailMarketingEditController__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__ga_GaController_js__ = __webpack_require__(6);
// Plugins







// System Product



// Email marketing



// Ga


/***/ })
/******/ ]);
//# sourceMappingURL=system.bundle.js.map