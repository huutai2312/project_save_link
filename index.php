<?php
include_once __DIR__ . "/inc/header.client.php";
?>
<?php
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


<div class="row" bis_skin_checked="1">
    <div class="col-md-6 grid-margin stretch-card" bis_skin_checked="1">
        <div class="card" bis_skin_checked="1">
            <div class="card-body" bis_skin_checked="1">
                <h6 class="card-title">ADD CATEGORY</h6>
                <?php
                if (isset($insertTp)) {
                    echo $insertTp;
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug">
                    </div>
                    <button type="submit" class="btn btn-inverse-success" name="buttonUpData">Add</button>
                    <button class="btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ====================================== -->
    <div class="col-md-6 grid-margin stretch-card" bis_skin_checked="1">
        <div class="card" bis_skin_checked="1">
            <div class="card-body" bis_skin_checked="1">

                <h6 class="card-title">ADD WEBSITE</h6>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="text" class="form-control" id="link" placeholder="Link" name="link" onblur="fetchTitle()">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="title" placeholder="Name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
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
                        <label for="status" class="form-label">Status</label>
                        <div class="input-group">
                            <select name="status" id="status" class="form-control">
                                <option value="Show" name="Show">Show</option>
                                <option value="Hide" name="Hide">Hide</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2" name="buttonUpDataWebsite">Submit</button>
                    <button class="btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
        <script>
            function fetchTitle() {
                var linkInput = document.getElementById('link');
                var titleInput = document.getElementById('title');

                // Kiểm tra xem link có giá trị hay không
                if (linkInput.value.trim() === '') {
                    alert('Vui lòng nhập địa chỉ trang web.');
                    return;
                }

                // Sử dụng XMLHttpRequest để tải nội dung trang web
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Tìm và lấy giá trị của thẻ title
                        var doc = new DOMParser().parseFromString(xhr.responseText, 'text/html');
                        var title = doc.querySelector('title').innerText;

                        // Hiển thị giá trị title trong ô input tương ứng
                        titleInput.value = title;
                    }
                };

                // Mở kết nối và gửi yêu cầu
                xhr.open('GET', linkInput.value, true);
                xhr.send();
            }
        </script>
    </div>

    <hr>

    <div class="col-md-4 grid-margin stretch-card" bis_skin_checked="1">
        <div class="card" bis_skin_checked="1">
            <div class="card-body" bis_skin_checked="1">
                <h6 class="card-title">LIST CATEGORY</h6>
                <div class="table-rep-plugin">
                    <div class="table-wrapper">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1-clone" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th data-priority="0" id="tech-companies-1-col-1-clone">#</th>
                                        <th id="tech-companies-1-col-0-clone">ID</th>
                                        <th data-priority="1" id="tech-companies-1-col-1-clone">Name</th>
                                        <th data-priority="2" id="tech-companies-1-col-1-clone">Slug</th>
                                        <th data-priority="7" id="tech-companies-1-col-7-clone">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $show_cate = $ct->show_category();
                                    if ($show_cate) {
                                        $i = 0;
                                        while ($resultt = $show_cate->fetch_assoc()) {
                                            $i++;
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['id'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['slug'] ?>
                                                </td>
                                                <td>
                                                    <a href="editCategory.php?id=<?php echo $resultt['id'] ?>" name="edit" type="button" class="btn btn-warning ml-2">Edit</a>
                                                    <a type="button" href="?deleteCategoryid=<?php echo $resultt['id'] ?>" name="delete" class="btn btn-danger ml-2" onclick="return confirm('Delete?')" target="_self">Delete</a>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 grid-margin stretch-card" bis_skin_checked="1">
        <div class="card" bis_skin_checked="1">
            <div class="card-body" bis_skin_checked="1">

                <h6 class="card-title">LIST CATEGORY</h6>

                <div class="table-rep-plugin">
                    <div class="table-wrapper">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1-clone" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th data-priority="0" id="tech-companies-1-col-1-clone">#</th>
                                        <th id="tech-companies-1-col-0-clone">ID</th>
                                        <th data-priority="1" id="tech-companies-1-col-1-clone">Name</th>
                                        <th data-priority="2" id="tech-companies-1-col-1-clone">Link</th>
                                        <th data-priority="3" id="tech-companies-1-col-1-clone">Created_at</th>
                                        <th data-priority="4" id="tech-companies-1-col-1-clone">Edited_at</th>
                                        <th data-priority="5" id="tech-companies-1-col-1-clone">Category</th>
                                        <th data-priority="6" id="tech-companies-1-col-1-clone">Status</th>
                                        <th data-priority="7" id="tech-companies-1-col-7-clone">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $show_web = $web->show_website();
                                    if ($show_web) {
                                        $i = 0;
                                        while ($resultt = $show_web->fetch_assoc()) {
                                            $i++;
                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['id'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['link'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['created_at'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['edited_at'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['category'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $resultt['status'] ?>
                                                </td>
                                                <td>
                                                    <a href="editWebsite.php?id=<?php echo $resultt['id'] ?>" name="edit" type="button" class="btn btn-warning ml-2">Edit</a>
                                                    <a type="button" href="?deleteWebsiteid=<?php echo $resultt['id'] ?>" name="delete" class="btn btn-danger ml-2" onclick="return confirm('Delete?')" target="_self">Delete</a>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>


<!-- <iframe style="width: 100%; height: 100%" src="https://multitab.io.vn" frameborder="0"></iframe> -->

</div>

<?php
include_once __DIR__ . "/inc/footer.client.php"
?>
</div>
</div>

</body>

</html>