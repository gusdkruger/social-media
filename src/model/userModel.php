<?php
    include __DIR__ . "/../connection/connection.php";

    class UserModel {

        public static function login($email, $password) {
            $conn = DatabaseConnection::connect();
            $stmt = $conn->prepare("SELECT password FROM user WHERE email='$email';");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result) {
                $passwordHash = $result["password"];
                if(password_verify($password, $passwordHash)) {
                    echo "Loged successfully";
                }
                else {
                    echo "Email not registred or incorrect password";
                }
            }
            else {
                echo "Email not registred or incorrect password";
            }
            DatabaseConnection::closeConnection($conn);
        }

        public static function register($handle, $email, $passwordHash) {
            $conn = DatabaseConnection::connect();
            $sql = "INSERT INTO user (handle, email, password) VALUES ('$handle', '$email', '$passwordHash');";
            try {
                $conn -> exec($sql);
                echo "User created successfully";
            }
            catch (PDOException $e) {
                echo $e;
            }
            DatabaseConnection::closeConnection($conn);
        }
    }
?>
