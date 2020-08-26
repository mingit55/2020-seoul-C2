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


    /**
     * 축제 공지사항
     */
    function insertNotice(){
        checkEmpty();
        extract($_POST);

        $files = $_FILES['files'];
        $filenames = [];
        $fileLength = count($files['name']);
        for($i = 0; $i < $fileLength; $i++){
            if(!$files['name'][$i]) break;
            $name = $files['name'][$i];
            $tmp_name = $files['tmp_name'][$i];
            $size = $files['size'][$i];
            $filename = time() ."-" . $name;
            $filenames[] = $filename;

            if($size > 10 * 1024 * 1024) back("10MB 이하의 파일만 업로드 가능합니다.");
            if($i >= 4) back("파일은 4개까지만 업로드 가능합니다.");

            move_uploaded_file($tmp_name, UPLOAD."/$filename");
        }

        DB::query("INSERT INTO notices(title, content, files, created_at) VALUES (?, ?, ?, NOW())", [$title, $content, json_encode($filenames)]);

        go("/notices", "공지사항을 작성했습니다.");
    }

    function deleteNotice($id){
        $notice = DB::find("notices", $id);
        if(!$notice) back("공지사항을 찾을 수 없습니다.");

        DB::query("DELETE FROM notices WHERE id = ?", [$id]);
        go("/notices", "공지사항을 삭제했습니다.");
    }
    
    function updateNotice($id){
        $notice = DB::find("notices", $id);
        if(!$notice) back("공지사항을 찾을 수 없습니다.");
        checkEmpty();
        extract($_POST);

        $files = $_FILES['files'];
        $filenames = json_decode($notice->files);
        $fileLength = count($files['name']);
        if($fileLength > 0 && $files['name'][0] !== ""){
            $filenames = [];
            for($i = 0; $i < $fileLength; $i++){
                if(!$files['name'][$i]) break;
                $name = $files['name'][$i];
                $tmp_name = $files['tmp_name'][$i];
                $size = $files['size'][$i];
                $filename = time() ."-" . $name;
                $filenames[] = $filename;
    
                if($size > 10 * 1024 * 1024) back("10MB 이하의 파일만 업로드 가능합니다.");
                if($i >= 4) back("파일은 4개까지만 업로드 가능합니다.");
    
                move_uploaded_file($tmp_name, UPLOAD."/$filename");
            }
        }

        DB::query("UPDATE notices SET title = ?, content = ?, files = ? WHERE id = ?", [$title, $content, json_encode($filenames), $id]);

        go("/notices/$id", "파일을 수정했습니다.");
    }

    function downloadFile($filename){
        $filepath = UPLOAD."/$filename";
        if(is_file($filepath)){
            $file = fileinfo($filename);
            header("Content-Disposition: attachement; filename={$file->name}");
            readfile($filepath);
        }
    }

    function insertInquire(){
        checkEmpty();
        extract($_POST);

        DB::query("INSERT INTO inquires(title, content, uid) VALUES (?, ?, ?)", [$title, $content, user()->id]);
        go("/inquires", "문의가 완료되었습니다.");
    }

    function insertAnswer(){
        checkEmpty();
        extract($_POST);

        DB::query("INSERT INTO answers(iid, comment) VALUES (?, ?)", [$iid, $comment]);
        go("/inquires", "답변을 작성했습니다.");
    }

    /**
     * 한지상품판매관
     */
    function insertPaper(){
        checkEmpty();
        extract($_POST);

        $image = $_FILES['image'];
        $filename = time() . "-". $image['name'];
        move_uploaded_file($image['tmp_name'], UPLOAD."/$filename");

        DB::query("INSERT INTO papers(paper_name, uid, width_size, height_size, point, hashTags, image) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)",[
                                    $paper_name, user()->id, $width_size, $height_size, $point, $hashTags, $filename
                                ]);

        $pid = DB::lastInsertId();
        DB::query("INSERT INTO inventory(pid, uid, count) VALUES (?, ?, -1)", [$pid, user()->id]);

        go("/store", "한지가 추가되었습니다.");
    }

    function shopping(){
        checkEmpty();
        extract($_POST);

        if(user()->point < $totalPoint) back("포인트가 부족하여 구매하실 수 없습니다.");

        $buyList = json_decode($buyList);
        
        foreach($buyList as $buyItem){
            $paper = DB::find("papers", $buyItem->id);
            $totalPoint = $paper->point * $buyItem->buyCount;
            $hasItem = DB::fetch("SELECT * FROM inventory WHERE pid = ? AND uid = ?", [$buyItem->id, user()->id]);
            
            if($hasItem) DB::query("UPDATE inventory SET count = count + ? WHERE id = ? ", [$buyItem->buyCount, $buyItem->id]);
            else DB::query("INSERT INTO inventory (uid, pid, count) VALUES (? ,? ,?)", [user()->id, $buyItem->id, $buyItem->buyCount]);

            DB::query("UPDATE users SET point = point - ? WHERE id = ?", [$totalPoint, user()->id]);
            DB::query("UPDATE users SET point = point + ? WHERE id = ?", [$totalPoint, $paper->uid]);
            DB::query("INSERT INTO history(uid, point) VALUES (?, ?)", [$paper->uid, $totalPoint]);
        }

        go("/store", "총 {$totalCount}개의 한지가 구매되었습니다.");
    }

    /**
     * 한지공예대전
     */
    function updateInventory($id){
        extract($_POST);
        $exist = DB::find("inventory", $id);
        if(!$exist || $exist->uid !== user()->id || !isset($count)) exit;

        DB::query("UPDATE inventory SET count = ? WHERE id = ?", [$count, $id]);
    }

    function deleteInventory($id){
        extract($_POST);
        $exist = DB::find("inventory", $id);
        if(!$exist || $exist->uid !== user()->id) exit;

        DB::query("DELETE FROM inventory WHERE id = ?", [$id]);
    }

    function insertArtwork(){
        checkEmpty();
        extract($_POST); 

        $filename = upload_base64($image);
        DB::query("INSERT INTO artworks(uid, title, description, image, hashTags) VALUES (?, ?, ?, ?, ?)", [user()->id, $title, $description, $filename, $hashTags]);
        
        go("/artworks", "등록되었습니다.");
    }

    function deleteArtwork($id){
        $artwork = DB::find("artworks", $id);
        if(!$artwork || $artwork->uid !== user()->id) back("삭제할 대상을 찾을 수 없습니다.");
        
        DB::query("DELETE FROM artworks WHERE id = ?" ,[$id]);
        go("/artworks", "삭제되었습니다.");
    }

    function updateArtwork($id){
        $artwork = DB::find("artworks", $id);
        if(!$artwork || $artwork->uid !== user()->id) back("삭제할 대상을 찾을 수 없습니다.");

        checkEmpty();
        extract($_POST);       
        
        DB::query("UPDATE artworks SET title = ?, description = ?, hashTags = ? WHERE id = ?", [$title, $description, $hashTags, $id]);
        go("/artworks/$id", "반영되었습니다.");
    }

    function insertScore(){
        checkEmpty();
        extract($_POST);
    
        $artwork = DB::find("artworks", $aid);
        if(!$artwork) back("대상을 찾을 수 없습니다.");

        DB::query("INSERT INTO scores (uid, aid, score) VALUES (?, ?, ?)", [user()->id, $artwork->id, $score]);
        go("/artworks/$aid");
    }
}