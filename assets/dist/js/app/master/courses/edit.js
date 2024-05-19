$(document).ready(function () {
    $('form#courses input').on('change', function () {
        $(this).parent('.form-group').removeClass('has-error');
        $(this).next('.help-block').text('');
    });

    $('form#courses').on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var btn = $('#submit');
        btn.attr('disabled', 'disabled').text('Подождите...');

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            method: 'POST',
            success: function (data) {
                btn.removeAttr('disabled').text('Сохранить');
                //console.log(data);
                if (data.status) {
                    Swal({
                        "title": "Успешно",
                        "text": "Данные успешно сохранены.",
                        "type": "success"
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = base_url+'courses';
                        }
                    });
                } else {
                    var j;
                    for (let i = 0; i <= data.errors.length; i++) {
                        $.each(data.errors[i], function (key, val) {
                            j = $('[name="' + key + '"]');
                            j.parent().addClass('has-error');
                            j.next('.help-block').text(val);
                            if (val == '') {
                                j.parent('.form-group').removeClass('has-error');
                                j.next('.help-block').text('');
                            }
                        });
                    }
                }
            }
        });
    });
});