<!-- 비주얼 영역 -->
<div class="position-relative">
    <div class="background background--black">
        <img src="./images/48.jpg" alt="비주얼 이미지" title="비주얼 이미지">
    </div>
    <div class="visual__content container">
        <div class="text-center padding">
            <div class="fx-n1 text-gray">한지상품판매관</div>
            <div class="fx-7 text-white font-weight-bold mt-3">한지업체</div>
        </div>
    </div>
</div>
<!-- /비주얼 영역 -->

<div class="container py-5">
    <hr>
    <div class="title">우수 업체</div>
    <div class="mt-4">
        <div class="row">
            <?php foreach($rankers as $ranker):?>
            <div class="col-lg-3">
                <div class="border bg-white">
                    <img src="/uploads/<?=$ranker->image?>" alt="이미지" class="fit-contain p-3 hx-200">
                    <div class="p-3">
                        <div>
                            <span class="fx-3"><?= $ranker->user_name ?></span>
                            <span class="badge badge-primary"><?= $ranker->totalPoint ?>p</span>
                            <span class="badge badge-danger">우수 업체</span>
                        </div>
                        <div class="fx-n1"><?= $ranker->user_email ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>

<div class="bg-gray">
    <div class="container py-5">
        <hr>
        <div class="title">모든 업체</div>
        <div class="mt-4">
            <div class="row">
                <?php foreach($companies->data as $company):?>
                <div class="col-lg-3">
                    <div class="border bg-white">
                        <img src="/uploads/<?=$company->image?>" alt="이미지" class="fit-contain p-3 hx-200">
                        <div class="p-3">
                            <div>
                                <span class="fx-3"><?= $company->user_name ?></span>
                                <span class="badge badge-primary"><?= $company->totalPoint ?>p</span>
                            </div>
                            <div class="fx-n1"><?= $company->user_email ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-5">
            <a class="icon bg-red text-white mx-1" href="/companies?page=<?=$companies->prevPage?>" <?= $companies->prev ? "" : "disabled" ?>>
                <i class="fa fa-angle-left"></i>
            </a>
            <?php for($i = $companies->start; $i <= $companies->end; $i++):?>
            <a class="icon bg-red text-white mx-1" href="/companies?page=<?=$i?>"><?=$i?></a>
            <?php endfor;?>
            <a class="icon bg-red text-white mx-1" href="/companies?page=<?=$companies->nextPage?>" <?= $companies->next ? "" : "disabled" ?>>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</div>