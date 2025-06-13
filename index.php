<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Construction Sites</title>
  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container my-4">
    <h2 class="mb-4 text-center">Construction Sites</h2>
    <div class="mb-3 text-center">
      <a href="add_site.php" class="btn btn-primary">+ Add New Site</a>
    </div>
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-primary">
        <tr>
          <th>Site Name</th>
          <th>Location</th>
          <th>Start</th>
          <th>Completion</th>
          <th>Status</th>
          <th>Budget (₹)</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $result = $conn->query("SELECT * FROM sites");
      while($row = $result->fetch_assoc()) {
          echo "<tr>
            <td>".htmlspecialchars($row['site_name'])."</td>
            <td>".htmlspecialchars($row['location'])."</td>
            <td>".htmlspecialchars($row['start_date'])."</td>
            <td>".htmlspecialchars($row['completion_date'])."</td>
            <td>".htmlspecialchars($row['status'])."</td>
            <td>".number_format($row['total_budget'], 2)."</td>
            <td>
              <a href='add_expense.php?site_id={$row['id']}' class='btn btn-sm btn-success me-1'>Add Expense</a>
              <a href='view_expenses.php?site_id={$row['id']}' class='btn btn-sm btn-info me-1'>View Expenses</a>
              <a href='generate_report.php?site_id={$row['id']}' class='btn btn-sm btn-secondary'>Generate PDF</a>
            </td>
          </tr>";
      }
      ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS Bundle (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
