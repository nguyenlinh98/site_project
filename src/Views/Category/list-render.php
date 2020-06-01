<?php
foreach ($category as $category):
    ?>
    <tr id="category-<?php echo $category['id']; ?>">

        <td><input type="checkbox" value="<?php echo $category['id']; ?>" ></td>
        <td><?php echo $category['id']; ?></td>
        <td><?php echo $category['name']; ?></td>
        <td><?php echo $category['status'] == 1 ? "<span style=\"color: #1e7e34;\">active</span>" : "<span style=\"color: red;\">Deactive</span>"; ?></td>
        <td><?php echo $category['created_at']; ?></td>
        <td><?php echo $category['updated_at']; ?></td>
        <td class="text-center"><a href="index.php?controllers=Categories&&action=showUpdate&&id=<?php echo $category['id']; ?>" class="btn btn-info btn-sm mr-1">Edit</a>
            <!--                <a href="index.php?controllers=Categories&&action=delete&&id=--><?php //echo $category['id']; ?><!--" class="btn btn-danger btn-sm mr-1">Delete</a></td>-->

    </tr>
<?php endforeach; ?>