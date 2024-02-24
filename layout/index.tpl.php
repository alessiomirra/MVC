<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A blogging platform">
    <meta name="author" content="Alessio Mirra">
    <link rel='shortcut icon' href='data:image/x-icon;,' type='image/x-icon'>
    <title>Free blog</title>


    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">


</head>
<body class="d-flex flex-column h-100">

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">COMMENTING SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">Posts</a>
                    </li>
                    <?php if(isUserLoggedin()):  ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts/create">New post</a>
                    </li>
                    <?php endif ?>
                </ul>
                <ul class="d-flex justify-content-end navbar-nav mb-2 mb-md-0">

                    <?php
                        if(isUserLoggedin()) :
                    ?>
                    <li class="nav-item order-2 order-md-1">
                        <a href="#" class="nav-link" title="settings">
                            <i class="fa fa-cog fa-fw fa-lg"></i>
                        </a>
                    </li>
                    <li class="nav-link">
                        <strong> Welcome <?=getUserLoggedInFullname()?></strong>
                    </li>
                    <li class="m-1">&nbsp;</li>

                        <li class="nav-item">
                            <form class="form" role="form" method="post" action="/auth/logout">
                                <input type="hidden" name="action" value="logout">
                                <button  class="btn btn-info">LOGOUT</button>
                            </form>
                        </li>

                    </li>

                    <?php
                    else: 
                    ?>
                    <li class="nav-item">

                        <a href="/auth/login" class=" p-1 btn btn-success">LOGIN</a>
                        <a href="/auth/signup" class=" p-1 btn btn-primary">SIGN UP</a>

                    </li>
                    <?php
                        endif;
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0 mx-3">
    <?= $this->content ?>
</main>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
      <span class="text-muted">
          &copy;Alessio Mirra 
          <?= date('Y-m-d') ?>
      </span>
    </div>
</footer>


<script src="/js/bootstrap.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>