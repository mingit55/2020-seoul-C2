<?php
namespace Controller;

use App\DB;

class ApiController {
    function getUser($user_email){
        json_response(
            DB::who($user_email)
        );       
    }

    function getInquire($id){
        json_response(
            DB::fetch("SELECT DISTINCT I.*, user_name, user_email, A.comment answer, A.created_at answered_at
                        FROM inquires I
                        LEFT JOIN answers A ON A.iid = I.id
                        LEFT JOIN users U ON U.id = I.uid
                        WHERE I.id = ?", [$id])
        );
    }

    function getPapers(){
        json_response(
            array_map(function($paper){
                $paper->hashTags = json_decode($paper->hashTags);
                return $paper;
            }, DB::fetchAll("SELECT P.*, user_name company_name
                            FROM papers P
                            LEFT JOIN users U ON U.id = P.uid
                            ORDER BY id ASC"))
        );
    }

    function getInventory(){
        json_response(
            DB::fetchAll("SELECT I.id, count, paper_name, width_size, height_size, CONCAT('/uploads/', image) image
                        FROM inventory I
                        LEFT JOIN papers P ON P.id = I.pid
                        WHERE I.uid = ?", [user()->id])
        );
    }
}