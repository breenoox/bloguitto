<?php

namespace src\app\controllers;

require_once __DIR__ . "/../models/Users.php";

use src\app\models\Users;

class UsersController
{
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new Users();
            $user = $userModel->find("email = :email", "email={$email}")->fetch();

                if ($user && password_verify($password, $user->password)) {
                    session_start();
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['user_name'] = $user->first_name;
    
                    header('Location: ' . URL_BASE);
                    exit;
                } else {
                    $error_message =  "Email ou senha incorretos";
                }        
        } 
        require __DIR__ . "/../../../views/login.php";
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = $_POST['first_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $userModel = new Users();
            $existingUser = $userModel->find("email = :email", "email={$email}")->fetch();
    
            if($existingUser) {
                echo "Este email já está em uso";
                return;
            }
    
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);
    
            $newUser = new Users();
            $newUser->first_name = $first_name;
            $newUser->email = $email;
            $newUser->password = $hashedPass;
    
            if($newUser->save()) {
                echo "Usuário criado com sucesso";
                header('Location: /bloguitto/login');
                exit;
            } else {
                echo "Erro ao criar usuário";
            }
        }
        require __DIR__ . "/../../../views/register.php";
    }

    public function checkLogin() 
    {
        session_start();
        if(!isset($_SESSION['user_id'])){
            header('Location: /bloguitto/login');
            exit;
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /bloguitto/login');
        exit;
    }
}