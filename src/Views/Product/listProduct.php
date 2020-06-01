
<?php
include_once '../src/Views/Layouts/header.php';
?>
<div class="ml-2" style="width: 98%; font-size: 14px;">
    <h6 class="mt-4" style="color: white;background-color: #4c7095;line-height: 40px;">
        <i class="fab fa-microsoft mr-1 ml-2"></i>&nbsp;&nbsp;User Management
    </h6>
    <a href="index.php?controllers=Product&action=create" class="btn btn-primary mb-2" style="background-color: #4e7197; font-size: 12px;"> Add User</a>
    <table id="content-table" class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col"> Name</th>
            <th scope="col"> Price</th>
            <th scope="col">Activate</th>
            <th scope="col">Time Created</th>
            <th scope="col">Time Updated</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $products = $data["products"];
        foreach ($products as $product):
            ?>
            <tr>

                <td><input type="checkbox" value="<?php echo $product['id']; ?>"></td>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['status'] == 1 ? "<span style=\"color: #1e7e34;\">active</span>" : "<span style=\"color: red;\">Deactive</span>"; ?></td>
                <td><?php echo $product['created_at']; ?></td>
                <td><?php echo $product['updated_at']; ?></td>
                <td class="text-center"><a href="index.php?controllers=Product&&action=showUpdate&&id=<?php echo $product['id']; ?>" class="btn btn-info btn-sm mr-1">Edit</a>
                    <a href="index.php?controllers=Product&&action=delete&&id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm mr-1">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <button class="btn btn-success btn-sm" id="activate">Activate</button>
        <button class="btn btn-warning btn-sm" id="deactive">Deactive</button>
        <button class="btn btn-danger btn-sm" id="delete">Delete</button>
    </div>
    <div class="float-right">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <?php for ($i = 1; $i <= $data['numberPage']; $i++): ?>
                <li class="page-item <?php if ($data['page'] == $i): ?> active <?php endif; ?> "><a class="page-link" href="index.php?controllers=Product&action=<?php echo $data['action']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </div>
</div>
<script>
    // button delete

    $("#delete").click(function () {
        if(confirm(" Bạn có chắc chắn muốn xóa không?")){
            var listId =[];
            $("#content-table input:checked").each(function(i) {
                listId[i] = $(this).val();
            });

            $.ajax({
                url: 'index.php?controllers=Product&action=deleteByCondition',
                type : 'post',
                data : {
                    'listId' : listId
                },
                success: function ($data) {

                    if ($data == 'true')
                    {
                        $("#content-table input:checked").each(function(i) {
                            $id = $(this).val();
                            $('#category-'+$id).remove();
                        });
                    }


                },error:function (err) {
                    if(err != null){
                        console.log(err);
                    }
                }
            });
        }

    });
    // button active

    $("#active").click(function () {
        if(confirm(" Bạn có chắc muốn hủy kích hoạt?")){
            var listId =[];
            $("#content-table input:checked").each(function(i) {
                listId[i] = $(this).val();
            });

            $.ajax({
                url: 'index.php?controllers=Categories&action=active',
                type : 'post',
                data : {
                    'listId' : listId,
                    'active' : true
                },
                success: function ($data) {
                    if ($data != 'false')
                    {
                        $('#list').html('');
                        $('#list').append($data);
                    }

                },error:function (err) {
                    if(err != null){
                        console.log(err);
                    }
                }
            });
        }

    });

    $("#deactive").click(function () {
        if(confirm(" Bạn có chắc muốn hủy kích hoạt?")){
            var listId =[];
            $("#content-table input:checked").each(function(i) {
                listId[i] = $(this).val();
            });

            $.ajax({
                url: 'index.php?controllers=Categories&action=active',
                type : 'post',
                data : {
                    'listId' : listId,
                    'active' : false
                },
                success: function ($data) {
                    if ($data != 'false')
                    {
                        $('#list').html('');
                        $('#list').append($data);
                    }

                },error:function (err) {
                    if(err != null){
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
            url: 'index.php?controllers=Categories&action=sort',
            type : 'get',
            data : {
                'typeSort' : $typeSort,
                'sort' : $sort
            },
            success: function ($data) {

                if ($data != 'false')
                {
                    $('#list').html('');
                    $('#list').append($data);
                }

            },error:function (err) {
                if(err != null){
                    console.log(err);
                }
            }
        });


    });
</script>
<?php
include_once '../src/Views/Layouts/footer.php';
?>

