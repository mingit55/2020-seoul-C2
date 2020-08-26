<!-- 비주얼 영역 -->
<div class="position-relative">
    <div class="background background--black">
        <img src="./images/48.jpg" alt="비주얼 이미지" title="비주얼 이미지">
    </div>
    <div class="visual__content container">
        <div class="text-center padding">
            <div class="fx-n1 text-gray">한지상품판매관</div>
            <div class="fx-7 text-white font-weight-bold mt-3">온라인스토어</div>
        </div>
    </div>
</div>
<!-- /비주얼 영역 -->

<!-- 검색 영역 -->
<div class="container pt-4">
    <div class="py-2 px-2 border">
        <div class="text-red">상품 검색</div>
        <div class="d-center mt-2">
            <div id="search_tags" class="w-100"></div>
            <span class="btn-search icon ml-2 text-red">
                <i class="fa fa-search"></i>
            </span>
        </div>
    </div>
</div>
<!-- /검색 영역 -->

<!-- 상품 리스트 영역 -->
<div class="container py-5">
    <div class="d-between">
        <div>
            <hr class="bg-red">
            <div class="title text-red">상품 목록</div>
        </div>
        <?php if(company()):?>
            <button class="btn-bordered" data-target="#add-modal" data-toggle="modal">상품 등록 +</button>
        <?php endif;?>
    </div>
    <div id="store" class="row mt-4"></div>
</div>
<!-- /상품 리스트 영역 -->

<!-- 상품 구매 영역 -->
<div class="container py-5 border-top">
    <hr class="bg-yellow">
    <div class="title text-yellow">장바구니</div>
    <div class="t-head mt-4">
        <div class="cell-50">상품 정보</div>
        <div class="cell-20">수량</div>
        <div class="cell-20">합계 포인트</div>
        <div class="cell-10">-</div>
    </div>
    <div id="cart">
        
    </div>
    <div class="d-between">
        <div>
            <span class="fx-n2 text-muted">총 합계</span>
            <span id="total-price" class="ml-3 fx-4 text-red">0</span>
            <span class="fx-1">p</span>
        </div>
        <div>
            <span class="fx-n2 text-muted">보유포인트</span>
            <span id="total-price" class="ml-3 fx-4 text-red"><?=user()->point?></span>
            <span class="fx-1">p</span>
        </div>
        <form method="post">
            <input type="hidden" id="buyList" name="buyList">
            <input type="hidden" id="totalPoint" name="totalPoint">
            <input type="hidden" id="totalCount" name="totalCount">
            <button id="btn-accept" class="btn-bordered">구매하기 <i class="fa fa-shopping-cart"></i></button>
        </form>
    </div>
</div>
<!-- /상품 구매 영역 -->

<!-- 상품 추가 모달 -->
<form id="add-modal" class="modal fade" enctype="multipart/form-data" action="/insert/papers" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="fx-4 text-red">상품 등록</div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" id="add_base64">
                    <label for="add_image">이미지</label>
                    <input type="file" id="add_image" name="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="add_name">이름</label>
                    <input type="text" id="add_name" class="form-control" name="paper_name" required>
                </div>
                <div class="form-group">
                    <label for="add_company">업체명</label>
                    <input type="text" id="add_company" class="form-control" name="company_name" value="<?=user()->user_name?>" readonly required>
                </div>
                <div class="form-group d-flex">
                    <div class="w-50 pr-2">
                        <label for="add_width">가로 사이즈</label>
                        <input type="number" id="add_width" class="form-control" name="width_size" min="100" max="1000" required>
                    </div>
                    <div class="w-50 pl-2">
                        <label for="add_height">세로 사이즈</label>
                        <input type="number" id="add_height" class="form-control" name="height_size" min="100" max="1000" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="add_point">포인트</label>
                    <input type="number" id="add_point" class="form-control" name="point" min="10" max="1000" step="10" required>
                </div>
                <div class="form-group">
                    <label>해시태그</label>
                    <div id="add_tags" data-name="hashTags"></div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button class="btn-filled">추가 완료</button>
            </div>
        </div>
    </div>
</form>
<!-- /상품 추가 모달 -->

<script src="./js/store.js"></script>