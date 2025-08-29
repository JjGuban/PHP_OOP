<?php
require_once "student.php";

$student = new Student();
$message = "";

// Handle form submission (add or update)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    if (!empty($_POST['id'])) {
        // Update
        $student->update($_POST['id'], $name, $email);
        $message = "Student updated successfully!";
        // Reset edit mode
        header("Location: student_manager.php");
        exit;
    } else {
        // Create
        $student->create($name, $email);
        $message = "Student added successfully!";
        // Reset form
        header("Location: student_manager.php");
        exit;
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $student->delete($_GET['delete']);
    $message = "Student deleted successfully!";
    header("Location: student_manager.php");
    exit;
}

// Handle edit (load data into form)
$editStudent = null;
if (isset($_GET['edit'])) {
    $editStudent = $student->readById($_GET['edit']);
}

// Fetch all students
$students = $student->readAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Manager</title>
</head>

<body>
    <h1>Student Manager</h1>
    <?php if ($message): ?>
    <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <!-- Student Form -->
    <h2><?php echo $editStudent ? "Edit Student" : "Add Student"; ?></h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $editStudent['id'] ?? ''; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $editStudent['name'] ?? ''; ?>" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $editStudent['email'] ?? ''; ?>" required>
        <br>
        <button type="submit"><?php echo $editStudent ? "Update" : "Add"; ?> Student</button>
        <?php if ($editStudent): ?>
        <a href="student_manager.php">Cancel Edit</a>
        <?php endif; ?>
    </form>

    <!-- Student List -->
    <h2>Student List</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="?edit=<?php echo $row['id']; ?>">Edit</a>
                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this student?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>