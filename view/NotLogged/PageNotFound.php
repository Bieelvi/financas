<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= translate("Page not found") ?> :(</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/variables.css">
    <link rel="stylesheet" href="/css/header.css">
</head>

<style>
    .page {
        height: 100vh;
        width: 100vw;
    }
    a, a:hover, a:active, a:visited {
        color: var(--white);
    }
</style>

<body>
    <section class="page d-flex flex-column justify-content-center align-items-center" data-bs-theme="dark">
        <div class="d-flex  align-items-center gap-2">
            <h1>404</h1>
            <span><?= translate("Page not found") ?></span>
        </div>

        <div>
            <a href="/home"><?= translate('Dashboard') ?></a>
        </div>
    </section>
</body>

</html>