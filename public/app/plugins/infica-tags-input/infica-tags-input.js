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

                $this.val(get_tag_values().join(','));
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
                $(this).parents('.infica-tag-item').remove();
                options.onRemoveTag(this);
            });
        });
    }
})( jQuery );