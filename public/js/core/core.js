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
    $('.summernote').summernote({
        callbacks: {
            onImageUpload: function(files) {
                var data = new FormData();
                data.append('file', files[0]);
                data.append('_token', App.config.token);
                $.ajax({
                    url: "/ajax/upload-image",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function(response) {
                        if(response.code == 1) {
                            $('.summernote').summernote('insertImage', response.url);
                        }
                    }
                });
            }
        }
    });
});