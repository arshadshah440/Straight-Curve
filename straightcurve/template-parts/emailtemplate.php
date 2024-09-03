<?php
// email template for quote
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
        /* Enables horizontal scrolling on smaller screens */
        margin: 20px 0;
    }

    .responsive-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .responsive-table th,
    .responsive-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .responsive-table th {
        background-color: #f8f8f8;
        color: #333;
        font-weight: bold;
    }

    .responsive-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .responsive-table tbody tr:hover {
        background-color: #f1f1f1;
    }

    @media screen and (max-width: 600px) {

        .responsive-table th,
        .responsive-table td {
            padding: 10px;
            font-size: 14px;
        }
    }
</style>

<div class="table-container">
    <table class="responsive-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Postcode</th>
                <th>Suburb</th>
                <th>Profession</th>
                <th>Product Name</th>
                <th>Product Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($products as $product) {
            ?>
                <tr>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $postalcode; ?></td>
                    <td><?php echo $suburb; ?></td>
                    <td><?php echo $profession; ?></td>
                    <td><?php echo $product['itemname']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>