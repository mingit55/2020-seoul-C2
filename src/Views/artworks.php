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

<!-- 검색 영역 -->
<form class="container pt-4">
    <div class="py-2 px-2 border">
        <div class="d-center mt-2">
            <div id="search_tags" data-name="tags" class="w-100"></div>
            <button class="btn-search icon ml-2 text-red p-0">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>
<script>
    new HashModule("#search_tags", [], <?= json_encode($tags) ?>);
</script>
<!-- /검색 영역 -->

<?php if(user()):?>
<div class="container py-5">
    <hr>
    <div class="title">나의 작품</div>
    <div class="row mt-4">
        <?php foreach($myList as $artwork):?>
        <div class="col-lg-3" onclick="location.href='/artworks/<?=$artwork->id?>'">
            <div class="border bg-white">
                <img src="/uploads/<?=$artwork->image?>" alt="작품 이미지" class="hx-200 fit-contain p-3">
                <div class="p-3">
                    <div class="d-between mt-3">
                        <div class="fx-2"><?= enc($artwork->title) ?></div>
                        <div class="fx-3 text-red">
                            <i class="fa fa-star"></i>
                            <?= $artwork->score ?>
                        </div>
                    </div>
                    <div class="fx-n1 mt-1 text-muted">
                        <?= enc($artwork->user_name) ?>
                        <span class="badge badge-primary"><?= $artwork->type == "company" ? "기업" : "일반"  ?></span>
                    </div>
                    <div class="fx-n1 mt-1 text-muted">
                        <?= $artwork->created_at ?>
                    </div>
                    <div class="d-flex flex-wrap">
                        <?php foreach($artwork->hashTags as $tag):?>
                            <div class="fx-n2 m-2">#<?=$tag?></div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php endif;?>
<div class="container py-5">
    <hr>
    <div class="title">우수 작품</div>
    <div class="row mt-4">
        <?php foreach($rankers as $artwork):?>
        <div class="col-lg-3" onclick="location.href='/artworks/<?=$artwork->id?>'">
            <div class="border bg-white">
                <img src="/uploads/<?=$artwork->image?>" alt="작품 이미지" class="hx-200 fit-contain p-3">
                <div class="p-3">
                    <div class="d-between mt-3">
                        <div class="fx-2"><?= enc($artwork->title) ?></div>
                        <div class="fx-3 text-red">
                            <i class="fa fa-star"></i>
                            <?= $artwork->score ?>
                        </div>
                    </div>
                    <div class="fx-n1 mt-1 text-muted">
                        <?= enc($artwork->user_name) ?>
                        <span class="badge badge-primary"><?= $artwork->type == "company" ? "기업" : "일반"  ?></span>
                        <span class="badge badge-danger">우수작품</span>
                    </div>
                    <div class="fx-n1 mt-1 text-muted">
                        <?= $artwork->created_at ?>
                    </div>
                    <div class="d-flex flex-wrap">
                        <?php foreach($artwork->hashTags as $tag):?>
                            <div class="fx-n2 m-2">#<?=$tag?></div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<div class="container py-5">
    <hr>
    <div class="title">모든 작품</div>
    <div class="row mt-4">
        <?php foreach($artworks->data as $artwork):?>
        <div class="col-lg-3" onclick="location.href='/artworks/<?=$artwork->id?>'">
            <div class="border bg-white">
                <img src="/uploads/<?=$artwork->image?>" alt="작품 이미지" class="hx-200 fit-contain p-3">
                <div class="p-3">
                    <div class="d-between mt-3">
                        <div class="fx-2"><?= enc($artwork->title) ?></div>
                        <div class="fx-3 text-red">
                            <i class="fa fa-star"></i>
                            <?= $artwork->score ?>
                        </div>
                    </div>
                    <div class="fx-n1 mt-1 text-muted">
                        <?= enc($artwork->user_name) ?>
                        <span class="badge badge-primary"><?= $artwork->type == "company" ? "기업" : "일반"  ?></span>
                    </div>
                    <div class="fx-n1 mt-1 text-muted">
                        <?= $artwork->created_at ?>
                    </div>
                    <div class="d-flex flex-wrap">
                        <?php foreach($artwork->hashTags as $tag):?>
                            <div class="fx-n2 m-2">#<?=$tag?></div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <a class="icon bg-red text-white mx-1" href="/artworks?page=<?=$artworks->prevPage?>" <?= $artworks->prev ? "" : "disabled" ?>>
            <i class="fa fa-angle-left"></i>
        </a>
        <?php for($i = $artworks->start; $i <= $artworks->end; $i++):?>
        <a class="icon bg-red text-white mx-1" href="/artworks?page=<?=$i?>"><?=$i?></a>
        <?php endfor;?>
        <a class="icon bg-red text-white mx-1" href="/artworks?page=<?=$artworks->nextPage?>" <?= $artworks->next ? "" : "disabled" ?>>
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>