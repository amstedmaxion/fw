<!doctype html>
<html lang="pt-BR">

<!-- HEAD -->

<head class="dark-mode">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle de itens liberados</title>



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= css_directory("/bs5.css") ?>">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="<?= js_directory("/tinymce.js") ?>"></script>


    <!-- Loader CSS -->
    <link rel="stylesheet" href="<?= css_directory("/loader.css"); ?>">

    <!-- Dyoxfy CSS -->
    <link rel="stylesheet" href="<?= css_directory("/dyoxfy.css") ?>">

    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= css_directory("/global.css") ?>">

    <!-- The code stretch below inserts the specific styles of each of the pages that inherit it as a layout -->
    <?php if (isset($styles)) { ?>
        <?php foreach ($styles as $index => $style) { ?>
            <link rel="stylesheet" href="<?= $style ?>">
        <?php } ?>
    <?php } ?>
</head>
<!-- HEAD -->



<body class="<?= whatsCompany() ?>">


    <!-- Header -->
    <!-- <header>
        Controle de itens liberados
    </header> -->


    <!-- Content -->
    <div class="container mt-4">
        <ul class="dyoxfy-notifications"></ul>
        <div class="card mb-4">
            <div class="card-header">
                <div class="screen-name-and-logo">

                    <?php if (!empty($urlBack)) { ?>
                        <a href="<?= $urlBack ?>" class="text-muted">
                            <small class="d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-arrow-left me-2"></i>
                                voltar
                            </small>
                        </a>
                    <?php } ?>

                    <span class="d-flex align-items-center"><?= $titleOnCardHeader ?? null ?></span>
                    <img src="<?= image_directory('/' . whatsCompany() . '.png'); ?>" alt="Logo Empresa">
                </div>
            </div>
            <div class="card-body">


                <?= $this->section("content"); ?>

            </div>
        </div>
    </div>



    <div class="loader-wrapper">
        <div class="loader"></div>
        <p>Aguarde um instante, estamos processando os dados...</p>
    </div>


    <!-- Bootstrap JS --->
    <script src="<?= js_directory("/bs5.js") ?>"></script>


    <!-- JavaScript that initializes variables and aid functions --->
    <script src="<?= js_directory("/init.js"); ?>"></script>


    <!-- Dyoxfy JS -->
    <script src="<?= js_directory("/dyoxfy.js"); ?>"></script>

    <?= dyoxfyStart(); ?>
    <?= forgetSessions(['old', 'dyoxfy', 'isWrong']) ?>

    <!-- The code stretch below inserts the scripts of each of the pages that inherit this template as a layour -->
    <?php if (isset($js)) { ?>
        <?php foreach ($js as $index => $js_) { ?>
            <script src="<?= $js_ ?>"></script>
        <?php } ?>
    <?php } ?>
</body>



</html>