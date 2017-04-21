///// PLUGIN
(function( $ ) {
    /**
     * Add to cart
     * @param integer product_id
     * @param integer qty
     */
    $.fn.addToCart = function(options) {

        var _default = {};
        options = $.extend(_default, options);

        return this.each(function() {
            $(this).on('click', function(e) {
                e.preventDefault();
                var url = '/cart/add-to-cart?product_id='+ options.product_id +'&qty=' + options.qty;
                window.location.href = url;
            });
        });
    }
})( jQuery );
