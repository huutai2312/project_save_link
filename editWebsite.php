<?php
include_once "classes/class.brain.php";

$ct = new category();
$web = new website();

if (!isset($_GET['id']) || $_GET['id'] == NULL) {
    echo "<script>window.location = './'</script>";
} else {
    $id = $_GET['id'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $link = $_POST['link'];
    $created_at = $_POST['created_at'];
    $edited_at = date('d-m-Y H:i:s');
    $category = $_POST['category'];
    $status = $_POST['status'];

    $updateWeb = $web->update_website($id, $name, $link, $created_at, $edited_at, $category, $status);
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
                                    <a href="./" class="d-block mb-2">
                                        << Home</a>
                                            <a href="#" class="noble-ui-logo logo-light d-block mb-2">Admin<span> Edit Webiste</span></a>
                                            <?php
                                            $updateCategory = $web->getwebbyId($id);
                                            if ($updateCategory) {
                                                while ($result = $updateCategory->fetch_assoc()) {
                                            ?>
                                                    <form class="forms-sample" action="" method="post">
                                                        <div class="mb-3" bis_skin_checked="1">
                                                            <label for="id" class="form-label">ID</label>
                                                            <input type="text" class="form-control input-login" id="id" placeholder="id" name="id" value="<?php echo $result['id'] ?>" readonly>
                                                        </div>
                                                        <div class="mb-3" bis_skin_checked="1">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control input-login" id="name" placeholder="name" name="name" value="<?php echo $result['name'] ?>">
                                                        </div>
                                                        <div class="mb-3" bis_skin_checked="1">
                                                            <label for="link" class="form-label">Link</label>
                                                            <input type="text" class="form-control input-login" id="link" placeholder="link" name="link" value="<?php echo $result['link'] ?>">
                                                        </div>
                                                        <div class="mb-3" bis_skin_checked="1">
                                                            <label for="created_at" class="form-label">Created_at</label>
                                                            <input type="text" class="form-control input-login" id="created_at" placeholder="created_at" name="created_at" value="<?php echo $result['created_at'] ?>" readonly>
                                                        </div>
                                                        <div class="mb-3" bis_skin_checked="1">
                                                            <label for="edited_at" class="form-label">Edited_at</label>
                                                            <input type="text" class="form-control input-login" id="edited_at" placeholder="edited_at" name="edited_at">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="category" class="form-label">Category (<?php echo $result['category'] ?>)</label>
                                                            <div class="input-group">
                                                                <select name="category" id="category" class="form-control">
                                                                    <?php
                                                                    $scate = $ct->show_category();
                                                                    foreach ($scate as $cat) {
                                                                        echo '<option value="' . $cat['name'] . '" name="' . $cat['name'] . '">' . $cat['name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Status (<?php echo $result['status'] ?>)</label>
                                                            <div class="input-group">
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="Show" name="Show">Show</option>
                                                                    <option value="Hide" name="Hide">Hide</option>
                                                                </select>
                                                            </div>
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