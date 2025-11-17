$(document).ready(function () {

    // VIEW
    $(document).on('click', '.view_data', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "process.php",
            method: "POST",
            data: { action: 'get', id: id },
            dataType: "json",
            success: function (data) {
                $('#detail').html(
                    '<p><strong>عنوان:</strong> ' + data.title + '</p>' +
                    '<p><strong>توضیح:</strong> ' + data.description + '</p>'
                );
                $('#view_modal').modal('show');
                $(".modal-title").text("نمایش رکورد");
            }
        });
    });

    // ADD
    $("#add").click(function () {
        $('#insert-form')[0].reset();
        $("#id").val("");
        $('#insert_modal').modal('show');
        $(".modal-title").text("افزودن رکورد");
    });

    // INSERT / UPDATE
    $("#insert-form").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "process.php",
            method: "POST",
            data: $('#insert-form').serialize() + "&action=create",
            dataType: "json",
            beforeSend: function () {
                $("#insert").val("در حال ارسال...");
            },
            success: function (data) {
                if (data.success) {
                    $('#insert-form')[0].reset();
                    $('#insert_modal').modal('hide');
                    location.reload();
                } else {
                    alert("خطا در ثبت اطلاعات");
                }
            }
        });
    });

    // EDIT
    $(document).on('click', '.edit_data', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "process.php",
            method: "POST",
            data: { action: 'get', id: id },
            dataType: "json",
            success: function (data) {
                $("#id").val(data.id);
                $("#title").val(data.title);
                $("#description").val(data.description);
                $('#insert_modal').modal('show');
                $(".modal-title").text("ویرایش رکورد");
            }
        });
    });

    $(document).on('click', '.delete_data', function () {
        var id = $(this).attr('id');

        $.confirm({
            title: 'هشدار!',
            content: 'آیا مطمئن هستید؟',
            buttons: {
                تایید: function () {

                    $.ajax({
                        url: "process.php",
                        method: "POST",
                        data: { action: 'delete', id: id },

                        success: function (response) {
                            console.log("Server response:", response);

                            // در صورتی که PHP خروجی دارد:
                            setTimeout(function () {
                                location.reload();
                            }, 300); // کمی تاخیر برای اعمال حذف
                        },

                        error: function (xhr, status, err) {
                            console.log("AJAX ERROR:", err);
                        }
                    });

                },
                انصراف: function () { }
            }
        });
    });



});