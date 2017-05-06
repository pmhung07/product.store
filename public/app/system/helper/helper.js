var Helper = {

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