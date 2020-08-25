<?php
namespace Controller;

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
        view("notices");
    }
}