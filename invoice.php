<?php
require 'vendor/autoload.php'; // path to dompdf autoload.php

use Dompdf\Dompdf;

include('includes/config.php');
session_start();

// Validate session and order ID
if (!isset($_GET['oid']) || !is_numeric($_GET['oid']) || empty($_SESSION['login'])) {
    die("Invalid request");
}

$oid = intval($_GET['oid']);
$uid = intval($_SESSION['id']);

// Fetch order details
$query = mysqli_query($con, "
    SELECT 
        o.id AS orderid,
        o.orderDate,
        o.paymentMethod,
        o.quantity,
        o.orderStatus,
        p.productName,
        p.productPrice,
        p.shippingCharge
    FROM orders o
    JOIN products p ON o.productId = p.id
    WHERE o.id = '$oid' AND o.userId = '$uid'
");

if (mysqli_num_rows($query) == 0) {
    die("Order not found or access denied.");
}

$row = mysqli_fetch_assoc($query);

// Calculate total
$productTotal = $row['productPrice'] * $row['quantity'];
$totalAmount = $productTotal + $row['shippingCharge'];

// Generate HTML for invoice
$html = '
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        h2, h3 { color: #333; }
        p { margin: 4px 0; }
        hr { border: 0; border-top: 1px solid #ccc; margin: 10px 0; }
        .header, .footer { text-align: center; }
        .footer { position: fixed; bottom: -30px; left: 0; right: 0; font-size: 12px; }
    </style>

    <div class="header">
        <h2>ATOMS PVT LIMITED</h2>
        <p>Risali Bhilai, India</p>
        <p>Contact: 7646189166</p>
    </div>

    <hr>

    <p><strong>Order ID:</strong> '.$row['orderid'].'</p>
    <p><strong>Order Date:</strong> '.date('d M Y', strtotime($row['orderDate'])).'</p>
    <p><strong>Payment Method:</strong> '.$row['paymentMethod'].'</p>
    <p><strong>Status:</strong> '.$row['orderStatus'].'</p>

    <hr>

    <h3>Product Details</h3>
    <p><strong>Product:</strong> '.$row['productName'].'</p>
    <p><strong>Price per unit:</strong> ₹'.number_format($row['productPrice'], 2).'</p>
    <p><strong>Quantity:</strong> '.$row['quantity'].'</p>
    <p><strong>Shipping:</strong> ₹'.number_format($row['shippingCharge'], 2).'</p>

    <hr>
    <h3>Total: ₹'.number_format($totalAmount, 2).'</h3>

    <div class="footer">
        <hr>
        <p>Thank you for shopping with ATOMS</p>
    </div>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Stream the PDF to the browser
$dompdf->stream("invoice_{$row['orderid']}.pdf", array("Attachment" => 1));
exit;
?>