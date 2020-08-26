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
Router::get("/store", "ViewController@store", "user");

Router::post("/insert/papers", "ActionController@insertPaper", "company");
Router::post("/store", "ActionController@shopping", "user");

// 한지공예대전
Router::get("/entry", "ViewController@entry", "user");
Router::get("/artworks", "ViewController@artworks");
Router::get("/artworks/{id}", "ViewController@artwork");

Router::post("/delete/inventory/{id}", "ActionController@deleteInventory", "user");
Router::post("/update/inventory/{id}", "ActionController@updateInventory", "user");

Router::post("/entry", "ActionController@insertArtwork");


// 축제공지사항
Router::get("/notices", "ViewController@notices");
Router::get("/notices/{id}", "ViewController@notice");
Router::get("/inquires", "ViewController@inquires");

Router::post("/insert/notice", "ActionController@insertNotice", "admin");
Router::post("/update/notice/{id}", "ActionController@updateNotice", "admin");
Router::get("/delete/notice/{id}", "ActionController@deleteNotice", "admin");
Router::post("/insert/inquire", "ActionController@insertInquire", "user");
Router::post("/insert/answer", "ActionController@insertAnswer", "admin");
Router::get("/delete/artwork/{id}", "ActionController@deleteArtwork", "user");
Router::post("/update/artwork/{id}", "ActionController@updateArtwork", "user");
Router::post("/insert/score", "ActionCOntroller@insertScore", "user");

// API
Router::get("/api/users/{user_email}", "ApiController@getUser");
Router::get("/api/inquires/{id}", "ApiController@getInquire");
Router::get("/api/papers", "ApiController@getPapers");
Router::get("/api/inventory", "ApiController@getInventory");

// other
Router::get("/init/admin", "ActionController@addAdmin");
Router::get("/download/{filename}", "ActionController@downloadFile");

Router::start();