<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        echo "Please fill in all fields for login.";
    } else {
        $conn = mysqli_connect("localhost", "root", "", "fitness");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt_result = $stmt->get_result();

            if ($stmt_result->num_rows > 0) {
                $data = $stmt_result->fetch_assoc();
                $storedPassword = $data['password'];

                if ($password === $storedPassword) {
                    $_SESSION["username"] = $data["username"];
                    header("Location: Description.html");
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "Invalid username.";
            }
        }
        mysqli_close($conn);
    }
}
?>
