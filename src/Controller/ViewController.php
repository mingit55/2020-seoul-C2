<?php
namespace Controller;

use App\DB;

class ViewController {
    
    function main(){
        view("main");    
    }

    /**
     * 회원관리
     */
    function signUp(){
        view("sign-up");
    }

    function signIn(){
        view("sign-in");
    }


    /**
     * 전주한지문화축제
     */
    function intro(){
        view("intro");
    }   

    function roadmap(){
        view("roadmap");
    }

    /**
     * 축제공지사항
     */
    function notices(){
        view("notices", [
            "notices" => pagination(
                DB::fetchAll("SELECT * FROM notices ORDER BY id DESC")
            )
        ]);
    }
    function notice($id){
        $notice = DB::find("notices", $id);
        if(!$notice) back("공지사항을 찾을 수 없습니다.");
        $notice->files = json_decode($notice->files);

        view("notice", [
            "notice" => $notice
        ]);
    }

    function inquires(){
        if(admin()) $this->inquires__admin();
        else $this->inquires__user();
    }
    function inquires__admin(){
        view("inquires--admin", [
            "inquires" => DB::fetchAll("SELECT I.*, A.id answered
                                        FROM inquires I 
                                        LEFT JOIN answers A ON A.iid = I.id"),
        ]);
    }
    function inquires__user(){
        view("inquires--user", [
            "inquires" => DB::fetchAll("SELECT I.*, A.id answered
            FROM inquires I 
            LEFT JOIN answers A ON A.iid = I.id
            WHERE I.uid = ?", [user()->id]),           
        ]);
    }

    /**
     * 한지상품판매관
     */
    function store(){
        view("store");       
    }
    
    function companies(){
        $companies = DB::fetchAll("SELECT U.*, IFNULL(totalPoint, 0) totalPoint
                                    FROM users U
                                    LEFT JOIN (SELECT SUM(point) totalPoint, uid FROM history GROUP BY uid) H ON H.uid = U.id
                                    WHERE U.type = 'company'
                                    ORDER BY totalPoint DESC");

        view("companies", [
            "rankers" => array_slice($companies, 0, 4),
            "companies" => pagination(array_slice($companies, 4))
        ]);
    }

    /**
     * 한지 공예대전
     */
    function entry(){
        view("entry");
    }

    function artworks(){
        $checkTime = date("Y-m-d", strtotime("-7 Day"));
        $func = function($artwork){
            $artwork->hashTags = json_decode($artwork->hashTags);
            return $artwork;
        };

        $artworks = array_map($func, DB::fetchAll("SELECT DISTINCT A.*, U.user_name, U.type, IFNULL(score, 0) score
                            FROM artworks A 
                            LEFT JOIN users U ON U.id = A.uid
                            LEFT JOIN (SELECT ROUND(AVG(score)) score, aid FROM scores GROUP BY aid) S ON S.aid = A.id
                            WHERE A.rm_reason IS NULL
                            ORDER BY id DESC"));
        global $tags;
        $tags = isset($_GET['tags']) ? json_decode($_GET['tags']) : [];
        if(count($tags) > 0){
            $artworks = array_filter($artworks, function($artwork){
                global $tags;
                return count(array_diff($tags, $artwork->hashTags)) !== count($artwork->hashTags);
            });
        }

        view("artworks", [
            "myList" => !user() ? [] :  array_map($func, DB::fetchAll("SELECT DISTINCT A.*, U.user_name, U.type, IFNULL(score, 0) score
                            FROM artworks A 
                            LEFT JOIN users U ON U.id = A.uid
                            LEFT JOIN (SELECT ROUND(AVG(score)) score, aid FROM scores GROUP BY aid) S ON S.aid = A.id
                            WHERE A.uid = ?
                            ORDER BY id DESC", [user()->id])),
            "rankers" => array_map($func, DB::fetchAll("SELECT DISTINCT A.*, U.user_name, U.type, IFNULL(score, 0) score
                            FROM artworks A 
                            LEFT JOIN users U ON U.id = A.uid
                            LEFT JOIN (SELECT ROUND(AVG(score)) score, aid FROM scores GROUP BY aid) S ON S.aid = A.id
                            WHERE A.created_at >= ? AND A.rm_reason IS NULL
                            ORDER BY score DESC
                            LIMIT 0, 4", [$checkTime])),
            "artworks" => pagination($artworks),
            "tags" => $tags
        ]);
    }

    function artwork($id){
        $artwork = DB::fetch("SELECT DISTINCT A.*, U.id uid, user_name, user_email, U.image user_image, type, IFNULL(score, 0) score, M.aid reviewed
                            FROM artworks A
                            LEFT JOIN users U ON U.id = A.uid
                            LEFT JOIN (SELECT ROUND(AVG(score)) score, aid FROM scores GROUP BY aid) S ON S.aid = A.id
                            LEFT JOIN (SELECT aid FROM scores WHERE uid = ?) M ON M.aid = A.id
                            WHERE A.id = ?", [user()->id, $id]);
        $artwork->hashTags = json_decode($artwork->hashTags);

        if(!$artwork || $artwork->rm_reason) 
            back("대상이 존재하지 않습니다.");
        
        view("artwork", compact("artwork"));
    }
}