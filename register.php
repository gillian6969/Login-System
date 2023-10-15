<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["register"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if (empty($username) || empty($email) || empty($contact) || empty($password) || empty($confirm_password)) {
            echo "Please fill in all fields for registration.";
        } else if ($password !== $confirm_password) {
            echo "alert";
        } else {
            $conn = mysqli_connect("localhost", "root", "", "fitness");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO users (username, email, contact, password) VALUES ('$username', '$email', '$contact', '$password')";

            if (mysqli_query($conn, $sql)) {
                echo "Registration successful!";
                header("Location: a2.html");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }
}
?>
