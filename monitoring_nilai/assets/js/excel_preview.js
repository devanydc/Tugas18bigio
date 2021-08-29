function show_data(datas) {
    $("#data-preview").html(`
            <div class="font-weight-bold mb-3"> <h4>[Preview 5 data pertama]</h4> </div>
            <table class="table table-bordered table-hover" id="table-master">
                <thead class="text-center text-white bg-primary">
                    <tr>
                        <th class="w-3">#</th>
                        <th class="w-22">Kata Kunci</th>
                        <th class="w-75">Respon Chatbots</th>
                    </tr>
                </thead>
                <tbody>
                ` + datas +`
                </tbody>
            </table>
            `);
}

function post_data() {
    var xhttp = new XMLHttpRequest();
    var formData = new FormData();
    var pdfFile = document.getElementById("file").files[0];

    formData.append('filePdf', pdfFile);
    xhttp.open("POST", "../admin/master_preview_excel.php", true);

    xhttp.onload = function() {
        show_data(xhttp.responseText);
    }

    xhttp.onerror = function () {
        var error = "ERROR"
        show_data(error);
      };
    xhttp.send(formData);
}