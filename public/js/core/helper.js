var Helper = {

    /**
     * Show validate error from laravel when ajax submit form
     */
    showValidateError : function(response) {
        var errors = response.responseJSON;
        for(var i in errors) {
            var error = errors[i];
            for( var j in error) {
                toastr.error(error[j], '');
            }
        }
    }
}