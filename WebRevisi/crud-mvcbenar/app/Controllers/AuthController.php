<?php

class AuthController {

    
    public function login(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        require_once __DIR__ . '/../Views/login.php';
    }

    
    public function loginProcess(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        
        require_once __DIR__ . '/../../config/database.php'; 
        require_once __DIR__ . '/../Models/User.php';

        
        $database = new Database();
        $conn = $database->getConnection();

        
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $userModel = new User($conn);
        $user = $userModel->findUser($username); 
        
        if ($user && $password === $user['password']) {
            $_SESSION['user'] = [
                'username' => $user['username'],
                'id' => $user['id'] 
            ];
            $_SESSION['status'] = 'login';

            
            header("Location: index.php?action=dashboard");
            exit();

        } else {
            
            
            $_SESSION['error_message'] = "Username atau password salah!";
            header("Location: index.php?action=login");
            exit();
        }
    }

    
    public function logout() {
        
        session_start();
        session_unset();
        session_destroy();
        
        
        header("Location: index.php?action=login");
        exit();
    }
        
}