<?php
include 'db.php';

// Validate site ID
if (!isset($_GET['site_id'])) {
    die("Error: Site ID is missing.");
}

$site_id = intval($_GET['site_id']);

// Get site info
$site_query = $conn->query("SELECT * FROM sites WHERE id = $site_id");
if ($site_query->num_rows == 0) {
    die("Error: Site not found.");
}
$site = $site_query->fetch_assoc();

// Get expenses
$expenses_query = $conn->query("SELECT * FROM expenses WHERE site_id = $site_id");

?>
<!DOCTYPE html>
<html>
<head>
    <title>View Expenses - <?php echo htmlspecialchars($site['site_name']); ?></title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px 12px;
        }
        th {
            background-color: #0073D8;
            color: white;
        }
        h2, h3 {
            font-family: Arial;
        }
        body {
            font-family: Arial;
            padding: 20px;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #0073D8;
        }
    </style>
</head>
<body>

<h2>Expenses for Site: <?php echo htmlspecialchars($site['site_name']); ?></h2>
<h3>Location: <?php echo htmlspecialchars($site['location']); ?></h3>

<table>
    <tr>
        <th>Expense ID</th>
        <th>Description</th>
        <th>Amount (₹)</th>
        <th>Date</th>
    </tr>
    <?php
    $total = 0;
    if ($expenses_query->num_rows > 0) {
        while ($row = $expenses_query->fetch_assoc()) {
            echo "<tr>
                <td>{$row['expense_id']}</td>
                <td>{$row['description']}</td>
                <td>" . number_format($row['amount'], 2) . "</td>
                <td>{$row['expense_date']}</td>
            </tr>";
            $total += floatval($row['amount']);
        }
        echo "<tr style='font-weight: bold;'>
            <td colspan='2'>Total</td>
            <td colspan='2'>₹" . number_format($total, 2) . "</td>
        </tr>";
    } else {
        echo "<tr><td colspan='4'>No expenses found for this site.</td></tr>";
    }
    ?>
</table>

<a href="index.php">← Back to Site List</a>

</body>
</html>
