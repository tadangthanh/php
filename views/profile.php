<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <title>User Profile</title>
    <link rel="stylesheet" 
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<?php
session_start();
if($_SESSION['role']!="ADMIN"&&$_SESSION['role']!="USER"){
    header("Location: login.php?err=vui lòng đăng nhập!");
}
?>
<body>
    <div class="profile-container">
        <a href="../views/home-news.php?offset=1&limit=2"><i class="fa-solid fa-backward"></i> Quay lại trang chủ</a>
        <h1>User Profile</h1>
        <div class="profile-info">
            <label>Username:</label>
            <span><?php echo $_SESSION['username']  ?></span>

            <form action="../xulyform/update-profile.php" method="post">
                <label for="email">EMAIL:</label>
                <input type="email" id="email" name="email" value=" <?php echo $_SESSION['email'] ?>" required>

                <label for="password">NEW PASSWORD:</label>
                <input type="password" id="password" name="password" placeholder="*********">
                <label for="password">RE-TYPE NEW PASSWORD:</label>
                <input type="password" id="re-password" name="re-password" placeholder="*********">
                <label>Created at:</label>
                <span><?php echo $_SESSION['created_at'] ?></span>

                <label>Role:</label>
                <span><?php echo $_SESSION['role']  ?></span>
                <br>
               
                <button name="update" type="submit" onclick="checkPasswords()"value="update">Cập nhật</button>
            </form>
        </div>
    </div>
</body>
<script>
        function checkPasswords() {
            var newPassword = document.getElementById('password').value;
            var reTypedPassword = document.getElementById('re-password').value;
            if (newPassword === reTypedPassword) {
                document.getElementById('update').submit();
            } else {
                alert('Mật khẩu nhập lại không khớp với mật khẩu mới.');
                document.getElementById('password').value = '';
                document.getElementById('re-password').value = '';
                document.getElementById('password').blur();
            }
        }
    </script>
</html>
