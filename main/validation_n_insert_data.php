<?php
$name = $price = $description = $target_file = "";
$nameErr = $priceErr = $descriptionErr = "";
$seller = $_SESSION['user'];
if($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Validation
    function test_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if (empty($_POST["product_name"])) {
        $nameErr = "Product name must not be empty";
    }
    else{
        $name = test_input($_POST['product_name']);
        if (strlen($_POST["product_name"]) < 10) {
            $nameErr = "Product name must contain at least 10 characters";
        }
        elseif (strlen($_POST["product_name"]) > 20) {
            $nameErr = "Product name must contain at most 20 characters";
        }
    }
    
    if (empty($_POST["price"])) {
        $priceErr = "Price must not be empty";
    }
    else{
        $price = test_input($_POST["price"]);
        if ($price <= 0) {
            $priceErr = "Price must be a positive number";
        }
    }
    
    if (empty($_POST["description"])) {
        $descriptionErr = "Description must not be empty";
    }
    else{
        $description = test_input($_POST["description"]);
        if (strlen($_POST["description"]) > 50) {
            $descriptionErr = "Description must contain at most 50 characters";
        }
    }

    if(($nameErr == "") && ($descriptionErr == "") && ($priceErr == "")){
        //Image upload
        $target_dir = "../img-product/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Csv file handling
        $file_open = fopen("../data/products.csv","a");
        $no_rows = count(file("../data/products.csv"));
        if($no_rows > 1)    {
            $no_rows = ($no_rows - 1) + 1;
        }
        $form_data = array(
            'seller' => $seller,
            'sr_no'  => $no_rows,
            'image' => $_FILES ["image"] ["name"],
            'name' => $name,
            'price'=> $price,
            'description' => $description,
            'created_time' => date('Y-m-d h:i:s')
        );
        fputcsv($file_open, $form_data);
        fclose($file_open);

        $nameErr or $priceErr or $descriptionErr = '<label class="text-success">Successfully adding product</label>';
        $name = '';
        $price = '';
        $description = '';
    }
}
?>