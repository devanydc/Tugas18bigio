function let_says($text){
    var $name = $("#name").val();
    var $nim = $("#nim").val();
    appendQuestion($text);
    post_data($text,$name,$nim);
    $("div, card-body").animate({
        scrollTop: 9000
    }, "fast");
}

function filterize($text){
    $text = $text.replace(/</g, "&lt;");
    $text = $text.replace(/>/g, "&gt;");
    $text = $text.replace('"', "&quot;");
    $text = $text.replace("'", "&#039;");
return $text;
}

function getdate(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    var hour = addZero(today.getHours());
    var minutes = addZero(today.getMinutes());
    var seconds = addZero(today.getSeconds());

    $today = dd + '-' + mm + '-' + yyyy + '  (' + hour + ':' + minutes + ':' + seconds +')';
    return $today;
}

function post_data($keyword, $name, $nim) {
    var xhttp = new XMLHttpRequest();

    xhttp.open("POST", "fungsi.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onload = function() {
        appendAnswer(xhttp.responseText);
    }
    xhttp.send("keyword=" + $keyword + "&name=" + $name + "&nim=" + $nim);
}

function appendQuestion($keyword){
    $today = getdate();
    $("#card-body").append(`
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="card bg-primary text-white chatbaloon" style="border-radius:20px;">
                    <div class="card-body">
                        <div class="font-weight-bold">You : </div>
                        <div>
                            <small class="text-white">`+ $today +`</small>
                        </div>
                        <div style="margin-top:8px">
                            <p class="card-text">` + $keyword + `</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `);
}

function appendAnswer($response) {
    $today = getdate();
    $("#card-body").append(`
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-6">
                    <div class="card bg-white text-black chatbaloon" style="border-radius:20px;">
                        <div class="card-body">
                            <div class="font-weight-bold">Chatbot : </div>
                            <div>
                                <small class="text-black">`+ $today +`</small>
                            </div>
                            <div style="margin-top:8px">` + $response + `</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6"></div>
            `);
}

function addZero(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
}

function submit() {
    var text_max = 100;
    // kirim data jika klik tombol kirim
    var $keyword = filterize($("#keyword").val());
    var $name = $("#name").val();
    var $nim = $("#nim").val();
    
    if ($keyword) {
        if($("#keyword").val().length > text_max)
        {
            appendQuestion($keyword);
            post_data($keyword.slice(0, text_max), $name, $nim);
            $("#keyword").val("");

        }else{
            appendQuestion($keyword);
            post_data($keyword, $name, $nim);
            $("#keyword").val("");

        }
        $("div, card-body").animate({
            scrollTop: 9000
        }, "fast");
        $("#keyword").val("");
    }
}

window.onload = function() {
    var text_max = 100;
    $('#count_message').html(0 + ' / ' + text_max);

    // Kirim data setelah menekan tombol enter
    document.getElementById('keyword').onkeypress = function searchKeyPress(event) {
        var $keyword = filterize($("#keyword").val());
        var $name = $("#name").val();
        var $nim = $("#nim").val();

        if (event.keyCode == 13) {
            if ($keyword) {
                if($("#keyword").val().length > text_max)
                {
                    appendQuestion($keyword);
                    post_data($keyword.slice(0, text_max), $name, $nim);
                    $("#keyword").val("");

                }else{
                    appendQuestion($keyword);
                    post_data($keyword, $name, $nim);
                    $("#keyword").val("");

                }
                $("div, card-body").animate({
                    scrollTop: 9000
                }, "fast");
                $("#keyword").val("");
            }
        }
    };

    // Info jumlah karakter pada input text
    $('#keyword').keyup(function() {
        var text_length = $('#keyword').val().length;
        $('#count_message').html(text_length + ' / ' + text_max);

        if ($(this).val().length>=text_max) {
          if ($(this).data('warning')) return;
          $(this).attr('title','Jumlah maksimal '+text_max+' karakter');
          $(this).tooltip('show');
          $(this).data('warning', true);
        } else {
            if ($(this).data('warning')) {
               $(this).tooltip('hide');       
               $(this).data('warning', false);                  
            }    
        }
     });
}
