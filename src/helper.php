<?php
use App\DB;

function dump(){
    foreach(func_get_args() as $arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}
function dd(){
    foreach(func_get_args() as $arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
    exit;
}

function user(){
    if(isset($_SESSION['user'])){
        $user = DB::who($_SESSION['user']->user_email);
        if(!$user) {
            unset($_SESSION['user']);
            go("/", "회원 정보를 찾을 수 없습니다. 로그아웃 됩니다.");       
        }
        $_SESSION['user'] = $user;
        return $user;
    } else {
        return false;       
    }
}
function company(){
    return user() && user()->type === "company" ? user() : null;
}
function admin(){
    return user() && user()->type === "admin" ? user() : null;
}


function go($url, $message = ""){
    echo "<script>";
    if($message) echo "alert('$message');";
    echo "location.href='$url';";
    echo "</script>";
    exit;
}

function back($message = ""){
    echo "<script>";
    if($message) echo "alert('$message');";
    echo "history.back();";
    echo "</script>";
    exit;
}

function json_response($data){
    header("Content-Type: application/json");
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function view($viewName, $data = []){
    extract($data);
    require VIEW."/header.php";
    require VIEW."/$viewName.php";
    require VIEW."/footer.php";
}

function checkEmpty(){
    foreach($_POST as $input){
        if(trim($input) === "") back("모든 정보를 입력해 주세요.");
    }
}

function extname($filename){
    return substr($filename, strrpos($filename, "."));
}

function enc($data){
    return nl2br(str_replace(" ", "&nbsp;", htmlentities($data)));
}

function pagination($data){
    define("PAGE__COUNT", 9);
    define("PAGE__BCOUNT", 5);

    $page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] >= 1 ? $_GET['page'] : 1;
    
    $totalPage = ceil(count($data) / PAGE__COUNT);
    $currentBlock = ceil($page / PAGE__BCOUNT);
    
    $start = ($currentBlock - 1) * PAGE__BCOUNT + 1;
    $end = $start + PAGE__BCOUNT - 1;
    $end = $end > $currentBlock ? $currentBlock : $end;

    $prevNo = $start - 1;
    $prev = $prevNo >= 1;
    $nextNo = $end + 1;
    $next = $nextNo <= $totalPage;

    $data = array_slice($data, ($page - 1) * PAGE__COUNT, PAGE__COUNT);
    
    return (object)compact("data", "start", "end", "prevNo", "prev", "nextNo", "next");
}

function fileinfo($filename){
    $filepath = UPLOAD."/$filename";
    if(is_file($filepath)){
        $name = substr($filename, strpos($filename, "-") + 1);
        $size = number_format((filesize($filepath) / 1024), 2);
        $type = mime_content_type($filepath);
        return (object)compact("name", "size", "type");
    }
}

function upload_base64($base64){
    $temp = explode("base64,", $base64);
    $data = base64_decode($temp[1]);
    $temp = explode("image/", $temp[0]);
    $type = $temp[1];

    $filename = time().".$type";
    
    file_put_contents(UPLOAD."/$filename", $data);
    return $filename;
}