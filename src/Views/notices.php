<!-- 비주얼 영역 -->
<div class="position-relative">
    <div class="background background--black">
        <img src="./images/48.jpg" alt="비주얼 이미지" title="비주얼 이미지">
    </div>
    <div class="visual__content container">
        <div class="text-center padding">
            <div class="fx-n1 text-gray">축제공지사항</div>
            <div class="fx-7 text-white font-weight-bold mt-3">알려드립니다</div>
        </div>
    </div>
</div>
<!-- /비주얼 영역 -->


<div class="container py-5">
    <div class="d-between">
        <div>
            <hr>
            <div class="title">알려드립니다.</div>
        </div>
        <?php if(admin()) :?>
            <button class="btn-filled" data-target="#notice-modal" data-toggle="modal">공지 작성</button>
        <?php endif;?>
    </div>
    <div class="t-head mt-5">
        <div class="cell-10">글 번호</div>
        <div class="cell-70">제목</div>
        <div class="cell-20">작성일</div>
    </div>
    <?php foreach($notices->data as $notice): ?>
        <div class="t-row" onclick="location.href = '/notices/<?=$notice->id?>';">
            <div class="cell-10"><?= $notice->id ?></div>
            <div class="cell-70"><?= enc($notice->title) ?></div>
            <div class="cell-20"><?= $notice->created_at ?></div>
        </div>
    <?php endforeach;?>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <a class="icon bg-red text-white mx-1" href="/notices?page=<?=$notices->prevPage?>" <?= $notices->prev ? "" : "disabled" ?>>
            <i class="fa fa-angle-left"></i>
        </a>
        <?php for($i = $notices->start; $i <= $notices->end; $i++):?>
        <a class="icon bg-red text-white mx-1" href="/notices?page=<?=$i?>"><?=$i?></a>
        <?php endfor;?>
        <a class="icon bg-red text-white mx-1" href="/notices?page=<?=$notices->nextPage?>" <?= $notices->next ? "" : "disabled" ?>>
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>

<form action="/insert/notice" id="notice-modal" class="modal fade" method="post" enctype="multipart/form-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="fx-4">공지 작성</div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>제목</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label>내용</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>첨부 파일</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button class="btn-filled">작성 완료</button>
            </div>
        </div>
    </div>
</form>