<?php
include_once "classes/class.brain.php";

$ct = new website();

if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script>window.location = './'</script>";
} else {
    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $slug = $_POST['slug'];

    $updateCt = $ct->update_category($id, $name, $slug);
}
?>

<head>
    <link rel="shortcut icon" href="./public/assets_client/images/nobg_white.png" type="image/x-icon" />
    <link rel="stylesheet" href="./public/assets_client/vendors/core/core.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="./public/assets_client/css/demo1/darkmode.css" id="stylesheet" /> <!-- darkmode -->
</head>

<div class="main-wrapper" bis_skin_checked="1">
    <div class="page-wrapper full-page" bis_skin_checked="1">
        <div class="page-content d-flex align-items-center justify-content-center" bis_skin_checked="1">
            <div class="row w-100 mx-0 auth-page" bis_skin_checked="1">
                <div class="col-md-8 col-xl-6 mx-auto" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                        <div class="row" bis_skin_checked="1">
                            <div class="col-md-12 ps-md-0" bis_skin_checked="1">
                                <div class="auth-form-wrapper px-4 py-5" bis_skin_checked="1">
                                    <a href="./" class="d-block mb-2"><< Home</a>
                                    <a href="#" class="noble-ui-logo logo-light d-block mb-2">Admin<span> Edit Category</span></a>
                                    <?php
                                    $updateCategory = $ct->getcatbyId($id);
                                    if ($updateCategory) {
                                        while ($result = $updateCategory->fetch_assoc()) {
                                    ?>
                                            <form class="forms-sample" action="" method="post">
                                                <div class="mb-3" bis_skin_checked="1">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" class="form-control input-login" id="name" placeholder="name" name="name" value="<?php echo $result['name'] ?>">
                                                </div>
                                                <div class="mb-3" bis_skin_checked="1">
                                                    <label for="slug" class="form-label">Slug</label>
                                                    <input type="text" class="form-control input-login" id="slug" placeholder="slug" name="slug" value="<?php echo $result['slug'] ?>">
                                                </div>
                                                <div bis_skin_checked="1">
                                                    <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0 text-white" name="buttonUpData">Update</button>
                                                </div>
                                            </form>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>