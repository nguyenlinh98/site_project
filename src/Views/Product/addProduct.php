<?php
include_once '../src/Views/Layouts/header.php';
?>
<h5 class="mt-4" style="color: white;background-color: #4c7095;line-height: 40px ">
    <i class="fab fa-microsoft mr-1 ml-2"></i>Products Management
</h5>
<form action="?controllers=Product&action=store" method="post" enctype="multipart/form-data">
    <div class="">
        <div class="form-group row">
            <label for="name" class="col-md-3">Name Product:</label>
            <input type="text" name="name" id="" class="form-control col-md-9">
        </div>
    </div>
    <div class="">
        <div class="form-group row">
            <label for="price" class="col-md-3">Price:</label>
            <input type="text" name="price" class="form-control col-md-9">
        </div>
    </div>
    <div class="">
        <div class="form-group row">
            <label for="Description:" class="col-md-3">Desription:</label>
            <textarea cols="10" rows="4" class="form-control col-md-9" name="description"></textarea>
        </div>
    </div>
    <div class="">
        <div class="form-group row">
            <label for="image" class="col-md-3">Images:</label>
            <div  class=" col-md-9">
                <input type="file" name="img">
            </div>
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
    <button type="submit" class="btn btn-primary">Add</button>

</form>
<?php
include_once '../src/Views/Layouts/footer.php';
?>