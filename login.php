<head>
    <link rel="shortcut icon" href="./public/assets_client/images/nobg_white.png" type="image/x-icon" />
    <link rel="stylesheet" href="./public/assets_client/vendors/core/core.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="./public/assets_client/css/demo1/darkmode.css" id="stylesheet" /> <!-- darkmode -->
</head>
<?php
include_once "classes/adminlogin.php";
$class = new adminlogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $token = $_POST['token'];
    $login_check = $class->login_admin($username, $password, $token);
}
?>

<style>
    .input-login{
        color: transparent;
    }
</style>

<div class="main-wrapper" bis_skin_checked="1">
    <div class="page-wrapper full-page" bis_skin_checked="1">
        <div class="page-content d-flex align-items-center justify-content-center" bis_skin_checked="1">
            <div class="row w-100 mx-0 auth-page" bis_skin_checked="1">
                <div class="col-md-8 col-xl-6 mx-auto" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                        <div class="row" bis_skin_checked="1">
                            <div class="col-md-12 ps-md-0" bis_skin_checked="1">
                                <div class="auth-form-wrapper px-4 py-5" bis_skin_checked="1">
                                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">Admin<span> Login</span></a>
                                    <form class="forms-sample" action="login.php" method="post">
                                        <?php
                                        if (isset($login_check)) {
                                            echo $login_check;
                                        }
                                        ?>
                                        <div class="mb-3" bis_skin_checked="1">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="password" class="form-control input-login" id="username" placeholder="Username" name="username">
                                        </div>
                                        <div class="mb-3" bis_skin_checked="1">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control input-login" id="password" placeholder="Password" name="password">
                                        </div>
                                        <div class="mb-3" bis_skin_checked="1">
                                            <label for="token" class="form-label">Token</label>
                                            <input type="password" class="form-control input-login" id="token" placeholder="Token" name="token">
                                        </div>
                                        <div bis_skin_checked="1">
                                            <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>