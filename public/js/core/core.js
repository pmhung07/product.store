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