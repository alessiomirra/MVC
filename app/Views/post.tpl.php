<div class="row d-flex justify-content-center g-3">
    <div class="col-md-9">
        <article>
            <h1><a href="/posts/<?= $post->id ?>"><?= htmlentities($post->title) ?></a></h1>
            <p>
                <time datetime="<?= $post->datecreated ?>"><?= $post->datecreated ?></time>
                by <span><a href="mailto:<?= $post->email ?>"><?= $post->email ?></a></span>
            </p>
            <?= htmlentities($post->message) ?>
        </article>

        <div class="row d-flex justify-content-start g-3 mt-3">
            <div class="col-md-3">
                <form action="/posts/<?= $post->id ?>/edit" method="GET">
                    <button class="btn btn-success">Edit</button>
                </form>
            </div>
            <div class="col-md-6">
                <form action="/posts/<?= $post->id ?>/delete" method="POST">
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>

        <div class="row d-flex justify-content-start g-3 mt-3">
            <form action="/posts/<?= $post->id ?>/comments" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" required name="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" required name="comment" id="message" rows="3"></textarea>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-success">SAVE</button>
                </div>
            </form>
            <?php 
            /**
             * @var App\Models|Comment $comment
             */
                foreach($comments as $comment):
            ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <p><?= $comment->comment ?></p>

                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                            <p>
                                <time datetime="<?= $comment->datecreated ?>"><?= $comment->datecreated ?></time>
                            </p>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <p class="small text-muted mb-0">By <a href="mailto:<?= $comment->email ?>"><?= $comment->email ?></a></p>
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