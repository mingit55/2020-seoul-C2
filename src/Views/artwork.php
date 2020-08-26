<!-- 비주얼 영역 -->
<div class="position-relative">
    <div class="background background--black">
        <img src="/images/48.jpg" alt="비주얼 이미지" title="비주얼 이미지">
    </div>
    <div class="visual__content container">
        <div class="text-center padding">
            <div class="fx-n1 text-gray">한지공예대전</div>
            <div class="fx-7 text-white font-weight-bold mt-3">참가작품</div>
        </div>
    </div>
</div>
<!-- /비주얼 영역 -->

<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <img src="/uploads/<?= $artwork->image ?>" alt="작품 이미지" class="fit-cover">
        </div>
        <div class="col-lg-8">
            <div class="fx-5"><?=enc($artwork->title)?></div>
            <div class="fx-2 mt-4 text-muted"><?=enc($artwork->description)?></div>
            <div class="mt-3">
                <span class="fx-n2 text-muted">작성일자</span>
                <span class="ml-2 fx-n1"><?=$artwork->created_at?></span>
            </div>
            <div class="mt-1">
                <span class="fx-n2 text-muted">평점</span>
                <span class="ml-2 fx-n1"><?=$artwork->score?>점</span>
            </div>
            <div class="mt-1 d-flex flex-wrap">
                <?php foreach($artwork->hashTags as $tag):?>
                    <div class="p-1 text-muted fx-n2">#<?=$tag?></div>
                <?php endforeach;?>
            </div>
            <?php if(user()->id == $artwork->uid):?>
                <div class="mt-3">
                    <button class="btn-filled" data-toggle="modal" data-target="#edit-modal">수정하기</button>
                    <a href="/delete/artwork/<?= $artwork->id ?>" class="btn-bordered">삭제하기</a>
                </div>
            <?php endif;?>
        </div>
    </div>
    <?php if(!$artwork->reviewed && $artwork->uid !== user()->id):?>
    <form action="/insert/score" method="post" class="p-3 my-3 border">
        <input type="hidden" name="aid" value="<?=$artwork->id?>">
        <select name="score" id="" class="form-control fa text-red" style="width: 200px;">
            <option class="fa text-red" value="5"><?= str_repeat("&#xf005;", 5) ?></option>
            <option class="fa text-red" value="4.5"><?= str_repeat("&#xf005;", 4) ?>&#xf123;</option>
            <option class="fa text-red" value="4"><?= str_repeat("&#xf005;", 4) ?></option>
            <option class="fa text-red" value="3.5"><?= str_repeat("&#xf005;", 3) ?>&#xf123;</option>
            <option class="fa text-red" value="3"><?= str_repeat("&#xf005;", 3) ?></option>
            <option class="fa text-red" value="2.5"><?= str_repeat("&#xf005;", 2) ?>&#xf123;</option>
            <option class="fa text-red" value="2"><?= str_repeat("&#xf005;", 2) ?></option>
            <option class="fa text-red" value="1.5"><?= str_repeat("&#xf005;", 1) ?>&#xf123;</option>
            <option class="fa text-red" value="1"><?= str_repeat("&#xf005;", 1) ?></option>
        </select>
        <button class="btn-filled">확인</button>
    </form>
    <?php endif;?>
    <div class="my-3 p-3 border">
        <div class="row align-items-center">
            <div class="col-lg-2">
                <img src="/uploads/<?=$artwork->user_image?>" alt="이미지" class="fit-cover hx-100">
            </div>
            <div class="col-lg-10">
                <div class="fx-2">
                    <?=$artwork->user_name?>
                    <span class="badge badge-primary"><?=$artwork->type == "normal" ? "일반" : "기업"?></span>
                </div>
                <div class="fx-n1 text-muted"><?=$artwork->user_email?></div>
            </div>
        </div>
    </div>
</div>

<form action="/update/artwork/<?=$artwork->id?>" method="post" id="edit-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="fx-4">수정하기</div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>제목</label>
                    <input type="text" class="form-control" name="title" value="<?=$artwork->title?>" required>
                </div>
                <div class="form-group">
                    <label>내용</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" required><?=$artwork->description?></textarea>
                </div>
                <div class="form-group">
                    <label>해시태그</label>
                    <div id="edit-tags" data-name="hashTags">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-filled">수정 완료</button>
            </div>
        </div>
    </div>
</form>

<script>
    new HashModule("#edit-tags", [], <?=json_encode($artwork->hashTags)?>);
</script>