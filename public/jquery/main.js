$(document).ready(function () {
    // button Activate
    $("#activate").click(function () {
        if(confirm("Do you want to Activate?")){
            var listId = [];
            $("input:checked").each(function (i) {
                listId[i] = $(this).val();
            })

            // remove element last, = on
            listId.pop();

            $.ajax({
                url: 'index.php?controllers=Category&action=activate',
                method : 'POST',
                data : {listId : listId},
                success: function () {
                    //$("#content-table").load(location.href + " #content-table");
                    location.reload();
                }
            });
        }
    });

    // button Deactive
    $("#deactive").click(function () {
        if(confirm("Do you want to Deactive?")){
            var listId = [];
            $("input:checked").each(function (i) {
                listId[i] = $(this).val();
            })

            // remove element last, = on
            listId.pop();

            $.ajax({
                url: 'index.php?controllers=Category&action=deactive',
                method : 'POST',
                data : {listId : listId},
                success: function () {
                    //$("#content-table").load(location.href + " #content-table");
                    location.reload();
                }
            });
        }
    });




});