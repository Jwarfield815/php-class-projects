<?php
    $product_description = filter_input(INPUT_POST, 'product_description');
    $list_price = filter_input(INPUT_POST, 'list_price');
    $discount_percent = filter_input(INPUT_POST, 'discount_percent');

        $discount = $list_price * $discount_percent * 0.01;
        $discount_price = $list_price - $discount;

        $format_list_price = '$'.number_format($list_price, 2);
        $format_discount_percent = $discount_percent.'%';
        $format_discount = '$'.number_format($discount, 2);
        $format_discount_price = '$'.number_format($discount_price, 2);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Product Discount Calculator</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>

    <body>
        <main>
            <h1>Product Discount Calculator</h1>

            <label>Product Description:</label>
            <span><?php echo htmlspecialchars($product_description); ?></span><br>

            <label>List Price:</label>
            <span><?php echo htmlspecialchars($format_list_price); ?></span><br>

            <label>Standard Discount:</label>
            <span><?php echo htmlspecialchars($format_discount_percent); ?></span><br>

            <label>Discount Amount:</label>
            <span><?php echo $format_discount; ?></span><br>

            <label>Discount Price:</label>
            <span><?php echo $format_discount_price; ?></span><br>
        </main>
    </body>
</html>