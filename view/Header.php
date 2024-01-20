<!DOCTYPE html>
<html lang="<?= lang() ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? ucfirst($title) . " - " . translate('Bieelvi Finance') : translate('Bieelvi Finance') ?></title>

    <!-- JS essencial -->
    <script 
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer">
    </script>
    <script src="js/ResizeWidth.js"></script>

    <!-- JS nao essencial -->
    <script defer src="js/FlashMessage.js"></script>
    <script defer src="js/ButtonPassword.js"></script>
    <script defer src="js/ShowPassword.js"></script>

    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <link rel="stylesheet" href="/css/reset.css">
    <link 
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="/css/variables.css">
    <link rel="stylesheet" href="/css/header.css">
    <?php if (is_file(__DIR__ . "/../public/css/{$title}.css")): ?>
        <link rel="stylesheet" href="/css/<?= $title ?>.css">
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="position-relative">

    <div class="d-none position-fixed" id="flash-message">
        <div id="type-message" class="position-relative">
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-purple" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home">
                <img src="/favicon.ico" alt="<?= translate('Page Logo Alt') ?>">
            </a>

            <button 
                class="navbar-toggler" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarNavAltMarkup" 
                aria-controls="navbarNavAltMarkup" 
                aria-expanded="false" 
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php if (\Financas\Helper\Session::has()) : ?>
                        <a 
                            class="nav-link <?= $title == 'report' ? 'active border rounded border-white' : '' ?>" 
                            aria-current="page" 
                            href="/report"><?= translate('Reports') ?>
                        </a>
                        <a 
                            class="nav-link <?= $title == 'farmer' ? 'active border rounded border-white' : '' ?>" 
                            aria-current="page" 
                            href="/farmer"><?= translate('Farmer') ?>
                        </a>
                        <?php if($_SESSION['logged']->getType() == \Financas\Enum\UserType::ADMIN->value) : ?>
                            <a 
                                class="nav-link <?= $title == 'products' ? 'active border rounded border-white' : '' ?>" 
                                aria-current="page" 
                                href="/products"><?= translate('Products') ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <div class="navbar-nav gap-2">
                    <div class="d-flex btn-group">
                        <button type="button" class="btn btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-list"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if (!\Financas\Helper\Session::has()) : ?>
                                <li><a class="dropdown-item" href="/signin"><?= translate('Sign In') ?></a></li>
                                <li><a class="dropdown-item" href="/signup"><?= translate('Sign Up') ?></a></li>
                            <?php else : ?>
                                <li><a class="dropdown-item" href="/profile"><?= translate('Profile') ?></a></li>
                                <li><a class="dropdown-item" href="/config"><?= translate('Configurations') ?></a></li>
                                <li><a class="dropdown-item" href="/logout"><?= translate('Logout') ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>