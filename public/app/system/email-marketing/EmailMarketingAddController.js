import Helper from '../helper/helper';
import app from '../app';

app.EmailMarketingAddController = function(args) {
    var that = this;

    that.lastEmailTemplateChangeTimer = 0;
    that.formData = {
        title: "",
        email_template_selected: []
    };

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
        $('#modal-timer').modal('show');

        that.lastEmailTemplateChangeTimer = $this.data('id');
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

        let timeString = day+'/'+month+'/'+year+' '+hour+':'+minute;
        if(now) {
            timeString = 'Ngay lập tức';
        }
        $('#selected-item-id-'+that.lastEmailTemplateChangeTimer).find('.time').text(timeString);

        that.formData.email_template_selected.push({
            id: that.lastEmailTemplateChangeTimer,
            year: year,
            month: month,
            day: day,
            hour: hour,
            minute: minute,
            now: now
        });
    }

    function onSubmitMainForm(e) {
        e.preventDefault();
        var $this = $(this);
        that.formData.title = $this.find('[name="name"]').val();

        $.ajax({
            url: "/system/email-marketing/create?_token="+args.token,
            type: "POST",
            data: that.formData
        });
    }

    function eventRegister() {
        $('.btn-action-select-template-email').on('click', onSelectEmailTemplate);
        $(document).on('click',  '.btn-timer', onOpenPopupSetTimer);
        $(document).on('click',  '.btn-delete', onDeleteTimer);
        $('#timer-checkbox-right-now').on('change', toggleSendBtnRightNow);

        $('#form-set-timer').on('submit', onSetTimerSubmit);

        $('#form-main').on('submit', onSubmitMainForm);
    }

    return {
        init: init
    }
}
