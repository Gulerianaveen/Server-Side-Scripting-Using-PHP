<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $book_title = htmlspecialchars($_POST['book_title']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $shipping_address = htmlspecialchars($_POST['shipping_address']);
    $delivery_date = htmlspecialchars($_POST['delivery_date']);
    $payment_method = htmlspecialchars($_POST['payment_method']);

    // Get current date
    $current_date = date('Y-m-d'); // Format: YYYY-MM-DD

    // Check if the delivery date is earlier than the current date
    if ($delivery_date < $current_date) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Error: Invalid Date</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 50%;
                    margin: 50px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                h2 {
                    color: red;
                }
                p {
                    font-size: 16px;
                }
                a {
                    text-decoration: none;
                    color: #007bff;
                }
                a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Error: Invalid Delivery Date</h2>
                <p>The delivery date you selected, <strong>$delivery_date</strong>, is in the past. Please select a valid delivery date that is today or later.</p>
                <p><a href='index.html'>Go back to the order form</a></p>
            </div>
        </body>
        </html>";
        exit(); // Stop further execution if the date is invalid
    }

    // Simple email notification (Optional)
    $to = $email;
    $subject = "Order Confirmation: $book_title";
    $message = "
        Hi $name,

        Thank you for your order!

        Order Details:
        - Book Title: $book_title
        - Quantity: $quantity
        - Shipping Address: $shipping_address
        - Preferred Delivery Date: $delivery_date
        - Payment Method: $payment_method

        Your order will be processed soon.

        Regards,
        E-Commerce Team
    ";
    $headers = "From: no-reply@ecommerce.com\r\n";

    // Send confirmation email
    mail($to, $subject, $message, $headers);

    // Confirmation message for the user
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Order Confirmation</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 50%;
                margin: 50px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            h2 {
                text-align: center;
                color: #28a745;
            }
            p {
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Order Confirmed!</h2>
            <p>Thank you, <strong>$name</strong>! Your order for <strong>$quantity</strong> copy(ies) of <strong>$book_title</strong> has been received.</p>
            <p>Shipping Address: <strong>$shipping_address</strong></p>
            <p>Preferred Delivery Date: <strong>$delivery_date</strong></p>
            <p>Payment Method: <strong>$payment_method</strong></p>
            <p>A confirmation email has been sent to <strong>$email</strong>.</p>
            <p>Your order will be processed shortly.</p>
        </div>
    </body>
    </html>";
} else {
    // Redirect back to the form if accessed directly
    header("Location: index.html");
    exit();
}
?>
