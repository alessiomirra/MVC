<div class="row d-flex justify-content-center g-3">
    <div class="col-md-9">
        <article>
            <h1><?= htmlentities($post->title) ?> </h1>
            <p>
                <time datetime="<?= $post->datecreated ?>"><?= $post->datecreated ?></time>
                by <span> <a href="mailto:<?= $post->email ?>"><?= $post->email ?></a>

            </p>
            <?= htmlentities($post->message) ?>
        </article>

        <div class="form-group d-flex mt-3">
            <?php if (getUserId() === $post->user_id ||  userCanUpdate()): ?>
            <form action="/posts/<?= $post->id ?>/edit" method="GET">
                <button class="btn btn-success">EDIT</button>
            </form>
            <?php endif; ?>
            <?php if (getUserId() === $post->user_id ||  userCanUpdate()): ?>
            <form action="/posts/<?= $post->id ?>/delete" method="POST" class="ms-2">
                <button class="btn btn-danger">DELETE</button>
            </form>
            <?php endif; ?>
        </div>


        <div class="row d-flex justify-content-start g-3 mt-3">

            <h4 class="mb-0">COMMENTS</h4>

            <hr class="mt-1">
            
            <form action="/posts/<?=$post->id?>/comments" method="POST">
                <?php if(!isUserLoggedin()):  ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input required type="email"  name="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <?php endif; ?>
                
                <div class="mb-3">
                    <label for="comment" class="form-label">Messsage</label>
                    <textarea required name="comment" class="form-control" id="message" rows="3"></textarea>
                </div>
                    <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success">SAVE</button>
                </div>
            </form>

            <?php
            /**
             * @var App\Models\Comment $comment
             */
            foreach ($comments as $comment):
            
            ?>
            <div class="card mb-4">
                <div class="card-body">
                    <p><?= $comment->comment ?> </p>

                    <div class="d-flex justify-content-between">
                            
                        <div class="d-flex flex-row align-items-center">
                            <p>
                                <time datetime="<?= $comment->datecreated ?>"><?= $comment->datecreated ?></time>
                                <?php 
                                    $email = $comment->email ?? $comment->user_email;
                                ?>
                                by <span> <a href="mailto:<?= $email ?>"><?= $email ?></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            endforeach;
            ?>

        </div>
    </div>

</div>