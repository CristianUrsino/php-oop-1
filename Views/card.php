<div class="col-12 col-md-4 col-lg-3">
    <div class="card">
        <img src="<?= $image ?>" class="card-img-top my-ratio" alt="<?= $title ?>">
        <div class="card-body">
            <h5 class="card-title">
                <?= $title ?>
            </h5>
            <p class="card-text">
                <?= $content ?>
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <?= $custom ?>
                <img src="<?= $flag ?>" alt="flag">
                <div>
                    <?php 
                        foreach($genre as $value){
                            echo $value->name . '<br>';
                        }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>