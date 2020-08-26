<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>전주한지문화축제</title>
    <script src="/js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/common.js"></script>
</head>
<body>
    <!-- 헤더 영역 -->
    <input type="checkbox" id="open-aside" hidden>
    <header>
        <div class="container d-between h-100">
            <div class="d-flex align-items-center">
                <a href="/">
                    <img src="/images/Wlogo.svg" alt="전주한지문화축제" title="전주한지문화축제" height="50">
                </a>
                <div class="header-nav d-none d-lg-flex ml-4">
                    <div class="header-nav__item">
                        <a href="#">전주한지문화축제</a>
                        <div class="header-nav__list">
                            <a href="/intro">개요/연혁</a>
                            <a href="/roadmap">찾아오시는길</a>
                        </div>
                    </div>
                    <div class="header-nav__item">
                        <a href="#">한지상품판매관</a>
                        <div class="header-nav__list">
                            <a href="/companies">한지업체</a>
                            <a href="/store">온라인스토어</a>
                        </div>
                    </div>
                    <div class="header-nav__item">
                        <a href="#">한지공예대전</a>
                        <div class="header-nav__list">
                            <a href="/entry">출품신청</a>
                            <a href="/artworks">참가작품</a>
                        </div>
                    </div>
                    <div class="header-nav__item">
                        <a href="#">축제공지사항</a>
                        <div class="header-nav__list">
                            <a href="/notices">알려드립니다</a>
                            <a href="/inquires">1:1문의</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-util d-none d-lg-flex">
                <?php if(user()):?>
                    <a href="#"><?=user()->user_name?>(<?=user()->point?>p)</a>
                    <a href="/logout">로그아웃</a>
                <?php else:?>
                    <a href="/sign-in">로그인</a>
                    <a href="/sign-up">회원가입</a>
                <?php endif;?>
            </div>
            <label for="open-aside" class="icon d-lg-none text-gray">
                <i class="fa fa-bars fa-lg"></i>
            </label>
        </div>
    </header>
    <label class="aside__background" for="open-aside"></label>
    <aside class="d-lg-none">
        <div class="aside__content">
            <div class="aside-util d-between">
                <?php if(user()):?>
                    <div class="text-muted text-ellipsis">
                        <?=user()->user_name?>(<?=user()->point?>p)
                    </div>
                    <div>
                        <a href="/logout">로그아웃</a>
                    </div>
                <?php else:?>
                    <div class="text-muted text-ellipsis">
                        로그인이 필요합니다.
                    </div>
                    <div>
                        <a href="/sign-in">로그인</a>
                        <a href="/sign-up">회원가입</a>
                    </div>
                <?php endif;?>
            </div>
            <div class="aside-nav">
                <div class="header-nav__item">
                    <a href="#">전주한지문화축제</a>
                    <div class="header-nav__list">
                        <a href="/intro">개요/연혁</a>
                        <a href="/roadmap">찾아오시는길</a>
                    </div>
                </div>
                <div class="header-nav__item">
                    <a href="#">한지상품판매관</a>
                    <div class="header-nav__list">
                        <a href="/companies">한지업체</a>
                        <a href="/store">온라인스토어</a>
                    </div>
                </div>
                <div class="header-nav__item">
                    <a href="#">한지공예대전</a>
                    <div class="header-nav__list">
                        <a href="/entry">출품신청</a>
                        <a href="/artworks">참가작품</a>
                    </div>
                </div>
                <div class="header-nav__item">
                    <a href="#">축제공지사항</a>
                    <div class="header-nav__list">
                        <a href="/notices">알려드립니다</a>
                        <a href="/inquires">1:1문의</a>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- /헤더 영역 -->