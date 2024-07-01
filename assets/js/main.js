var jsonViewer = new JSONViewer();
var global_json = 0;

$('.service').on('change', function(e) {
    e.preventDefault();

    let service = $(this).val();

    if (service === 'vclaim-dev' || service === 'vclaim') {

        $('.hide_cons_id').show();
        $('.hide_secret_key').show();
        $('.hide_user_key').show();

        let baseUrlDev = "https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev/";
        let baseUrlProd = "https://apijkn.bpjs-kesehatan.go.id/vclaim-rest/";

        if (service === 'vclaim-dev') {
            $('.url').val(baseUrlDev);
        } else {
            $('.url').val(baseUrlProd);
        }

    } else if (service === 'pcare-dev' || service === 'pcare') {

        $('.hide_cons_id').show();
        $('.hide_secret_key').show();
        $('.hide_username').show();
        $('.hide_password').show();
        $('.hide_user_key').show();

        let baseUrlDev = "https://apijkn-dev.bpjs-kesehatan.go.id/pcare-rest-dev/";
        let baseUrlProd = "https://apijkn.bpjs-kesehatan.go.id/pcare-rest/";

        if (service === 'pcare-dev') {
            $('.url').val(baseUrlDev);
        } else {
            $('.url').val(baseUrlProd);
        }

    } else if (service === 'icare-dev' || service === 'icare') {

        $('.hide_cons_id').show();
        $('.hide_secret_key').show();
        $('.hide_username').show();
        $('.hide_password').show();
        $('.hide_user_key').show();

        let baseUrlDev = "https://apijkn-dev.bpjs-kesehatan.go.id/ihs_dev/";
        let baseUrlProd = "https://apijkn.bpjs-kesehatan.go.id/wsihs/";

        if (service === 'icare-dev') {
            $('.url').val(baseUrlDev);
        } else {
            $('.url').val(baseUrlProd);
        }

    } else if (service === 'antreanfktp-dev' || service === 'antreanfktp') {

        $('.hide_cons_id').show();
        $('.hide_secret_key').show();
        $('.hide_user_key').show();

        let baseUrlDev = "https://apijkn-dev.bpjs-kesehatan.go.id/antreanfktp_dev/";
        let baseUrlProd = "https://apijkn.bpjs-kesehatan.go.id/antreanfktp/";

        if (service === 'antreanfktp-dev') {
            $('.url').val(baseUrlDev);
        } else {
            $('.url').val(baseUrlProd);
        }
    }

});

