<?php
include_once '../src/Views/Layouts/header.php';
?>
<h5 class="mt-4" style="color: white;background-color: #4c7095;line-height: 40px ">
    <i class="fab fa-microsoft mr-1 ml-2"></i>User Management
</h5>
<div class="container">
    <form action="?controllers=User&&action=update&&id=<?php  echo $result['id'];?>" method="post">
        <div class="">
            <div class="form-group row">
                <label for="name" class="col-md-3">Id:</label>
                <input type="text" name="id" id="" value="<?php echo $result['id'];?>" class="form-control col-md-9">
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-3">Name Category:</label>
                <input type="text" name="name" id="" value="<?php echo $result['name'];?>" class="form-control col-md-9">
            </div>
        </div>
        <div class="">
            <div class="form-group row">
                <label for="active" class="col-md-3">Active:</label>
                <div  class="col-md-9">
                    <select class="form-control" name ="status">
                        <option  <?php if ($result['status'] == 1 ) echo 'selected' ; ?> value="1">Active</option>
                        <option  <?php if ($result['status'] == 0 ) echo 'selected' ; ?> value="0">Deactive</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>

    </form>
</div>
<?php
include_once '../src/Views/Layouts/footer.php';
?>
