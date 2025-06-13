<?php include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO sites (site_name, location, start_date, completion_date, total_budget, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdss", $_POST['site_name'], $_POST['location'], $_POST['start_date'], $_POST['completion_date'], $_POST['total_budget'], $_POST['status']);
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
    <title>Add New Construction Site</title>
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
        input[type="date"],
        select {
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
        input[type="date"]:focus,
        select:focus {
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
    <h3>Add New Site</h3>
    <form method="POST" novalidate>
        <div class="mb-4">
            <label for="site_name">Name</label>
            <input type="text" id="site_name" name="site_name" required placeholder="Enter site name" />
        </div>
        <div class="mb-4">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" required placeholder="Enter location" />
        </div>
        <div class="mb-4">
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" required />
        </div>
        <div class="mb-4">
            <label for="completion_date">Completion Date</label>
            <input type="date" id="completion_date" name="completion_date" required />
        </div>
        <div class="mb-4">
            <label for="total_budget">Total Budget (₹)</label>
            <input type="number" step="0.01" id="total_budget" name="total_budget" required placeholder="Enter total budget" />
        </div>
        <div class="mb-4">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="" disabled selected>Select status</option>
                <option>Planned</option>
                <option>In Progress</option>
                <option>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn-submit">Save</button>
    </form>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
