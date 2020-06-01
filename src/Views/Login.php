<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/8b44ffb5f8.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../public/css/style.css" >
</head>
<body>
<div class="container">
    <div class="col-md-6 form_log">
        <form action="" method="post" class="form-sign">
            <h1> <i class="fas fa-lock-open"></i> Đăng Nhập</h1>
            <hr size="1px"color="#ecf0f1">
            <div class="form-group">
                <label for="email"> Nhập địa chỉ Email:</label>
                <input type="email"  name="email" value="<?php echo $_COOKIE["email"] ?? '' ?>" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="pwd">Nhập mật khẩu:</label>
                <input type="password" name="password" value="<?php echo $_COOKIE["email"] ?? '' ?>" class="form-control" id="pwd">
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="rememberme" <?php echo isset($_COOKIE["email"]) ? "checked" : ""; ?>> Nhớ mật khẩu</label>
            </div>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
    </div>
</div>
</body>
</html>