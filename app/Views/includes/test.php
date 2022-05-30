<div class="container">
    <?php foreach ($comments as $comment) : ?>
        <?php if ($comment['reply_of'] == 0) : ?>
            <div class='row mb-4'>
                <div class='col-12' style='background-color:gray'>
                <?php else : ?>
                    <div class='row mb-4 justify-content-end'>
                        <div class='col-10' style='background-color:gray'>
                        <?php endif; ?>

                        <span class='fw-bold fst-italic'> <?= $comment['name'] ?></span>
                        <span class='fst-italic'> <?= date("d M Y", strtotime($comment['created_at'])) ?></span>

                        <?php if ($comment['reply_of'] == 0) { ?>
                            <a class="float-end fw-bold text-dark text-decoration-none" id="replyComment" href="javascript:void(0)?reply-comment=<?= $comment['comment_id'] ?>" onclick="reply(this)"><i class='bi bi-reply-fill'></i></i>Reply</a>
                        <?php } ?>

                        <div class='md-3 my-1 text-break'> <?= $comment['comment'] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
</div>





href="javascript:void(0)?reply-comment= <?= $comment['comment_id'] ?>"