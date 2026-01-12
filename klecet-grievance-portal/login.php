<?php
session_start();
require 'includes/db.php';

$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mobile = trim($_POST['mobile']);
    $password = trim($_POST['password']);
    $designation = trim($_POST['designation']);
    $branch = trim($_POST['branch'] ?? '');

    if ($mobile && $password && $designation) {
        if (strtolower($designation) === 'student') {
            $stmt = $pdo->prepare("SELECT * FROM students WHERE mobile = :mobile LIMIT 1");
            $stmt->execute([':mobile' => $mobile]);
        } else {
            $stmt = $pdo->prepare("SELECT * FROM employees WHERE mobile = :mobile AND designation = :designation LIMIT 1");
            $stmt->execute([
                ':mobile' => $mobile,
                ':designation' => $designation
            ]);
        }

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                if (strtolower($designation) === 'student' && strtolower($row['status']) !== 'approved') {
                    $errorMsg = "⏳ Your account is pending approval by the Principal.";
                } else {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];

                    if (strtolower($designation) === 'student') {
                        $_SESSION['designation'] = 'Student';
                        $_SESSION['branch'] = $row['branch'];
                        $_SESSION['status'] = $row['status'];
                        header("Location: student_dashboard.php");
                        exit();
                    } else {
                        $_SESSION['designation'] = $row['designation'];
                        if ($designation === 'HOD' || $designation === 'GDC') {
                            $_SESSION['branch'] = $row['branch'] ?? $branch;
                        }
                        switch ($_SESSION['designation']) {
                            case 'Principal': header("Location: principal_dashboard.php"); break;
                            case 'GCC': header("Location: gcc_dashboard.php"); break;
                            case 'HOD': header("Location: hod_dashboard.php"); break;
                            case 'GDC': header("Location: gdc_dashboard.php"); break;
                            default: $errorMsg = "Invalid designation."; break;
                        }
                        exit();
                    }
                }
            } else {
                $errorMsg = "❌ Invalid password.";
            }
        } else {
            $errorMsg = "❌ Invalid mobile or designation.";
        }
    } else {
        $errorMsg = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - KLECET Grievance System</title>
    <style>
        /* Reset and base */
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body, html { height: 100%; }

        /* Background */
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Login container */
        .login-container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 360px;
            max-width: 95%;
        }

        .login-container h2 {
            margin-bottom: 25px;
            text-align: center;
            color: #003366;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: border 0.3s;
        }

        input:focus, select:focus { border-color: #003366; outline: none; }

        .password-wrapper { position: relative; }
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #888;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #003366;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover { background: #00509e; }

        .error {
            color: #d8000c;
            background: #ffd2d2;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: center;
        }

        @media(max-width: 400px) {
            .login-container { padding: 30px 20px; }
        }
    </style>
    <script>
        function toggleBranch() {
            const role = document.getElementById("designation").value;
            document.getElementById("branchDiv").style.display = (role === "HOD" || role === "GDC") ? "block" : "none";
        }

        function togglePassword() {
            const passField = document.getElementById("password");
            const icon = document.getElementById("toggleIcon");
            if (passField.type === "password") {
                passField.type = "text";
                icon.textContent = "🙈";
            } else {
                passField.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>
</head>
<body>
    <div class="login-container">
        <h2>KLECET Login</h2>
        <?php if (!empty($errorMsg)) echo "<div class='error'>$errorMsg</div>"; ?>
        <form method="POST">
            <label>Mobile:</label>
            <input type="tel" name="mobile" pattern="[0-9]{10}" placeholder="10-digit mobile" required>

            <label>Password:</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" required>
                <span class="toggle-password" id="toggleIcon" onclick="togglePassword()">👁️</span>
            </div>

            <label>Designation:</label>
            <select name="designation" id="designation" required onchange="toggleBranch()">
                <option value="">-- Select --</option>
                <option value="Principal">Principal</option>
                <option value="GCC">GCC</option>
                <option value="HOD">HOD</option>
                <option value="GDC">GDC</option>
                <option value="Student">Student</option>
            </select>

            <div id="branchDiv" style="display:none;">
                <label>Department / Branch:</label>
                <select name="branch">
                    <option value="">-- Select Branch --</option>
                    <option value="CSE">CSE</option>
                    <option value="MECH">MECH</option>
                    <option value="CIVIL">CIVIL</option>
                    <option value="ECE">E&C</option>
                    <option value="MBA">MBA</option>
                    <option value="MCA">MCA</option>
                </select>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
