<?php
$conn = new mysqli("localhost", "root", "", "gamezone");
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

if(isset($_POST['query'])){
    $query = "%".$_POST['query']."%";

    // Search in laptops, parts, accessories, console_games
    $sql = "SELECT name, 'laptops' AS category FROM laptops WHERE name LIKE ?
            UNION
            SELECT name, 'parts' FROM parts WHERE name LIKE ?
            UNION
            SELECT name, 'accesories' FROM accesories WHERE name LIKE ?
            UNION
            SELECT name, 'console_games' FROM console_games WHERE name LIKE ? LIMIT 5";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $query,$query,$query,$query);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo '<a href="'.$row['category'].'.php?search='.urlencode($row['name']).'" class="suggest-item">'.$row['name'].'</a>';
        }
    } else {
        echo '<div class="list-group-item">No matches found</div>';
    }
}
?>
