$(document).ready(function () {

    // VIEW
    $('.view_data').click(function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "controller/select.php",
            method: "post",
            data: { id: uid },
            success: function (data) {
                $('#detail').html(data);
                $('#view_modal').modal('show');
                $(".modal-title").text("نمایش رکورد");
            }
        });
    });

    // ADD (ریست فرم هنگام باز کردن)
    $("#add").click(function () {
        $('#insert-form')[0].reset();
        $("#id").val("");
        $('#insert_modal').modal('show');
        $(".modal-title").text("افزودن رکورد");
    });
    

    // INSERT
    $("#insert-form").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "controller/insert.php",
            method: "post",
            data: $('#insert-form').serialize(),
            beforeSend: function () {
                $("#insert").val("Insert...");
            },
            success: function (data) {
                $('#insert-form')[0].reset();
                $('#insert_modal').modal('hide');
                location.reload();
            }
        });
    });

    // EDIT
    $(".edit_data").click(function () {
        var uid = $(this).attr('id');
        $.ajax({
            url: "controller/fetch.php",
            method: "post",
            data: { id: uid },
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#title").val(data.title);
                $(".modal-title").text("ویرایش رکورد");
                $("#description").val(data.description);
                $('#insert_modal').modal('show');
            }
        });
    });

    // DELETE
    $(".delete_data").click(function () {
        var uid = $(this).attr('id');
        $.confirm({
            title: 'هشدار!',
            content: 'آیا مطمئن هستید؟',
            buttons: {
                تایید: function () {
                    $.ajax({
                        url: "controller/delete.php",
                        method: "post",
                        data: { id: uid },
                        success: function (data) {
                            location.reload();
                        }
                    });
                },
                انصراف: function () { }
            }
        });
    });

});
