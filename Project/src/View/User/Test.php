

<?php
include '../../Config/Database.php';
include '../../Router/User/User_login.php';


// Fetch the user_id from the session (assuming you have stored it after login)
$user_id = $_SESSION['user_id'];

try {
    // Fetch the data from the event_order table for the logged-in user
    $sql = "SELECT * FROM event_order WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Now you have the orders for the logged-in user, you can loop through and display the data
    foreach ($orders as $order) {
        // Display the order details here as needed
        // You can access the data like $order['orderID'], $order['fl_name'], $order['address'], etc.
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Image/logo.png">
    <title>My event</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</head>

<body>

<div>
    <label for="promptpay_id">PromptPay ID:</label>
    <input type="text" id="promptpay_id" placeholder="Enter PromptPay ID" autocomplete="off">
    <label for="amount">Amount:</label>
    <input type="number" id="amount" placeholder="Enter amount" autocomplete="off">
    <button onclick="generateQRCode()">Generate QR Code</button>
</div>
<div id="qrcode"></div>

<script>
    function generateQRCode() {
        let promptpay_id = document.getElementById('promptpay_id').value;
        let amount = document.getElementById('amount').value;
        let qr_code_element = document.getElementById('qrcode');
        qr_code_element.innerHTML = '';

        // Validate the PromptPay ID (should be in the format "x-xxxxxxxxx" or "x-xxxxxxxxxx")
        let pattern = /^x-\d{10,11}$/;
        if (!pattern.test(promptpay_id)) {
            alert('Invalid PromptPay ID. Please enter a valid PromptPay ID.');
            return;
        }

        let amount_numeric = parseFloat(amount);
        if (isNaN(amount_numeric) || amount_numeric <= 0) {
            alert('Invalid amount. Please enter a valid positive amount.');
            return;
        }

        // Convert amount to integer and decimal
        let amount_integer = Math.floor(amount_numeric);
        let amount_decimal = Math.round((amount_numeric - amount_integer) * 100);

        // Pad amount_integer and amount_decimal to 2 digits
        let amount_integer_padded = amount_integer.toString().padStart(2, '0');
        let amount_decimal_padded = amount_decimal.toString().padStart(2, '0');

        // Generate the PromptPay payload
        let promptpay_payload = `00020101021129370016A000000677010111${promptpay_id}5303764530376653037654${amount_integer_padded}${amount_decimal_padded}`;
        let qrcode = new QRCode(document.getElementById('qrcode'), {
            text: promptpay_payload,
            width: 180,
            height: 180,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H,
        });
    }
</script>



</body>

</html>
