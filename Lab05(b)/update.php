<?php
session_start();
include 'db.php';

$error = null;
// Allow update by link (matric param) or by the logged-in user themselves.
$matric = $_GET['matric'] ?? $_POST['matric'] ?? ($_SESSION['matric'] ?? null);

if ($matric === null) {
    $error = "No matric provided. Please log in or use the dashboard link.";
} else {
    $result = mysqli_query($conn, "SELECT * FROM users WHERE matric='$matric'");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $error = "User with matric '$matric' not found.";
    } elseif (isset($_POST['update'])) {
        $name = $_POST['name'];
        $access = $_POST['role'];

        mysqli_query($conn, "UPDATE users SET name='$name', role='$access' WHERE matric='$matric'");
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #f9f6ff 0%, #f1f8ff 100%);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
}
.card {
    background: #fff;
    margin-top: 40px;
    width: 360px;
    padding: 20px 22px;
    border: 1px solid #e5e5ef;
    border-radius: 12px;
    box-shadow: 0 12px 35px rgba(42, 71, 109, 0.08);
}
h2 {
    margin-top: 0;
    margin-bottom: 16px;
    color: #303145;
}
label {
    font-size: 14px;
    color: #4b4d63;
}
input[type="text"], select {
    width: 100%;
    padding: 10px 12px;
    margin-top: 6px;
    margin-bottom: 16px;
    border: 1px solid #d6d8e7;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
}
input[type="text"]:focus, select:focus {
    outline: none;
    border-color: #9d8cff;
    box-shadow: 0 0 0 3px rgba(157, 140, 255, 0.2);
}
.actions {
    display: flex;
    align-items: center;
    gap: 12px;
}
input[type="submit"] {
    background: linear-gradient(120deg, #8f9bff, #7cb7ff);
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: transform 0.1s ease, box-shadow 0.2s ease;
}
input[type="submit"]:hover {
    box-shadow: 0 8px 18px rgba(124, 183, 255, 0.35);
}
input[type="submit"]:active {
    transform: translateY(1px);
}
a {
    color: #7a6cff;
    text-decoration: none;
    font-weight: 600;
}
a:hover {
    text-decoration: underline;
}
.error {
    background: #fff5f5;
    border: 1px solid #ffd7d7;
    color: #a63a3a;
    padding: 10px 12px;
    border-radius: 8px;
    margin-bottom: 12px;
}
</style>
</head>
<body>
<div class="card">
    <h2>Update User</h2>
    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <a href="dashboard.php">Back to list</a>
    <?php else: ?>
    <form method="post">
        <input type="hidden" name="matric" value="<?php echo htmlspecialchars($row['matric']); ?>">
        <label>Matric</label>
        <input type="text" name="matric_display" value="<?php echo htmlspecialchars($row['matric']); ?>" readonly>
        <label>Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
        <label>Access Level</label>
        <select name="role">
            <option value="lecturer" <?php echo $row['role'] === 'lecturer' ? 'selected' : ''; ?>>Lecturer</option>
            <option value="student" <?php echo $row['role'] === 'student' ? 'selected' : ''; ?>>Student</option>
        </select>
        <div class="actions">
            <input type="submit" name="update" value="Update">
            <a href="dashboard.php">Cancel</a>
        </div>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
