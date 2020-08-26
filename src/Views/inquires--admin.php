<!-- 비주얼 영역 -->
<div class="position-relative">
    <div class="background background--black">
        <img src="./images/48.jpg" alt="비주얼 이미지" title="비주얼 이미지">
    </div>
    <div class="visual__content container">
        <div class="text-center padding">
            <div class="fx-n1 text-gray">축제공지사항</div>
            <div class="fx-7 text-white font-weight-bold mt-3">1:1 문의</div>
        </div>
    </div>
</div>
<!-- /비주얼 영역 -->

<div class="container py-5">
    <div class="d-between">
        <div>
            <hr>
            <div class="title">1:1 문의</div>
        </div>
    </div>
    <div class="t-head mt-4">
        <div class="cell-10">상태</div>
        <div class="cell-60">제목</div>
        <div class="cell-20">문의일자</div>
        <div class="cell-10">-</div>
    </div>
    <?php foreach($inquires as $inquire):?>
        <div class="t-row" data-target="#view-modal" data-toggle="modal" data-id="<?=$inquire->id?>">
            <div class="cell-10"><?= $inquire->answered ? "완료" : "진행 중" ?></div>
            <div class="cell-60"><?= enc($inquire->title) ?></div>
            <div class="cell-20"><?= $inquire->created_at ?></div>
            <div class="cell-10">
                <button class="btn-filled" data-target="#answer-modal" data-toggle="modal" data-id="<?=$inquire->id?>">답변하기</button>
            </div>
        </div>
    <?php endforeach;?>
</div>


<form id="answer-modal" class="modal fade" action="/insert/answer" method="post">
    <input type="hidden" id="iid" name="iid">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="fx-4">답변하기</div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>답변 내용</label>
                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control" reuqire></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-filled">작성 완료</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(function(){
        $("[data-target='#answer-modal']").on("click", e => {
            e.stopPropagation();
            $("#iid").val(e.currentTarget.dataset.id);
            $("#answer-modal").modal("show");
        });
    });
</script>


<div id="view-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
<script>
    $(function(){
        $("[data-target='#view-modal']").on("click", e => {
            let id = e.currentTarget.dataset.id;
            
            $.getJSON("/api/inquires/"+id, data => {
                $("#view-modal .modal-content").html(`<div class="modal-header">
                                            <div class="fx-4">${data.title}</div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-muted fx-n2">
                                                ${data.user_name}(${data.user_email})<br>
                                                ${data.created_at}
                                            </div>
                                            <div class="fx-n1">
                                                ${data.content}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="text-right">
                                                <div class="fx-n2 text-muted">${data.answered_at ? data.answered_at : ""}</div>
                                                <div class="fx-n1">${data.answer ? data.answer : "문의에 대한 답변이 오지 않았습니다."}</div>
                                            </div>
                                        </div>`);
            });
        });
    });
</script>