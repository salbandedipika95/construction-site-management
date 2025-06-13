<?php 
include 'db.php';
$site_id = isset($_GET['site_id']) ? intval($_GET['site_id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO expenses (site_id, description, amount, expense_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isds", $site_id, $_POST['description'], $_POST['amount'], $_POST['expense_date']);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add Expense for Site <?php echo htmlspecialchars($site_id); ?></title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f8f9fa;
            padding: 40px 15px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px 35px;
            border-radius: 12px;
            box-shadow: 0 10px 28px rgba(0,0,0,0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h3 {
            color: #0d6efd;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        label {
            font-weight: 600;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 16px;
            border: 1.5px solid #ced4da;
            transition: border-color 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus {
            border-color: #0d6efd;
            outline: none;
            box-shadow: 0 0 5px rgba(13,110,253,0.5);
        }
        .btn-submit {
            display: block;
            width: 100%;
            padding: 12px 0;
            font-size: 18px;
            font-weight: 700;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 40px;
            box-shadow: 0 5px 15px rgba(13,110,253,0.4);
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 25px;
        }
        .btn-submit:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>Add Expense for Site ID: <?php echo htmlspecialchars($site_id); ?></h3>
    <form method="POST" novalidate>
        <div class="mb-4">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" required placeholder="Enter expense description" />
        </div>
        <div class="mb-4">
            <label for="amount">Amount (₹)</label>
            <input type="number" step="0.01" name="amount" id="amount" required placeholder="Enter amount spent" />
        </div>
        <div class="mb-4">
            <label for="expense_date">Date</label>
            <input type="date" name="expense_date" id="expense_date" required />
        </div>
        <button type="submit" class="btn-submit">Add Expense</button>
    </form>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
