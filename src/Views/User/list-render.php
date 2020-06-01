<?php
foreach ($users as $user):
    ?>
    <tr id="category-<?php echo $user['id']; ?>">

        <td><input type="checkbox" value="<?php echo $user['id']; ?>" ></td>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['name']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['status'] == 1 ? "<span style=\"color: #1e7e34;\">active</span>" : "<span style=\"color: red;\">Deactive</span>"; ?></td>
        <td><?php echo $user['created_at']; ?></td>
        <td><?php echo $user['updated_at']; ?></td>
        <td class="text-center"><a href="index.php?controllers=Categories&&action=showUpdate&&id=<?php echo $user['id']; ?>" class="btn btn-info btn-sm mr-1">Edit</a>
            <!--                <a href="index.php?controllers=Categories&&action=delete&&id=--><?php //echo $category['id']; ?><!--" class="btn btn-danger btn-sm mr-1">Delete</a></td>-->

    </tr>
<?php endforeach; ?>