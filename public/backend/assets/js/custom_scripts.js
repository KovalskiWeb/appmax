$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // AJAX RESPONSE
    var ajaxResponseBaseTime = 3;

    function ajaxMessage(message, time) {
        var ajaxMessage = $(message);

        ajaxMessage.append("<div class='message_time'></div>");
        ajaxMessage.find(".message_time").animate({ "width": "100%" }, time * 1000, function() {
            $(this).parents(".message").fadeOut(200);
        });

        $(".ajax_response").append(ajaxMessage);
    }

    // AJAX RESPONSE MONITOR
    $(".ajax_response .message").each(function(e, m) {
        ajaxMessage(m, ajaxResponseBaseTime += 1);
    });

    // AJAX MESSAGE CLOSE ON CLICK
    $(".ajax_response").on("click", ".message", function(e) {
        $(this).fadeOut();
    });

    // FORMS
    $('form[name="login"]').submit(function(event) {
        event.preventDefault();

        const form = $(this);
        const action = form.attr('action');
        const email = form.find('input[name="email"]').val();
        const password = form.find('input[name="password_check"]').val();

        $.post(action, { email: email, password: password }, function(response) {
            if (response.message) {
                ajaxMessage(response.message, 3);
            }

            if (response.redirect) {
                window.location.href = response.redirect;
            }
        }, 'json');
    });

    $("form:not('.ajax_off')").submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var erros = '';

        if (typeof tinyMCE !== 'undefined') {
            tinyMCE.triggerSave();
        }

        form.ajaxSubmit({
            url: form.attr("action"),
            type: form.attr("data-type"),
            dataType: "json",
            success: function(response) {
                //redirect
                // if (response.redirect) {
                //     window.location.href = response.redirect;
                // } else {
                //     form.find("input[type='file']").val(null);
                //     load.fadeOut(200);
                // }

                //reload
                // if (response.reload) {
                //     window.location.reload();
                // } else {
                //     load.fadeOut(200);
                // }

                //request
                if (response.request && response.status == 'update') {
                    One.helpers('notify', { type: 'success', icon: 'fa fa-check mr-1', message: 'Dados atualizados com sucesso!' });
                }

                if (response.request && response.status == 'create') {
                    if (response.message) {
                        One.helpers('notify', { type: 'danger', icon: 'fa fa-check mr-1', message: response.message });
                    } else {
                        window.location.href = response.redirect;
                    }
                }

                //image by fsphp mce upload
                // if (response.mce_image) {
                //     $('.mce_upload').fadeOut(200);
                //     tinyMCE.activeEditor.insertContent(response.mce_image);
                // }
            },
            error: function(response) {
                // ajaxMessage("<div class='message error'>" + response.responseJSON['errors']['title'][0] + "</div>", 5);
                // One.helpers('notify', { type: 'danger', icon: 'fa fa-times mr-1', message: response.responseJSON.errors[0] });

                console.log(response);

                if (response.statusText) {
                    if (response.responseJSON.errors) {
                        $.each(response.responseJSON.errors, function(key, value) {
                            // $('#err').append(key + ": " + value + "<br>");
                            // console.log(value[0]);
                            One.helpers('notify', { type: 'danger', icon: 'fa fa-times mr-1', message: value[0] });
                        });
                    } else {
                        One.helpers('notify', { type: 'danger', icon: 'fa fa-times mr-1', message: 'Erro interno! Por favor, entre em contato com o suporte do sistema!' });
                    }
                }
            }
        });
    });
});