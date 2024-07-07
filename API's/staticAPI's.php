<?php

$apiUrl = "https://fakestoreapi.com/products/category/electronics";

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$products = [];
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $products = json_decode($response, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technology Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .product {
            background: #fff;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
        .product h2 {
            font-size: 18px;
            color: #333;
        }
        .product p {
            color: #777;
        }
        .product a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            color: #fff;
            background: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }
        .product a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Technology Products</h1>
    <div class="product-container">
        <?php
        if (!empty($products)) {
            foreach ($products as $product) {
                echo "<div class='product'>";
                echo "<img src='" . $product['image'] . "' alt='" . $product['title'] . "'>";
                echo "<h2>" . $product['title'] . "</h2>";
                echo "<p>Price: $" . $product['price'] . "</p>";
                echo "<p>" . $product['description'] . "</p>";
                echo "<a href='" . $product['image'] . "' target='_blank'>View Product</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</body>
</html>

