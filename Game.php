<?php
// Game.php
// B. Menerapkan prinsip modularitas (terdapat function PHP pada website)
class Game {
    private $db;
    
    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllGames($sort = 'id_desc') {
        $order_by = "ORDER BY id DESC";
        if ($sort === 'name_asc') {
            $order_by = "ORDER BY name ASC";
        } elseif ($sort === 'name_desc') {
            $order_by = "ORDER BY name DESC";
        } elseif ($sort === 'price_asc') {
            $order_by = "ORDER BY price ASC";
        } elseif ($sort === 'price_desc') {
            $order_by = "ORDER BY price DESC";
        }

        $query = "SELECT * FROM games $order_by";
        $result = $this->db->getConnection()->query($query);
        return $result;
    }

    public function getGameById($id) {
        $conn = $this->db->getConnection();
        $id = $conn->real_escape_string($id);
        $query = "SELECT * FROM games WHERE id = '$id'";
        $result = $conn->query($query);
        return $result->fetch_assoc();
    }

    public function createGame($name, $description, $price, $img_path) {
        $conn = $this->db->getConnection();
        $name = $conn->real_escape_string($name);
        $description = $conn->real_escape_string($description);
        $price = $conn->real_escape_string($price);
        $img_path = $conn->real_escape_string($img_path);

        $query = "INSERT INTO games (name, description, price, img) 
                 VALUES ('$name', '$description', '$price', '$img_path')";
        
        return $conn->query($query);
    }

    public function updateGame($id, $name, $description, $price, $img_path) {
        $conn = $this->db->getConnection();
        $id = $conn->real_escape_string($id);
        $name = $conn->real_escape_string($name);
        $description = $conn->real_escape_string($description);
        $price = $conn->real_escape_string($price);
        $img_path = $conn->real_escape_string($img_path);

        $query = "UPDATE games SET 
                 name = '$name', 
                 description = '$description', 
                 price = '$price', 
                 img = '$img_path' 
                 WHERE id = '$id'";
        
        return $conn->query($query);
    }

    public function deleteGame($id) {
        $conn = $this->db->getConnection();
        $id = $conn->real_escape_string($id);
        $query = "DELETE FROM games WHERE id = '$id'";
        return $conn->query($query);
    }

    public function handleImageUpload($image_choice, $file = null, $img_url = null) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $img_path = '';

        if ($image_choice === 'upload' && $file && $file['error'] == 0) {
            $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $file_extension;
            $destination = $upload_dir . $filename;
            
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $img_path = $destination;
            }
        } elseif ($image_choice === 'url' && $img_url) {
            if (filter_var($img_url, FILTER_VALIDATE_URL)) {
                $file_extension = pathinfo($img_url, PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $file_extension;
                $destination = $upload_dir . $filename;
                
                $image_data = @file_get_contents($img_url);
                if ($image_data !== false) {
                    file_put_contents($destination, $image_data);
                    $img_path = $destination;
                }
            }
        }

        return $img_path;
    }

    public function getCurrentImagePath($id) {
        $conn = $this->db->getConnection();
        $id = $conn->real_escape_string($id);
        $query = "SELECT img FROM games WHERE id = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['img'];
    }

    public function searchGamesByName($term) {
        $conn = $this->db->getConnection();
        
        // Improved search query - search for matches anywhere in the name
        $sql = "SELECT * FROM games WHERE name LIKE ?";
        
        if ($stmt = $conn->prepare($sql)) {
            // Use wildcards at both ends for a more flexible search
            $param = '%' . $term . '%';
            $stmt->bind_param("s", $param);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $games = [];
            while ($row = $result->fetch_assoc()) {
                $games[] = $row;
            }
            
            // Limit results to improve performance
            return array_slice($games, 0, 5);
        } else {
            return ["error" => "Failed to prepare statement"];
        }
    }
}
?>