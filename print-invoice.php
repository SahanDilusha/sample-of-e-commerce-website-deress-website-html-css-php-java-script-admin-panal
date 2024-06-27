<?php 
// if (isset($_GET["obj"])&&!empty($_POST["obj"])) {
    $obj = json_decode($_GET["obj"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .invoice {
            background-color: #fff;
            width: 80%;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .invoice-header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            font-size: 2em;
            margin: 0;
        }
        .invoice-header p {
            margin: 5px 0;
            color: #777;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details .left {
            float: left;
            width: 50%;
        }
        .invoice-details .right {
            float: right;
            width: 50%;
            text-align: right;
        }
        .invoice-details .right p {
            margin: 5px 0;
            color: #777;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .invoice-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .invoice-table td {
            text-align: right;
        }
        .invoice-footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: right;
        }
        .invoice-footer p {
            margin: 5px 0;
            color: #777;
        }
        .bg-light {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <p>Invoice Number: <?=$obj->in_id?></p>
            <p>Date: <?= date('d-m-Y', strtotime($obj->in_date))?></p>
             <p>Username: <?=$obj->username?></p>   
        </div>
        <div class="invoice-details">
            <div class="left">
                <p>Bill To:<?=$obj->in_address?></p>
            </div>
            <div class="right">
                <p>From:</p>
                <p>Krist</p>
                <p>201 Shanti Villa,Silkhouse Street,Kandy.</p>
                <p>Sri Lanka</p>
            </div>
        </div>
        <table class="invoice-table">
            <thead class="bg-light">
                <tr>
                    <th>Item Id</th>
                    <th>Product Name</th>
                    <th>QTY</th>
                    <th>Item Price(LKR)</th>
                    <th>Total(LKR)</th>
                </tr>
            </thead>
            <tbody>
                <?=$obj->items?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Subtotal</td>
                    <td><?=$obj->total?></td>
                </tr>
            </tfoot>
        </table>
        <div class="invoice-footer">
            <p>Payment is due within 30 days. Thank you!</p>
        </div>
    </div>
</body>
</html>
<?php 
// }else{
//     echo("error");
// }
?>