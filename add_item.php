<?php
// Initialize variables for form fields
$itemName = $category = $description = $price = $photo = "";
$itemNameErr = $categoryErr = $descriptionErr = $priceErr = $photoErr = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate item name
    if (empty($_POST["item-name"])) {
        $itemNameErr = "Item name is required";
    } else {
        $itemName = test_input($_POST["item-name"]);
    }

    // Validate category
    if (empty($_POST["category"])) {
        $categoryErr = "Category is required";
    } else {
        $category = test_input($_POST["category"]);
    }

    // Validate description
    if (empty($_POST["description"])) {
        $descriptionErr = "Description is required";
    } else {
        $description = test_input($_POST["description"]);
    }

    // Validate price
    if (empty($_POST["price"])) {
        $priceErr = "Price is required";
    } else {
        $price = test_input($_POST["price"]);
    }

    // Validate photo upload
    if (empty($_FILES["photo"]["name"])) {
        $photoErr = "Photo is required";
    } else {
        // Handle photo upload
        // Specify the directory for storing photos
        $targetDir = "uploads/";
        // Generate a unique name for the photo
        $photoName = uniqid() . "_" . basename($_FILES["photo"]["name"]);
        // Full path to save the photo on the server
        $targetFilePath = $targetDir . $photoName;
        // Check if the directory exists, if not, create it
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        // Check if the photo is successfully uploaded
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
            // Photo uploaded successfully
            // You can store $targetFilePath in the database or perform further processing
        } else {
            $photoErr = "Error uploading photo";
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert form data into database table
if (!empty($itemName) && !empty($category) && !empty($description) && !empty($price) && !empty($photoName)) {
    $sql = "INSERT INTO item (item_name, category, description, price, photo) VALUES ('$itemName', '$category', '$description', '$price', '$photoName')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items - fashion and xxl</title>
    <style>
        /* CSS styles */
        /* Add your CSS styles here */
       /* General Styles */
/* General Styles */
body {
    font-family: Arial, sans-serif;
    style="color:black"
    margin: 0;
    padding: 0;
}

/* Navbar Styles */
.navbar {
    background-color: #333;
    display: flex;
    justify-content: space-between;
    padding: 20px;
}

.navbar .logo img {
    width: 50px;
    height: 50px;
}

.navbar .logo h2 {
    color: #fff;
    margin: 0;
    padding: 0;
}

.navbar .links {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.navbar .links li {
    display: inline;
    margin-right: 20px;
}

.navbar .links li a {
    color: #fff;
    text-decoration: none;
}

.navbar .links li a:hover {
    color: #ccc;
}

/* Add Items Form Styles */
.add-items {
    padding: 20px;
}

.add-items h1 {
    margin-bottom: 20px;
}

.add-items .form-group {
    margin-bottom: 20px;
}

.add-items .form-group label {
    display: block;
    margin-bottom: 5px;
}

.add-items .form-group input,
.add-items .form-group select,
.add-items .form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.add-items .form-group textarea {
    resize: none;
}

.add-items .form-group .error {
    color: red;
    margin-top: 5px;
}

.add-items button {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-transform: uppercase;
}

.add-items button:hover {
    background-color: #45a049;
}

/* Footer Styles */
.footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 20px 0;
    margin-top: 50px;
}

.footer p {
    font-size: 14px;
}
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="logo.png" alt="logo">
            <h2>fashion and xxl</h2>
        </div>
        <ul class="links"> 
            <li><a href="inde.html">HOME</a></li>
            <li><a href="buy.php">BUY</a></li>
         
            <li><a href="cart.php">CART</a></li>
            <li><a href="#">WISHLIST</a></li>
        </ul>
    </nav>

    <!-- Add Items Form -->
    <section class="add-items">
        <h1>Add Items</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="item-name">Item Name:</label>
                <input type="text" id="item-name" name="item-name" value="<?php echo $itemName; ?>" required>
                <span class="error"><?php echo $itemNameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="" <?php if(empty($category)) echo 'selected'; ?>>Select category</option>
                    <option value="bottoms" <?php if($category == 'bottoms') echo 'selected'; ?>>bottoms</option>
                    <option value="tops" <?php if($category == 'tops') echo 'selected'; ?>>tops</option>
                    <option value="outfit" <?php if($category == 'outfit') echo 'selected'; ?>>outfit</option>
                    <!-- Add more options as needed -->
                </select>
                <span class="error"><?php echo $categoryErr; ?></span>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required><?php echo $description; ?></textarea>
                <span class="error"><?php echo $descriptionErr; ?></span>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="<?php echo $price; ?>" required>
                <span class="error"><?php echo $priceErr; ?></span>
            </div>
            <!-- New photo upload field -->
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
                <span class="error"><?php echo $photoErr; ?></span>
            </div>
            <button type="submit">Add Item</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 fashion and xxl. All rights reserved.</p>
    </footer>
</body>
</html>
