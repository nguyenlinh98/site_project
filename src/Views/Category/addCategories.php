
<?php
include_once '../src/Views/Layouts/header.php';
?>
<h5 class="mt-4" style="color: white;background-color: #4c7095;line-height: 40px ">
    <i class="fab fa-microsoft mr-1 ml-2"></i>Category Management
</h5>
<form action="?controllers=Categories&&action=store" method="post">
    <div class="">
        <div class="form-group row">
            <label for="name" class="col-md-3">Name Category:</label>
            <input type="text" name="name" id="" class="form-control col-md-9">
        </div>
    </div>
    <div class="">
        <div class="form-group row">
            <label for="active" class="col-md-3">Active:</label>
            <div  class="col-md-9">
                 <select class="form-control" name ="status">
                     <option  value="1" class="form-control">Action</option>
                     <option  value="0" class ="form-control">Deactive</option>
                 </select>
            </div>
        </div>
    </div>
    <button type="submit" name="btnInsert" class="btn btn-primary">Add</button>

</form>
<?php
include_once '../src/Views/Layouts/footer.php';
?>