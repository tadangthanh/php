<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-color: #ccc;">
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <?php
                            $url = "";
                            if (isset($_REQUEST['register'])) {
                                $url = "../xulyform/handle-login.php?register=true";
                            } else {
                                $url = "../xulyform/handle-login.php?login=true";
                            }
                            ?>
                            <form action="<?php echo $url ?>" method="post">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="username..." />
                                        <?php
                                        if (isset($_REQUEST['err'])) {
                                            echo $_REQUEST['err'];
                                        }
                                        ?>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="password" name="password" placeholder="password..." class="form-control form-control-lg" />
                                    </div>
                                    <?php
                                    if (isset($_REQUEST['permission'])) {
                                        echo $_REQUEST['permission'];
                                    }
                                    if (isset($_REQUEST['register'])) {
                                        echo
                                        "
                                        <div class=\"form-outline form-white mb-4\">
                                        <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"nhập lại password...\" class=\"form-control form-control-lg\" />
                                        </div>
                                        <div class=\"form-outline form-white mb-4\">
                                        <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"nhập email...\" class=\"form-control form-control-lg\" />
                                        </div>
                                    <input class=\"btn btn-outline-light btn-lg px-5 mb-3\" type=\"submit\" name=\"register\" value=\"Đăng ký\"></input> <br>
                                        ";
                                    } else {
                                        echo "<input class=\"btn btn-outline-light btn-lg px-5 mb-3\" name=\"login\" type=\"submit\" value=\"Đăng nhập\"></input> <br>";
                                    }
                                    if (!isset($_REQUEST['register'])) {
                                        echo "Bạn chưa có tài khoản? <a href=\"login.php?register=true\">Đăng kí ngay</a>";
                                    } else {
                                        echo "<a href=\"login.php\">Quay trở về trang đăng nhập</a>";
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>