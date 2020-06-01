<?php
include_once '../src/Views/Layouts/header.php';
?>
<div class="ml-2" style="width: 98%; font-size: 14px;">
    <h6 class="mt-4" style="color: white;background-color: #4c7095;line-height: 40px;">
        <i class="fab fa-microsoft mr-1 ml-2"></i>&nbsp;&nbsp;User Management
    </h6>
    <a href="index.php?controllers=User&action=create" class="btn btn-primary mb-2"
       style="background-color: #4e7197; font-size: 12px;"> Add User</a>
    <table id="content-table" class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col" datatype="id">ID<span class="pull-right text-right"><i class="fa fa-sort-up"></i></span>
            </th>
            <th scope="col" datatype="name"> Name<span class="pull-right text-right"><i
                            class="fa fa-sort-up"></i></span></th>
            <th scope="col" datatype="email"> Email<span class="pull-right text-right"><i
                            class="fa fa-sort-up"></i></span></th>
            <th scope="col" datatype="status">Activate<span class="pull-right text-right"><i class="fa fa-sort-up"></i></span>
            </th>
            <th scope="col" datatype="created_at">Time Created<span class="pull-right text-right"><i
                            class="fa fa-sort-up"></i></span></th>
            <th scope="col" datatype="updated_at">Time Updated<span class="pull-right text-right"><i
                            class="fa fa-sort-up"></i></span></th>
            <th scope="col" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody id="list">
        <?php
        $users = $data["users"];
        foreach ($users as $user):
            ?>
            <tr id="user-<?php echo $user['id']; ?>">

                <td><input type="checkbox" value="<?php echo $user['id']; ?>"></td>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['status'] == 1 ? "<span style=\"color: #1e7e34;\">active</span>" : "<span style=\"color: red;\">Deactive</span>"; ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td><?php echo $user['updated_at']; ?></td>
                <td class="text-center">
                    <a href="index.php?controllers=User&&action=showUpdate&&id=<?php echo $user['id']; ?>"
                       class="btn btn-info btn-sm mr-1">Edit</a>

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <button class="btn btn-success btn-sm" id="active">Activate</button>
        <button class="btn btn-warning btn-sm" id="deactive">Deactive</button>
        <button class="btn btn-danger btn-sm" id="delete">Delete</button>
    </div>
    <div class="float-right">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <?php for ($i = 1; $i <= $data['numberPage']; $i++): ?>
                <li class="page-item <?php if ($data['page'] == $i): ?> active <?php endif; ?> "><a class="page-link"
                                                                                                    href="index.php?controllers=User&action=<?php echo $data['action']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </div>
</div>
<script>
    // button delete

    $("#delete").click(function () {
        if (confirm(" Bạn có chắc chắn muốn xóa không?")) {
            var listId = [];
            $("#content-table input:checked").each(function (i) {
                listId[i] = $(this).val();
            });

            $.ajax({
                url: 'index.php?controllers=User&action=deleteByCondition',
                type: 'post',
                data: {
                    'listId': listId
                },

                success: function ($data) {

                    if ($data == 'true') {
                        $("#content-table input:checked").each(function (i) {
                            $id = $(this).val();
                            $('#user-' + $id).remove();

                        });
                    }

                }, error: function (err) {
                    if (err != null) {
                        console.log(err);
                    }
                }
            });
        }

    });
    // button active

    $("#active").click(function () {
        if (confirm(" Bạn có chắc muốn kích hoạt tất cả tài khoản không ?")) {
            var listId = [];
            $("#content-table input:checked").each(function (i) {
                listId[i] = $(this).val();
            });

            $.ajax({
                url: 'index.php?controllers=User&action=active',
                type: 'post',
                data: {
                    'listId': listId,
                    'active': true
                },
                success: function ($data) {
                    console.log($data);
                    if ($data != 'false') {
                        $('#list').html('');
                        $('#list').append($data);
                    }

                }, error: function (err) {
                    if (err != null) {
                        console.log(err);
                    }
                }
            });
        }

    });

    $("#deactive").click(function () {
        if (confirm("Bạn có chắc muốn hủy kích hoạt tất cả tài khoản không?")) {
            var listId = [];
            $("#content-table input:checked").each(function (i) {
                listId[i] = $(this).val();
            });

            $.ajax({
                url: 'index.php?controllers=User&action=active',
                type: 'post',
                data: {
                    'listId': listId,
                    'active': false
                },
                success: function ($data) {
                    if ($data != 'false') {
                        $('#list').html('');
                        $('#list').append($data);
                    }

                }, error: function (err) {
                    if (err != null) {
                        console.log(err);
                    }
                }
            });
        }

    });
    $("th").click(function () {
        $typeSort = $(this).attr('datatype');
        $sort = 'DESC';
        $.ajax({
            url: 'index.php?controllers=User&action=sort',
            type: 'get',
            data: {
                'typeSort': $typeSort,
                'sort': $sort
            },
            success: function ($data) {

                if ($data != 'false') {
                    $('#list').html('');
                    $('#list').append($data);
                }

            }, error: function (err) {
                if (err != null) {
                    console.log(err);
                }
            }
        });


    });
</script>

<?php
include_once '../src/Views/Layouts/footer.php';
?>
