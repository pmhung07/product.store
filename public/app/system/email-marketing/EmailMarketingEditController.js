import Helper from '../helper/helper';
import app from '../app';

app.EmailMarketingEditController = function(args) {
    var that = this;
    that.args = args;
    that.lastEmailTemplateChangeTimer = 0;
    that.lastTimeStampChange = 0;
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

        that.lastEmailTemplateChangeTimer = $this.data('id');

        let time = $this.data('time');

        let $modalTimer = $('#modal-timer');
        $modalTimer.modal('show');

        // Gắn id vào modal để sau truy xuất ngược
        $modalTimer.attr('last-selected-id', $this.data('id'));

        if(time > 0) {
            let date = new Date(time * 1000);
            let year = date.getFullYear();
            let month = date.getMonth()+1;
            let day = date.getDate();
            let hour = date.getHours();
            let minute = date.getMinutes();

            $modalTimer.find('[name="year"]').val(year);
            $modalTimer.find('[name="month"]').val(month);
            $modalTimer.find('[name="day"]').val(day);
            $modalTimer.find('[name="hour"]').val(hour);
            $modalTimer.find('[name="minute"]').val(minute);
        }
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

        let timestamp = moment([year,month,day].join('-') + ' ' + [hour,minute].join(':')).unix();

        // Set lại timestamp để hiện cho đúng
        $('#selected-item-id-'+$('#modal-timer').attr('last-selected-id')).find('.btn-timer').data('time', timestamp);

        $('#modal-timer').modal('hide');

        let timeString = day+'/'+month+'/'+year+' '+hour+':'+minute;
        if(now) {
            timeString = 'Ngay lập tức';
            $('#selected-item-id-'+$('#modal-timer').attr('last-selected-id')).find('.btn-timer').data('time', 0);
        }
        $('#selected-item-id-'+that.lastEmailTemplateChangeTimer).find('.time').text(timeString);

        // formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][id]", that.lastEmailTemplateChangeTimer);
        // formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][year]", year);
        // formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][month]", month);
        // formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][day]", day);
        // formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][hour]", hour);
        // formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][minute]", minute);
        // formData.append("email_template_selected["+that.lastEmailTemplateChangeTimer+"][now]", now);
    }

    function onSubmitMainForm(e) {
        e.preventDefault();
        var $this = $(this);
        formData.append('name', $this.find('[name="name"]').val());
        formData.append('_token', args.token);

        if($('.email-template-selected-item').length == 0) {
            alert('Vui lòng chọn một mẫu email để tiếp tục');
            return;
        }

        $('.email-template-selected-item').each((index, el) => {
            let time = $(el).find('.btn-timer').data('time');

            if(time > 0) {
                let date = new Date(time * 1000);
                let year = date.getFullYear();
                let month = date.getMonth()+1;
                let day = date.getDate();
                let hour = date.getHours();
                let minute = date.getMinutes();

                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][id]", $(el).find('.btn-timer').data('id'));
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][year]", year);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][month]", month);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][day]", day);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][hour]", hour);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][minute]", minute);
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][now]", 'false');
            } else {
                formData.append("email_template_selected["+$(el).find('.btn-timer').data('id')+"][now]", 'true');
            }
        });

        $.ajax({
            url: "/system/email-marketing/"+that.args.campain_id+"/edit",
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
