<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include_once "classes/class.brain.php";
include_once "config/session.php";
Session::checkSession();
// ===============================
$ct = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buttonUpData'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $insertCt = $ct->insert_category($name, $slug);
}
if (isset($_GET['deleteCategoryid'])) {
    $id = $_GET['deleteCategoryid'];
    $delcat = $ct->del_category($id);
}
// ===============================
$web = new website();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buttonUpDataWebsite'])) {
    $name = $_POST['name'];
    $link = $_POST['link'];
    $created_at = date('d-m-Y H:i:s');
    $category = $_POST['category'];
    $status = $_POST['status'];
    $insertWeb = $web->insert_website($name, $link, $created_at, $category, $status);
}
if (isset($_GET['deleteWebsiteid'])) {
    $id = $_GET['deleteWebsiteid'];
    $delweb = $web->del_website($id);
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Multitab" />
    <meta name="keywords" content="nht, NHT, nht code free, code free, source code free, html css js nht, code nht " />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Multitab" />
    <meta property="og:url" content="" />
    <meta property="og:description" content="Multitab" />
    <link rel="shortcut icon" href="./public/assets_client/images/nobg_white.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="./public/assets_client/images/nobg_white.png">
    <link rel="stylesheet" href="./public/assets_client/vendors/core/core.css" />
    <link rel="stylesheet" href="./public/assets_client/vendors/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="./public/assets_client/fonts/feather-font/css/iconfont.css" />
    <link rel="stylesheet" href="./public/assets_client/css/demo1/scrollbar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="./public/assets_client/css/demo1/darkmode.css" id="stylesheet" /> <!-- darkmode -->
    <!-- ====================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./public/assets_client/vendors/core/core.js"></script>
    <script src="./public/assets_client/vendors/sweetalert2/sweetalert2.min.js"></script>
    <script src="./public/assets_client/vendors/feather-icons/feather.min.js"></script>
    <script src="./public/assets_client/js/template.js"></script>
    <!-- ====================================================== -->
    <title>Home</title>
</head>

<body>
    <div class="main-wrapper">
        <!-- ==========SIDEBAR========== -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="./" style="margin-bottom: -10px" class="sidebar-brand" aria-label="Logo">
                    <span><img src="public/assets_client/images/nobg_white.png" alt="" style="width: 100px;"></span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="./" class="nav-link">
                            <i data-feather="command" style="outline: none; width: 15px"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <?php
                    $ct = new category();
                    $categories = $ct->show_category();

                    foreach ($categories as $category) {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link collapsed" data-bs-toggle="collapse" href="#' . $category['slug'] . '" role="button" aria-expanded="false" aria-controls="' . $category['slug'] . '">';
                        echo '<i data-feather="folder" style="outline: none; width: 15px"></i>';
                        echo '<span class="link-title">' . $category['name'] . '</span>';
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down link-arrow">';
                        echo '<polyline points="6 9 12 15 18 9"></polyline>';
                        echo '</svg>';
                        echo '</a>';

                        echo '<div class="collapse" id="' . $category['slug'] . '" bis_skin_checked="1" style="">';
                        echo '<ul class="nav sub-menu">';

                        // Lấy bài viết theo danh mục và hiển thị với status là Show
                        $websites = $web->show_website_by_category($category['name']);
                        if (!empty($websites)) {
                            foreach ($websites as $website) {
                                if ($website['status'] == 'Show') {
                                    echo '<li class="nav-item">';
                                    echo '<a href="' . $website['link'] . '" class="nav-link">' . $website['name'] . '</a>';
                                    echo '</li>';
                                }
                            }
                        } else {
                            echo '<li class="nav-item">';
                            echo '<span class="nav-link">Chưa có web</span>';
                            echo '</li>';
                        }

                        echo '</ul>';
                        echo '</div>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>

        </nav>
        <!-- ==========SIDEBAR========== -->
        <div class="page-wrapper">
            <!-- ==========TOPBAR========== -->

            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                                Session::destroy();
                            }
                            ?>
                            <a class="dropdown-item" href="?action=logout">
                                <i class="dripicons-exit text-muted mr-2"></i> Logout </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="file" style="outline: none;"></i>
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown" style="outline: none;">
                                <div class="p-1">
                                    <div class="dropdown-item d-flex align-items-center py-2">
                                        <div class="flex-grow-1 me-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                            <a>Add category</a>
                                        </div>
                                    </div>
                                    <div class="dropdown-item d-flex align-items-center py-2">
                                        <div class="flex-grow-1 me-2" data-bs-toggle="modal" data-bs-target="#listCategoryModal">
                                            <a>List category</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="edit" style="outline: none;"></i>
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown" style="outline: none;">
                                <div class="p-1">
                                    <div class="dropdown-item d-flex align-items-center py-2">
                                        <div class="flex-grow-1 me-2" data-bs-toggle="modal" data-bs-target="#addWebsiteModal">
                                            <a>Add website</a>
                                        </div>
                                    </div>
                                    <div class="dropdown-item d-flex align-items-center py-2">
                                        <div class="flex-grow-1 me-2" data-bs-toggle="modal" data-bs-target="#listWebsiteModal">
                                            <a>List website</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>



            <!-- ==========TOPBAR========== -->


            <div class="page-content">