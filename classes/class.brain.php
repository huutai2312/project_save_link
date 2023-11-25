<?php

include_once __DIR__ . "/../config/database.php";
include_once __DIR__ . "/../helpers/format.php";

$db = new Database();
// global $db;
// global $fm;

class website
{
    private $fm;
    public function __construct()
    {
        global $db;
        $this->db = $db;;
        $this->fm = new Format();
    }

    public function insert_website($name, $link, $created_at, $category, $status)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $link = mysqli_real_escape_string($this->db->link, $link);
        $created_at = mysqli_real_escape_string($this->db->link, $created_at);
        $category = mysqli_real_escape_string($this->db->link, $category);
        $status = mysqli_real_escape_string($this->db->link, $status);

        if ($name == '') {
            $alert = "Input Form";
            return $alert;
        } else {
            $query = "INSERT INTO website (name, link, created_at, category, status) VALUES ('$name', '$link', '$created_at', '$category', '$status')";

            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<p>Done.</p>";
                return $alert;
            } else {
                $alert = "<p>Error.</p>";
                return $alert;
            }
        }
    }

    public function update_website($id, $name, $link, $created_at, $edited_at, $category, $status)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $name = mysqli_real_escape_string($this->db->link, $name);
        $link = mysqli_real_escape_string($this->db->link, $link);
        $created_at = mysqli_real_escape_string($this->db->link, $created_at);
        $edited_at = mysqli_real_escape_string($this->db->link, $edited_at);
        $category = mysqli_real_escape_string($this->db->link, $category);
        $status = mysqli_real_escape_string($this->db->link, $status);

        if ($name == '') {
            $alert = "Input website";
            return $alert;
        } else {
            $query = "UPDATE website SET name = '$name', link = '$link', created_at = '$created_at', edited_at = '$edited_at', category = '$category', status = '$status' WHERE id = '$id'";
            $resultt = $this->db->update($query);

            if ($resultt) {
                $alert = "<p>Done.</p>";
                return $alert;
            } else {
                $alert = "<p>Error.</p>";
                return $alert;
            }
        }
    }

    public function show_website_by_category($category)
    {
        $category = mysqli_real_escape_string($this->db->link, $category);
        $query = "SELECT * FROM website WHERE category = '$category'";
        $result = $this->db->select($query);
        return $result;
    }


    public function show_website()
    {
        $query = "SELECT * FROM website ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_website($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);

        // Thay vì xóa dữ liệu, cập nhật trạng thái sang 'Hide'
        $query = "UPDATE website SET status = 'Hide' WHERE id = '$id'";

        $result = $this->db->update($query);

        if ($result) {
            $alert = "<p>Done.</p>";
            return $alert;
        } else {
            $alert = "<p>Error.</p>";
            return $alert;
        }
        // $query = "DELETE FROM website where id = '$id'";
        // $result = $this->db->delete($query);
        // return $result;
        // if ($result) {
        //     $alert = "<p>Done.</p>";
        //     return $alert;
        // } else {
        //     $alert = "<p>Error.</p>";
        //     return $alert;
        // }
    }

    public function getwebbyId($id)
    {
        $query = "SELECT * FROM website where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getCategories()
    {
        $query = "SELECT DISTINCT name FROM website"; // Lấy danh sách các tag duy nhất từ cơ sở dữ liệu
        $result = $this->db->select($query);
        $names = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $names[] = $row;
            }
        }
        return $names;
    }
}

class category
{
    private $fm;

    public function __construct()
    {
        global $db;
        $this->db = $db;;
        $this->fm = new Format();
    }

    public function insert_category($name, $slug)

    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $slug = mysqli_real_escape_string($this->db->link, $slug);

        if ($name == '') {
            $alert = "Input Form";
            return $alert;
        } else {
            $query = "INSERT INTO category (name, slug) VALUES ('$name', '$slug')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<p>Done.</p>";
                return $alert;
            } else {
                $alert = "<p>Error.</p>";
                return $alert;
            }
        }
    }

    public function update_category($id, $name, $slug)
    {

        $id = mysqli_real_escape_string($this->db->link, $id);
        $name = mysqli_real_escape_string($this->db->link, $name);
        $slug = mysqli_real_escape_string($this->db->link, $slug);

        if ($name == '') {
            $alert = "Input category";
            return $alert;
        } else {
            $query = "UPDATE category SET name = '$name', slug = '$slug' WHERE id = '$id'";

            $resultt = $this->db->update($query);
            if ($resultt) {
                $alert = "<p>Done.</p>";
                return $alert;
            } else {
                $alert = "<p>Error.</p>";
                return $alert;
            }
        }
    }

    public function show_category()
    {
        $query = "SELECT * FROM category";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_category($id)
    {
        $query = "DELETE FROM category where id = '$id'";
        $result = $this->db->delete($query);
        return $result;
        if ($result) {
            $alert = "<p>Done.</p>";
            return $alert;
        } else {
            $alert = "<p>Error.</p>";
            return $alert;
        }
    }

    public function getcatbyId($id)
    {
        $query = "SELECT * FROM category where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getNames()
    {
        $query = "SELECT DISTINCT name FROM website"; // Lấy danh sách các tag duy nhất từ cơ sở dữ liệu
        $result = $this->db->select($query);
        $names = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $names[] = $row;
            }
        }
        return $names;
    }
}
