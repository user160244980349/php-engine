<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $title ?></title>
        <?php include 'dependencies/css.tpl' ?>
    </head>
    <body>

        <?php include 'blocks/header.tpl' ?>
        <div class="container">
            <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <h1 class="display-4">404 not found</h1>
                <p class="lead">
                    Error! Requested page was not found.
                </p>
            </div>
        </div>
        <?php include 'blocks/footer.tpl' ?>

        <?php include 'dependencies/js.tpl' ?>

    </body>
</html>