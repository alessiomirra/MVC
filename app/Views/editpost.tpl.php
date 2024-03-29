<div class="row d-flex justify-content-center g-3">
    <div class="col-md-9">
        <h1>EDIT POST</h1>
        <form action="/posts/<?= $post->id?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" required value="<?= $post->email ?>" name="email" class="form-control" id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">title</label>
                <input type="text" required value="<?= $post->title ?>" name="title" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" required name="message" id="message" rows="3">
                    <?= $post->message ?>
                </textarea>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-success">SAVE</button>
            </div>
        </form>
    </div>
</div>