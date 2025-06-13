<?php
include 'db.php';

if (!isset($_GET['site_id'])) {
    die("Site ID missing.");
}

$site_id = intval($_GET['site_id']);

$site_result = $conn->query("SELECT * FROM sites WHERE id = $site_id");
if ($site_result->num_rows == 0) {
    die("Site not found.");
}
$site = $site_result->fetch_assoc();

$expenses_result = $conn->query("SELECT * FROM expenses WHERE site_id = $site_id");
$expenses = [];
$total_spent = 0;
while ($row = $expenses_result->fetch_assoc()) {
    $expenses[] = $row;
    $total_spent += floatval($row['amount']);
}
$remaining = floatval($site['total_budget']) - $total_spent;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Site Report: <?php echo htmlspecialchars($site['site_name']); ?></title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f8f9fa;
            padding: 30px 15px;
        }
        .report-container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        h1, h2,h3 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .table thead {
            background-color: #0d6efd;
            color: white;
        }
        .summary-box {
            max-width: 400px;
            margin: 30px auto 0 auto;
            background-color: #e7f1ff;
            border-left: 6px solid #0d6efd;
            padding: 15px 25px;
            font-weight: 600;
            font-size: 18px;
            color: #084298;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 12px rgba(13, 110, 253, 0.25);
        }
        .print-btn {
            display: block;
            margin: 40px auto 0 auto;
            padding: 12px 40px;
            font-weight: 600;
            font-size: 17px;
            background-color: #0d6efd;
            border: none;
            border-radius: 40px;
            color: white;
            box-shadow: 0 5px 15px rgba(13,110,253,0.4);
            transition: background-color 0.3s ease;
        }
        .print-btn:hover {
            background-color: #0b5ed7;
            cursor: pointer;
            box-shadow: 0 7px 20px rgba(11, 94, 215, 0.6);
        }
    </style>
</head>
<body>

<div class="report-container">
    <h3>Construction Site Report</h3>

    <h3>Site Details</h3>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th scope="row" style="width: 200px;">Name</th>
                <td><?php echo htmlspecialchars($site['site_name']); ?></td>
            </tr>
            <tr>
                <th scope="row">Location</th>
                <td><?php echo htmlspecialchars($site['location']); ?></td>
            </tr>
            <tr>
                <th scope="row">Start Date</th>
                <td><?php echo htmlspecialchars($site['start_date']); ?></td>
            </tr>
            <tr>
                <th scope="row">Estimated Completion Date</th>
                <td><?php echo htmlspecialchars($site['completion_date']); ?></td>
            </tr>
            <tr>
                <th scope="row">Status</th>
                <td><?php echo htmlspecialchars($site['status']); ?></td>
            </tr>
            <tr>
                <th scope="row">Total Budget (₹)</th>
                <td><?php echo number_format($site['total_budget'], 2); ?></td>
            </tr>
        </tbody>
    </table>

    <h3>Expenses</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount (₹)</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($expenses) > 0): ?>
                <?php foreach ($expenses as $exp): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($exp['description']); ?></td>
                        <td><?php echo number_format($exp['amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($exp['expense_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" class="text-center">No expenses recorded.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="summary-box">
        Total Spent: ₹<?php echo number_format($total_spent, 2); ?><br />
        Remaining Budget: ₹<?php echo number_format($remaining, 2); ?>
    </div>

    <button class="print-btn" onclick="window.print()">Print / Save as PDF</button>
</div>

<!-- Bootstrap 5 JS (optional, here just for completeness) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
