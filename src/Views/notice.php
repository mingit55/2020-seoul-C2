<!-- 비주얼 영역 -->
<div class="position-relative">
    <div class="background background--black">
        <img src="/images/48.jpg" alt="비주얼 이미지" title="비주얼 이미지">
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
            <div>
                <button class="btn-filled" data-target="#edit-modal" data-toggle="modal">수정하기</button>
                <a href="/delete/notice/<?=$notice->id?>" class="btn-bordered">삭제하기</a>
            </div>
        <?php endif;?>
    </div>
    <div class="fx-5 py-2"><?=enc($notice->title)?></div>
    <div class="py-2 fx-n1">
        작성일: <?= $notice->created_at ?>
    </div>
    <div class="fx-1 text-muted py-3"><?=enc($notice->content)?></div>
    <div class="py-4">
        <?php foreach($notice->files as $file):?>
            <?php if(substr(fileinfo($file)->type, 0, 5) === "image"):?>
                <img src="/uploads/<?=$file?>" alt="이미지 파일" class="fit-cover my-4">
            <?php endif;?>
        <?php endforeach;?>
    </div>
    <?php if(count($notice->files) > 0):?>
    <hr>
    <div class="fx-3 py-3">첨부파일</div>
    <div class="py-4 d-flex flex-wrap">
        <?php foreach($notice->files as $file):?>
            <div class="m-2 d-flex align-items-center">
                <span><?=fileinfo($file)->name?>(<?=fileinfo($file)->size?>KB)</span>
                <a href="/download/<?=$file?>" class="btn btn-primary ml-3">다운로드</a>
            </div>
        <?php endforeach;?>
    </div>
    <?php endif;?>
</div>

<form action="/update/notice/<?=$notice->id?>" id="edit-modal" class="modal fade" method="post" enctype="multipart/form-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="fx-4">공지 수정</div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>제목</label>
                    <input type="text" class="form-control" name="title" value="<?=$notice->title?>" required>
                </div>
                <div class="form-group">
                    <label>내용</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control" required><?=$notice->content?></textarea>
                </div>
                <div class="form-group">
                    <label>첨부 파일</label>
                    <div class="custom-file">
                        <div class="custom-file-label"><?= count($notice->files) > 0 ? count($notice->files) . "개의 파일" : "파일을 선택하세요" ?></div>
                        <input type="file" name="files[]" class="custom-file-input" multiple>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button class="btn-filled">작성 완료</button>
            </div>
        </div>
    </div>
</form>