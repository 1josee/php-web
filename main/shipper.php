<?php
    session_start();
    require_once('shipper_function.php');
    // Set Variables for featured products
    $featuredProductsNames = array();
    $featuredProducts = readFeaturedProducts();
    $featuredProductsCount = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="shipper.css">
    <title>Document</title>
</head>
<body>
<?php
        require_once('header.php')
?>
<form action='' method='post'>
    <table class="orders">
        <tr>
            <th>ID</th>
                <input type='hidden' name='id[]' value='id'>
            <th>Products</th>
            <th>Status
                <input type="hidden" name='status[]' value="status">
            </th>
        </tr>
        <?php
            $count_id = 1;
            foreach ($featuredProducts as $featuredProduct) {
                $id = $featuredProduct['id'];
                $products = $featuredProduct['products'];
                $status = $featuredProduct['status'];
                $hub = $featuredProduct['hub'];
                if($status == "Active" && $hub == $_SESSION['hub'] ){  
                echo "
                    <tr>
                        <th>$id <input type='hidden' name='id[]' value='$count_id'></th>
                        <th>$products</th>
                        <th><select name='status[]'>
                            <option value='$status' selected='selected'>$status</option>
                            <option value='Ordered'>Ordered</option>
                            <option value='Dilivered'>Dilivered</option>
                        </select>
                        </th>
                    </tr>
                    
                    ";} else{
                        echo "
                        <tr class='invisible'>
                            <th>$id <input type='hidden' name='id[]' value='$count_id'></th>
                            <th>$products</th>
                            <th><select name='status[]'>
                                <option value='$status' selected='selected'>$status</option>
                                <option value='Ordered'>Ordered</option>
                                <option value='Dilivered'>Dilivered</option>
                            </select>
                            </th>
                        </tr>";
                    }
                    $count_id++;
                    $featuredProductsCount++;
                    if ($featuredProductsCount == 15) {
                        break;
                    }         
                }
            ?>
    
    </table>
    <button class="form_button" type="submit" name="submit" >Submit</button>
</form>
<?php
        require_once('footer.php')
?>
<?php
                
    if(isset($_POST['submit'])){
    $id_order = $_POST['id']; 
    $input = fopen('../data/order.csv', 'r');  //open for reading
    $output = fopen('../data/temporary.csv', 'a'); //open for writing
    $new_status= $_POST['status'];
    $count = 0;
    while( false !== ( $data = fgetcsv($input) )){  //read each line as an array
        //modify data here
        if ($new_status[$count] != $data[7] && $new_status[$count] != 'status'){
           //Replace line here
           $data[7] = $new_status[$count];
        }
        $count++;
        echo $data[0];
        //write modified data to new file
        fputcsv( $output, $data);

    }

    print_r($id_order);
    //close both files
    fclose( $input );
    fclose( $output );
    //clean up
    unlink('../data/order.csv');// Delete obsolete BD
    rename('../data/temporary.csv', '../data/order.csv'); 
}
?>
</body>
</html>