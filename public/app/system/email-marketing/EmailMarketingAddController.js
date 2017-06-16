import Helper from '../helper/helper';
import app from '../app';

app.EmailMarketingAddController = function(args) {
    var that = this;
    function init() {
        // Register all events with the handle
        eventRegister();
    }

    function onChangeTimer(e) {
        e.preventDefault();
        $('#modal-timer').modal('show');
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

    function eventRegister() {
        $(document).on('click',  '.btn-timer', onChangeTimer);
        $(document).on('click',  '.btn-delete', onDeleteTimer);
        $('#timer-checkbox-right-now').on('change', toggleSendBtnRightNow);
    }

    return {
        init: init
    }
}
