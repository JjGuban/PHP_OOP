<?php
require_once "attendance.php";
require_once "student.php";

$attendance = new Attendance();
$student = new Student();
$message = "";

// Handle form submission (add or update)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    if (!empty($_POST['id'])) {
        // Update
        $attendance->update($_POST['id'], $student_id, $date, $status);
        $message = "Attendance updated successfully!";
        header("Location: attendance_manager.php");
        exit;
    } else {
        // Create
        $attendance->create($student_id, $date, $status);
        $message = "Attendance added successfully!";
        header("Location: attendance_manager.php");
        exit;
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $attendance->delete($_GET['delete']);
    $message = "Attendance deleted successfully!";
    header("Location: attendance_manager.php");
    exit;
}

// Handle edit (load data into form)
$editAttendance = null;
if (isset($_GET['edit'])) {
    $editAttendance = $attendance->readById($_GET['edit']);
}

// Fetch all students (for dropdown) and attendance records
$students = $student->readAll();
$records = $attendance->readAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Attendance Manager</title>
</head>

<body>
    <h1>Attendance Manager</h1>
    <?php if ($message): ?>
    <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <!-- Attendance Form -->
    <h2><?php echo $editAttendance ? "Edit Attendance" : "Add Attendance"; ?></h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $editAttendance['id'] ?? ''; ?>">

        <label>Student:</label>
        <select name="student_id" required>
            <option value="">Select Student</option>
            <?php foreach ($students as $s): ?>
            <option value="<?php echo $s['id']; ?>"
                <?php echo ($editAttendance && $editAttendance['student_id'] == $s['id']) ? 'selected' : ''; ?>>
                <?php echo $s['name']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Date:</label>
        <input type="date" name="date" value="<?php echo $editAttendance['date'] ?? ''; ?>" required>
        <br>

        <label>Status:</label>
        <select name="status" required>
            <option value="Present"
                <?php echo ($editAttendance && $editAttendance['status'] == "Present") ? "selected" : ""; ?>>Present
            </option>
            <option value="Absent"
                <?php echo ($editAttendance && $editAttendance['status'] == "Absent") ? "selected" : ""; ?>>Absent
            </option>
            <option value="Late"
                <?php echo ($editAttendance && $editAttendance['status'] == "Late") ? "selected" : ""; ?>>Late</option>
        </select>
        <br>

        <button type="submit"><?php echo $editAttendance ? "Update" : "Add"; ?> Attendance</button>
        <?php if ($editAttendance): ?>
        <a href="attendance_manager.php">Cancel Edit</a>
        <?php endif; ?>
    </form>

    <!-- Attendance List -->
    <h2>Attendance Records</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($records as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <?php
                    $studentData = $student->readById($row['student_id']);
                    echo $studentData ? $studentData['name'] : "Unknown";
                    ?>
            </td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="?edit=<?php echo $row['id']; ?>">Edit</a>
                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>