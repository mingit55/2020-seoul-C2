<!-- 비주얼 영역 -->
<div class="position-relative">
    <div class="background background--black">
        <img src="/images/48.jpg" alt="비주얼 이미지" title="비주얼 이미지">
    </div>
    <div class="visual__content container">
        <div class="text-center padding">
            <div class="fx-n1 text-gray">한지공예대전</div>
            <div class="fx-7 text-white font-weight-bold mt-3">출품신청</div>
        </div>
    </div>
</div>
<!-- /비주얼 영역 -->

<!-- 공예 작업 & 도구 영역 -->
<div class="container-fluid py-5">
    <div class="workspace__outer">
        <div id="workspace">
            <canvas width="1150" height="600"></canvas>
        </div>
        <div class="tool">
            <div class="tool__item" title="선택" data-tool="select">
                <i class="fa fa-mouse-pointer"></i>
            </div>
            <div class="tool__item" title="회전" data-tool="spin">
                <i class="fa fa-repeat"></i>
            </div>
            <div class="tool__item" title="자르기" data-tool="cut">
                <i class="fa fa-cut"></i>
            </div>
            <div class="tool__item" title="붙이기" data-tool="glue">
                <i class="fa fa-object-ungroup"></i>
            </div>
            <div class="tool__item" data-target="#list-modal" data-toggle="modal" title="추가">
                <i class="fa fa-plus"></i>
            </div>
            <div class="tool__item" data-role="remove" title="삭제">
                <i class="fa fa-trash"></i>
            </div>
        </div>
    </div>
</div>
<!-- /공예 작업 & 도구 영역 -->

<!-- 출품 정보 입력 & 도움말 영역 -->
<div class="container pb-5">
    <div class="row">
        <div class="col-lg-5">
            <hr>
            <div class="title">출품하기</div>
            <form id="entry" class="mt-5" method="post">
                <input type="hidden" id="image" name="image">
                <div class="form-group">
                    <input type="text" id="title" class="form-control" name="title" placeholder="제목" required>
                </div>
                <div class="form-group">
                    <textarea name="description" id="description" cols="30" rows="2" class="form-control" placeholder="설명"></textarea>
                </div>
                <div class="form-group">
                    <div id="entry-tags" data-name="hashTags"></div>
                </div>
                <div class="form-group text-right">
                    <button class="btn-filled">출품하기</button>
                </div>
            </form>
        </div>
        <div class="col-lg-7">
            <hr>
            <div class="title">도움말</div>
            <div class="help mt-5">
                <input type="radio" id="tab-select" name="help" hidden checked>
                <input type="radio" id="tab-spin" name="help" hidden>
                <input type="radio" id="tab-cut" name="help" hidden>
                <input type="radio" id="tab-glue" name="help" hidden>
                <div class="help-search">
                    <input type="text" placeholder="검색어를 입력하세요">
                    <button class="search"><i class="fa fa-search"></i></button>
                    <button class="prev"><i class="fa fa-angle-left"></i></button>
                    <button class="next"><i class="fa fa-angle-right"></i></button>
                    <span class="fx-n2 text-muted ml-2"></span>
                </div>
                <div class="help-tabs">
                    <label for="tab-select" class="help-tab select">선택</label>
                    <label for="tab-spin" class="help-tab spin">회전</label>
                    <label for="tab-cut" class="help-tab cut">자르기</label>
                    <label for="tab-glue" class="help-tab glue">붙이기</label>
                </div>
                <div class="help-body">
                    <div class="help-item select" data-type="select">
                        선택 도구는 가장 기본적인 도구로써, 작업 영역 내의 한지를 선택할 수 있게 합니다. 
                        마우스 클릭으로 한지를 활성화하여 이동시킬 수 있으며, 선택된 한지는 삭제 버튼으로 삭제시킬 수 있습니다.
                    </div>
                    <div class="help-item spin" data-type="spin">
                        회전 도구는 작업 영역 내의 한지를 회전할 수 있는 도구입니다. 
                        마우스 더블 클릭으로 회전하고자 하는 한지를 선택하면, 좌우로 마우스를 끌어당겨 회전시킬 수 있습니다. 
                        회전한 뒤에는 우 클릭의 콘텍스트 메뉴로 '확인'을 눌러 한지의 회전 상태를 작업 영역에 반영할 수 있습니다.
                    </div>
                    <div class="help-item cut" data-type="cut">
                        자르기 도구는 작업 영역 내의 한지를 자를 수 있는 도구입니다. 
                        마우스 더블 클릭으로 자르고자 하는 한지를 선택하면 마우스를 움직임으로써 자르고자 하는 궤적을 그릴 수 있습니다. 
                        궤적을 그린 뒤에는 우 클릭의 콘텍스트 메뉴로 '자르기'를 눌러 그려진 궤적에 따라 한지를 자를 수 있습니다.
                    </div>
                    <div class="help-item glue" data-type="glue">
                        붙이기 도구는 작업 영역 내의 한지들을 붙일 수 있는 도구입니다.
                        마우스 더블 클릭으로 붙이고자 하는 한지를 선택하면 처음 선택한 한지와 근접한 한지들을 선택할 수 있습니다. 
                        붙일 한지를 모두 선택한 뒤에는 우 클릭의 콘텍스트 메뉴로 '붙이기'를 눌러 선택한 한지를 붙일 수 있습니다.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /출품 정보 입력 & 도움말 영역 -->

<!-- 구매한 리스트 -->
<div id="list-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="fx-5 text-red">추가</div>
            </div>
            <div class="modal-body">
                <div class="row"></div>
            </div>
        </div>
    </div>
</div>
<!-- /구매한 리스트 -->


<script src="/js/entry/Workspace.js"></script>
<script src="/js/entry/Paper.js"></script>
<script src="/js/entry/Source.js"></script>
<script src="/js/entry/Tool.js"></script>
<script src="/js/entry/Select.js"></script>
<script src="/js/entry/Spin.js"></script>
<script src="/js/entry/Cut.js"></script>
<script src="/js/entry/Glue.js"></script>
<script src="/js/entry.js"></script>
