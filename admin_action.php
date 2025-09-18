<?php
session_start();

// Block access if not logged in as admin
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true){
    header("Location: login.php");
    exit;
}

// Connect to database
$conn = new mysqli("localhost", "root", "", "gamezone");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ===== ADD PRODUCT =====
if(isset($_POST['add_product'])){
    $category = $conn->real_escape_string($_POST['category']);  // e.g., laptops, parts
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']); // make sure price is a number
    $specs = $conn->real_escape_string($_POST['specs']);

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $upload_dir = "uploads/";

        if(!is_dir($upload_dir)){
            mkdir($upload_dir, 0755, true);
        }

        // Unique image name
        $new_image_name = time().'_'.basename($image);
        $target_path = $upload_dir . $new_image_name;

        if(move_uploaded_file($tmp_name, $target_path)){
            // Insert into table
            $sql = "INSERT INTO `$category` (name, price, specs, image) VALUES ('$name', '$price', '$specs', '$new_image_name')";
            if($conn->query($sql) === TRUE){
                header("Location: admin.php?success=added");
                exit;
            } else {
                die("Database Error: " . $conn->error);
            }
        } else {
            die("Failed to upload image.");
        }
    } else {
        die("Please select a valid image.");
    }
}

// ===== DELETE PRODUCT =====
if(isset($_GET['delete_id']) && isset($_GET['category'])){
    $id = intval($_GET['delete_id']);
    $category = $conn->real_escape_string($_GET['category']);

    // Get image name to delete from server
    $result = $conn->query("SELECT image FROM `$category` WHERE id='$id'");
    if($row = $result->fetch_assoc()){
        $img_path = "uploads/".$row['image'];
        if(file_exists($img_path)) unlink($img_path);
    }

    // Delete record from database
    $conn->query("DELETE FROM `$category` WHERE id='$id'");
    header("Location: admin.php?success=deleted");
    exit;
}

$conn->close();
?>
