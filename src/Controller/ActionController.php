<?php
namespace Controller;

use App\DB;

class ActionController {
    function addAdmin(){
        $exist = DB::who("admin");
        if(!$exist){
            DB::query("INSERT INTO users(user_email, password, user_name, type) VALUES (?, ?, ?, ?)", [
                "admin", hash("sha256", "1234"), "관리자", "admin"
            ]);
        }
    }

    function signUp(){
        checkEmpty();
        extract($_POST);

        $file = $_FILES['image'];
        $filename = time() . "-" . $file['name'];
        move_uploaded_file($file['tmp_name'], UPLOAD."/$filename");
        
        DB::query("INSERT INTO users (user_email, password, user_name, image, type) VALUES (?, ?, ?, ?, ?)", [$user_email, hash("sha256", $password), $user_name, $filename, $type]);
        go("/", "회원가입 되었습니다.");
    }

    function signIn(){
        checkEmpty();
        extract($_POST);

        $exist = DB::who($user_email);
        if(!$exist) back("아이디와 일치하는 회원이 존재하지 않습니다.");
        if($exist->password !== hash("sha256", $password)) back("비밀번호가 일치하지 않습니다.");

        $_SESSION['user'] = $exist;

        go("/", "로그인 되었습니다.");
    }

    function logout(){
        unset($_SESSION['user']);
        go("/", "로그아웃 되었습니다.");
    }
}