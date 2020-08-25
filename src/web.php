<?php
use App\Router;

Router::get("/", "ViewController@main");

// 전주한지문화축제
Router::get("/intro", "ViewController@intro");
Router::get("/roadmap", "ViewController@roadmap");

// 회원관리
Router::get("/sign-in", "ViewController@signIn");
Router::get("/sign-up", "ViewController@signUp");

Router::post("/sign-up", "ActionController@signUp");
Router::post("/sign-in", "ActionController@signIn");
Router::get("/logout", "ActionController@logout");

// 한지상품판매관
Router::get("/companies", "ViewController@companies");
Router::get("/store", "ViewController@store");

// 한지공예대전
Router::get("/entry", "ViewController@entry");
Router::get("/artworks", "ViewController@artworks");

// 축제공지사항
Router::get("/notices", "ViewController@notices");
Router::get("/inquires", "ViewController@inquires");

// API
Router::get("/api/users/{user_email}", "ApiController@getUser");

Router::get("/init/admin", "ActionController@addAdmin");

Router::start();