<div class="row d-flex justify-content-center g-3">
    <div class="col-md-5">
        <?php

         if(!empty($_SESSION['message'])) :?>
         <div class="alert alert-danger">
             <?php
             echo htmlentities($_SESSION['message']);
             $_SESSION['message'] = '';
             ?>
         </div>
        <?php
        endif;
        ?>
        
        <h1><?= $signup ? 'Sign up' : 'Sign in' ?> </h1>
        
        <form action="<?=$signup?'/auth/signup':'/auth/login'?>" method="POST">
            <input type="hidden" name="_csrf" value="<?= $token ?>">
            <?php if ($signup) : ?>
                <div class="form-group">

                    <label for="username">User name</label>
                    <input class="form-control" name="username" type="text" value="" name="username" i="username">

                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input required type="email" value=""  name="email" class="form-control"
                       id="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" required value=""  
                       name="password" class="form-control" id="password">
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-success"><?= $signup ? 'SIGN UP' : 'LOGIN' ?></button>
            </div>
        </form>
</div>

