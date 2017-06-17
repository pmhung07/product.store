import Helper from '../helper/helper';
import app from '../app';

app.EmailMarketingAddController = function(args) {
    var that = this;
    that.args = args;
    that.lastEmailTemplateChangeTimer = 0;
    that.formData = {
        title: "",
        email_template_selected: {}
    };

    const formData = new FormData();

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

        // that.formData.email_template_selected[that.lastEmailTemplateChangeTimer] = {
        //     id: that.lastEmailTemplateChangeTimer,
        //     year: year,
        //     month: month,
        //     day: day,
        //     hour: hour,
        //     minute: minute,
        //     now: now
        // };

        formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][id]", that.lastEmailTemplateChangeTimer);
        formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][year]", year);
        formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][month]", month);
        formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][day]", day);
        formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][hour]", hour);
        formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][minute]", minute);
        formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][now]", now);
    }

    function onSubmitMainForm(e) {
        e.preventDefault();
        var $this = $(this);
        formData.append('name', $this.find('[name="name"]').val());
        formData.append('_token', args.token);

        $.ajax({
            url: "/system/email-marketing/create",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false
        });
    }

    function onOpenPopUpNewEmailTemplate(e) {
        e.preventDefault();
        var $this = $(this);
        $('#modal-form-new-email-template').modal('show');
    }

    function onSubmitNewEmailTemplate(e) {
        e.preventDefault();
        var $this = $(this);

        let data = $.unserialize($this.serialize());
        data.content = tinymce.get('tiny-editor-new-email-template').getContent();

        $.ajax({
            url: '/system/email-template/create?_token='+that.args.token,
            type: 'POST',
            data: data,
            beforeSend: function() {
                $this.find('.btn-submit').attr('disabled', 'disabled');
            },
            success: function(response) {
                $this.find('.btn-submit').removeAttr('disabled');
                $('#modal-form-new-email-template').modal('hide');
                if(response.code == 200) {
                    let item = response.item;
                    let newEmailTemplate = Mustache.render($('#tpl-email-template').html(), {
                        id: item.id,
                        title: item.title
                    });

                    $('#email-template-container').append(newEmailTemplate);
                }
            }
        });
    }

    function eventRegister() {
        $(document).on('click', '.btn-action-select-template-email', onSelectEmailTemplate);
        $(document).on('click',  '.btn-timer', onOpenPopupSetTimer);
        $(document).on('click',  '.btn-delete', onDeleteTimer);
        $('#timer-checkbox-right-now').on('change', toggleSendBtnRightNow);

        $('#form-set-timer').on('submit', onSetTimerSubmit);

        $('#form-main').on('submit', onSubmitMainForm);

        $('.btn-action-new-email-template').on('click', onOpenPopUpNewEmailTemplate);

        $('#form-new-email-template').on('submit', onSubmitNewEmailTemplate);

        $('#file-customers').on('change', function() {
            formData.append('file-customers', this.files[0]);
        });
    }

    return {
        init: init
    }
}
