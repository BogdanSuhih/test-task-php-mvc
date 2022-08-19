$(document).ready(function () {
    var counter = 1;
    var res_block = $(".block_record");
    var prepared_data = new Object;
    prepared_data.records = new Array;

    $(".add_record .btn").on("click", function () {
        if (counter <= 10) {
            var button = $(this).attr("role");
            $.ajax({
                url: "http://jsonplaceholder.typicode.com/posts/" + counter++,
                dataType: "json",
                success: function (data) {
                    var r_tpl = $("#r_tpl").html();
                    r_tpl = r_tpl.replace("{TITLE}", data.title);
                    r_tpl = r_tpl.replace("{BODY}", data.body);
                    res_block.append(r_tpl);
                    data.button = button;

                    prepared_data.records.push(data);
                }
            });
        } else {
            $(this).attr("disabled", true);
        }

    });

    $("#save_button").on("click", function () {
        $.ajax({
            type:"POST",
            data: prepared_data,
            url: "addrecord",
            success: function (data) {
                alert('Данные сохранены');
                res_block.html('');
            },
            fail: function() {
                alert( "Ошибка сохранения данных" );
            }
        });
        
    });

});
