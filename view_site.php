<?php
include 'db.php';
$site_id = $_GET['id'];
$site = $pdo->query("SELECT * FROM construction_sites WHERE id = $site_id")->fetch();
$expenses = $pdo->query("SELECT * FROM expenses WHERE site_id = $site_id")->fetchAll();
$total_spent = array_sum(array_column($expenses, 'amount'));
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Site</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

<h2><?= htmlspecialchars($site['site_name']) ?></h2>
<p><strong>Location:</strong> <?= htmlspecialchars($site['location']) ?></p>
<p><strong>Status:</strong> <?= $site['status'] ?></p>
<p><strong>Start:</strong> <?= $site['project_start_date'] ?></p>
<p><strong>Estimated Completion:</strong> <?= $site['estimated_completion_date'] ?></p>
<p><strong>Total Budget:</strong> $<?= $site['total_budget'] ?></p>

<h3 class="mt-4">Expenses</h3>
<table class="table table-bordered">
    <tr><th>Description</th><th>Amount</th><th>Date</th></tr>
    <?php foreach ($expenses as $exp): ?>
        <tr>
            <td><?= htmlspecialchars($exp['expense_description']) ?></td>
            <td>$<?= $exp['amount'] ?></td>
            <td><?= $exp['expense_date'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<p><strong>Total Spent:</strong> $<?= $total_spent ?></p>
<p><strong>Remaining:</strong> $<?= $site['total_budget'] - $total_spent ?></p>

<a href="generate_pdf.php?id=<?= $site_id ?>" class="btn btn-success">Generate PDF Report</a>
<a href="index.php" class="btn btn-secondary">Back to Dashboard</a>

</body>
</html>
