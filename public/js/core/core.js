///// PLUGIN
(function( $ ) {

    // Ajax load district
    $.fn.ajaxLoadDistrict = function(options) {
        var _default = {};
        options = $.extend(_default, options);

        return this.each(function() {
            $(this).on('change', function() {
                $.ajax({
                    url: '/ajax/province/' + $(this).val() + '/districts',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var items = response.data;
                        $(options.observers).find('.option').remove();
                        for(var i in items) {
                            $(options.observers).append('<option class="option" value="'+ items[i].id +'">'+ items[i].name +'</option>');
                        }
                    }
                });
            });
        });
    }



    // Tag input
    $.fn.inficaTagsInput = function(options) {
        var _default = {
            width: '100%',
            height: 90,
            items: []
        };
        options = $.extend(_default, options);
        return this.each(function() {
            var $this = $(this);

            var tagItemsId = [];

            var $container = $('div').attr({
                class : 'infica-tags-input-container',
                width: options.width,
                height: options.height
            });

            var items = options.items;
            for(var i = 0; i < items.length; i ++) {
                var item = items[i];

                var $item = $('span').attr({
                        class: 'infica-tag-item',
                        'data-id' : item.id,
                        'data-label': item.label
                });

                $container.append($item);

                tagItemsId.push(item.id);
            }
        });
    }
})( jQuery );



$(function() {
    // $('.summernote').summernote({
    //     callbacks: {
    //         onImageUpload: function(files) {
    //             var data = new FormData();
    //             data.append('file', files[0]);
    //             data.append('_token', App.config.token);

    //             var $editor = $(this);

    //             $.ajax({
    //                 url: "/ajax/upload-image",
    //                 type: "POST",
    //                 cache: false,
    //                 contentType: false,
    //                 processData: false,
    //                 data: data,
    //                 success: function(response) {
    //                     if(response.code == 1) {
    //                         $editor.summernote('insertImage', response.url);
    //                     }
    //                 }
    //             });
    //         }
    //     }
    // });

    $('.btn-delete-action').click(function() {
        return confirm("Bạn có chắc chắn muốn xóa bản ghi này?");
    });

    $('.btn-active-action')
       .click(function(e) {
          e.preventDefault();
          var $this = $(this);
          $.ajax({
             url : $this.attr('href'),
             type : 'GET',
             dataType : 'json',
             beforeSend: function() {
                // initSpin();
             },
             success : function(data) {

                $(document).trigger('action_active_success');

                // stopSpin();
                if(data.code === 1) {
                   var _btn = $this.find('i');
                   if(data.status == 1) {
                      $this.html('<i class="fa fa-check-square fa-2x"></i>');
                   }else{
                      $this.html('<i class="fa fa-square-o fa-2x"></i>');
                   }
                }else{
                   alert(data.message);
                }
             }
          })
       });

    $('img').on('error', function() {
        var $this = $(this);
        $this.attr('src', '/img/default_picture.png');
    });


    $('.date-picker').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd/mm/yyyy'
    });
});


// TinyMCE - Config
tinymce.init({
    selector: ".tiny-editor",
    theme: "modern",
    width: '100%',
    height: 300,
    // ===========================================
    // INCLUDE THE PLUGIN
    // ===========================================
    plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample jbimages'
    ],

    // ===========================================
    // PUT PLUGIN'S BUTTON on the toolbar
    // ===========================================
    toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages',
    toolbar2: 'print preview media | fontsizeselect fontselect forecolor backcolor emoticons | codesample',


    // ===========================================
    // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
    // ===========================================

    fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 20pt 24pt 36pt',

    font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times;ElleFuturaBook=ElleFuturaBook',

    relative_urls: false,

    image_advtab: true
});