<h1>Filemanager</h1>
<?php foreach ($files as $file) : ?>
    <?php if ($file != '.' && $file != '..') : ?> <!-- Skip '.' and '..' -->
        <?php if (is_dir(BASE_DIR . '/public/images/' . $file)) : ?>
            <!-- Display directories -->
            <a href="/filemanager/<?= $file ?>"><?= $file ?></a>
            <br>
        <?php else : ?>

            <!-- Display images or files -->
            <div id='deelnemerContainer'>
                <img src="/images/<?= $dir ?>/<?= $file ?>" alt="<?= $file ?>" style="width: 100px;">
                <div>
                    <p><?= $file ?></p>
                    <a href="/filemanager/delete/<?= $dir ?>/<?= $file ?>">Delete</a>
                </div>
            </div>
            
            <br>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
