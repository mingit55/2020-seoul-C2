<!-- 비주얼 영역 -->
<div class="position-relative">
    <div class="background background--black">
        <img src="/images/48.jpg" alt="비주얼 이미지" title="비주얼 이미지">
    </div>
    <div class="visual__content container">
        <div class="text-center padding">
            <div class="fx-n1 text-gray">전주한지문화축제</div>
            <div class="fx-7 text-white font-weight-bold mt-3">회원가입</div>
        </div>
    </div>
</div>
<!-- /비주얼 영역 -->

<div class="container padding">
    <form id="sign-up" class="col-8 mx-auto" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="user_email">이메일</label>
            <input type="text" id="user_email" class="form-control" name="user_email">
            <small class="error text-red"></small>
        </div>
        <div class="form-group">
            <label for="password">비밀번호</label>
            <input type="password" id="password" class="form-control" name="password">
            <small class="error text-red"></small>
        </div>
        <div class="form-group">
            <label for="passconf">비밀번호 확인</label>
            <input type="password" id="passconf" class="form-control" name="passconf">
            <small class="error text-red"></small>
        </div>
        <div class="form-group">
            <label for="user_name">이름</label>
            <input type="text" id="user_name" class="form-control" name="user_name">
            <small class="error text-red"></small>
        </div>
        <div class="form-group">
            <label for="image">프로필 사진</label>
            <input type="file" id="image" class="form-control" name="image">
            <small class="error text-red"></small>
        </div>
        <div class="form-group">
            <label for="type">회원 유형</label>
            <select name="type" id="type" class="form-control">
                <option value="normal">일반 회원</option>
                <option value="company">기업 회원</option>
            </select>
            <small class="error text-red"></small>
        </div>
        <div class="form-group text-right">
            <button class="btn-filled">회원가입</button>
        </div>
    </form>
</div>
<script src="/js/sign-up.js"></script>