<?php
class Student {
    private $name;
    private $courses = [];
    private $courseFee = 1450; // PHP per course

    // Constructor
    public function __construct($name) {
        $this->name = $name;
    }

    // Add a course
    public function addCourse($course) {
        $this->courses[] = $course;
    }

    // Remove a course (if exists)
    public function removeCourse($course) {
        $key = array_search($course, $this->courses);
        if ($key !== false) {
            unset($this->courses[$key]);
            $this->courses = array_values($this->courses); // reindex array
        }
    }

    // Get all courses
    public function getCourses() {
        return $this->courses;
    }

    // Compute total enrollment fee
    public function getTotalFee() {
        return count($this->courses) * $this->courseFee;
    }

    // Display student info
    public function displayInfo() {
        echo "Student Name: " . $this->name . "<br>";
        echo "Enrolled Courses: <br>";
        foreach ($this->courses as $course) {
            echo "- " . $course . "<br>";
        }
        echo "Total Enrollment Fee: ₱" . $this->getTotalFee() . "<br>";
    }
}

// ----------- TEST / EXECUTION -----------

$student = new Student("Jacinto Jose Guban");

// Add courses
$student->addCourse("Mathematics");
$student->addCourse("Science");
$student->addCourse("English");

// Remove one course
$student->removeCourse("Science");

// Show student info and total fee
$student->displayInfo();
?>
