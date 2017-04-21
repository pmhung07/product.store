///// PLUGIN
(function( $ ) {
    $.fn.loadDistricts = function(options) {

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
})( jQuery );