function syntaxHighlight(json) {
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

function getResponse() {
    var withParam = 0;
    if ($("#withParams").is(":checked")) {
        withParam = 1;
    }

    $.ajax({
        url: "getResponses.php",
        method: "GET",
        data: {
            "jenisAPI": $("#service").val(),
            "consid": $("#cons_id").val(),
            "secret": $("#secret_key").val(),
            "user_key": $("#user_key").val(),
            "username": $("#username").val(),
            "password": $("#password").val(),
            "method": $("#method").val(),
            "is_encrypt": 1,
            "url": $("#url").val() + $("#end_point").val(),
            "withParam": withParam,
            "params": $("#params").val(),
        },
        success: function (e) {
            global_json = e
            if (/^[\],:{}\s]*$/.test(global_json.replace(/\\["\\\/bfnrtu]/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                jsonViewer.showJSON(JSON.parse(e), null, 2);
            } else {
                global_json = '{"status":"gagal", "pesan":"URL tidak ditemukan"}';
                jsonViewer.showJSON(JSON.parse(global_json));
            }

            $("#btnSend").blur();
            $("#url").blur();
            $("#end_point").blur();
        },
        beforeSend: function () {
            $("#btnSend").html('Memuat..');
        },
        complete: function () {
            $("#btnSend").html('Kirim');
        },
    })
}

$(document).ready(function() {
    $("#jsonResponse").html(jsonViewer.getContainer());

    $('#url, #end_point').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            getResponse();
        }
    });

    $("#btnSend").click(function (e) {
        getResponse();
    })

    $('#toggle-dark-mode').click(function () {
        $('body').toggleClass('dark-mode');
        $('.navbar').toggleClass('navbar-dark-mode');
        $('.card').toggleClass('card-dark-mode');
        $('.btn-outline-secondary').toggleClass('dark-mode');
        $('.form-control').toggleClass('dark-mode');
        $('.form-floating label').toggleClass('dark-mode');
        $('.form-check-input').toggleClass('dark-mode');
        $('.input-group-text').toggleClass('dark-mode');
        $('.tempResponse').toggleClass('dark-mode');
        $('.mode').toggleClass('dark-mode');
    });

    $('#btnSaving').on('click', function() {

        let service = $('#service').val();

        if (service == '' || service == null) {
            alert('Kosong maseh!!!');
            return
        }

        const data = {
            service: $('#service').val(),
            cons_id: $('#cons_id').val(),
            secret_key: $('#secret_key').val(),
            username: $('#username').val(),
            password: $('#password').val(),
            user_key: $('#user_key').val(),
            method: $('#method').val(),
            url: $('#url').val(),
            end_point: $('#end_point').val(),
            withParams: $('#withParams').is(':checked'),
            params: $('#params').val()
        };

        $.ajax({
            url: 'helpers/saving_data.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    alert('Data saved successfully');
                    loadSavedData();
                } else {
                    alert('Error: ' + res.message);
                }
            }
        });
    });

    function loadSavedData() {
        $.ajax({
            url: 'helpers/get_data.php',
            type: 'GET',
            success: function(response) {
                const data = JSON.parse(response);
                let html = '<ul class="list-group">';
                data.forEach(item => {
                    html += `<li class="list-group-item">
                                <a href="#" class="load-data" data-filename="${item.filename}">${item.filename}</a>
                             </li>`;
                });
                html += '</ul>';
                $('#tempResponse').html(html);
            }
        });
    }

    loadSavedData();

    $('#tempResponse').on('click', '.load-data', function(e) {
        e.preventDefault();
        const filename = $(this).data('filename');

        $.getJSON('helpers/temp/' + filename, function(data) {
            $('#service').val(data.service).trigger('change');
            $('#cons_id').val(data.cons_id);
            $('#secret_key').val(data.secret_key);
            $('#username').val(data.username);
            $('#password').val(data.password);
            $('#user_key').val(data.user_key);
            $('#method').val(data.method).trigger('change');
            $('#url').val(data.url);
            $('#end_point').val(data.end_point);
            $('#withParams').prop('checked', data.withParams);
            $('#params').val(data.params);
        });
    });
    
    $('#btnDelete').on('click', function() {
        if (confirm('Yakin nggak ni pak ? Ilang semua nanti')) {
            $.ajax({
                url: 'helpers/delete_data.php',
                type: 'POST',
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        alert('All files deleted successfully');
                        loadSavedData();
                    } else {
                        alert('Error: ' + res.message);
                    }
                }
            });
        }
    });
    
    $("#btnDetailData").click(function (e) {
        let behavior = $('#behavior').val();
        
        if (behavior == '0') {
            $("#jsonResponseModal").html(jsonViewer.getContainer());
        } else {
            $("#jsonResponseModal").html(syntaxHighlight(JSON.stringify(JSON.parse(global_json), null, 4)));
        }
        $("#modalJSON").modal('show');
    });

    $('.btnScreenshoot').on('click', function() {
        let modalContent = document.getElementById('modalJSON');
    
        html2canvas(modalContent).then(canvas => {
            let screenshotURL = canvas.toDataURL('image/png');
    
            let downloadLink = document.createElement('a');
            downloadLink.href = screenshotURL;
            downloadLink.download = 'screenshot.png';
            downloadLink.click();
        });
    });
    

});