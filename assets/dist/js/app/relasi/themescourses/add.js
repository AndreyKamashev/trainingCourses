function loadthemes(id) {
    $('#themes option').remove();
    $.getJSON(base_url+'themescourses/getthemesId/' + id, function (data) {
        console.log(data);
        let opsi;
        $.each(data, function (key, val) {
            opsi = `
                    <option value="${val.id_themes}">${val.name_themes}</option>
                `;
            $('#themes').append(opsi);
        });
    });
}

$(document).ready(function () {
    $('[name="courses_id"]').on('change', function () {
        loadthemes($(this).val());
    });

    $('form#themescourses select').on('change', function () {
        $(this).closest('.form-group').removeClass('has-error');
        $(this).nextAll('.help-block').eq(0).text('');
    });

    $('form#themescourses').on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var btn = $('#submit');
        btn.attr('disabled', 'disabled').text('Подождите...');

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            method: 'POST',
            success: function (data) {
                btn.removeAttr('disabled').text('Save');
                console.log(data);
                if (data.status) {
                    Swal({
                        "title": "Успешно",
                        "text": "Данные успешно добавлены.",
                        "type": "success"
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = base_url+'themescourses';
                        }
                    });
                } else {
                    if (data.errors) {
                        let j;
                        $.each(data.errors, function (key, val) {
                            j = $('[name="' + key + '"]');
                            j.closest('.form-group').addClass('has-error');
                            j.nextAll('.help-block').eq(0).text(val);
                            if (val == '') {
                                j.parent().addClass('has-error');
                                j.nextAll('.help-block').eq(0).text('');
                            }
                        });
                    }
                }
            }
        });
    });
});