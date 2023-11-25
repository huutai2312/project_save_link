<!-- Add Category Modal -->
<!-- <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <form action="" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-inverse-success" name="buttonUpData">Add</button>
                </div>
            </div>
        </div>
    </form>
</div> -->


<!-- List Category Modal -->
<div class="modal fade" id="listCategoryModal" tabindex="-1" aria-labelledby="listCategoryModalLabel" aria-hidden="true">
    <form action="" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listCategoryModalLabel">List Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
    </form>
</div>