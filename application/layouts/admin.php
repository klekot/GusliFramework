<?php
    $controlPanelRoot = DIRECTORY_SEPARATOR.$this->route['module'].
                        DIRECTORY_SEPARATOR.$this->route['controller'].
                        DIRECTORY_SEPARATOR;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Igor Klekotnev">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo SITE_TITLE?></title>

    <link rel="stylesheet" href="../../css/common.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../../css/dashboard.css" rel="stylesheet">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/sticky-footer.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Переключить навигацию</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $controlPanelRoot; ?>"><?php echo SITE_TITLE?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href=<?php echo $controlPanelRoot; ?>statistics">Статистика</a></li>
                <li><a href="<?php echo $controlPanelRoot; ?>settings">Настройки</a></li>
                <li><a href="/" target="_blank">На сайт</a></li>
                <li><a href="logout">Выход</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Поиск...">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <h4>Управление:</h4>
            <ul class="nav nav-sidebar">
                <li><a href="<?php echo $controlPanelRoot; ?>">Обзор</a></li>
                <li><a href="<?php echo $controlPanelRoot; ?>reports">Отчёты</a></li>
                <li><a href="<?php echo $controlPanelRoot; ?>analytics">Аналитика</a></li>
                <li><a href="<?php echo $controlPanelRoot; ?>import-export">Импорт/Экспорт</a></li>
            </ul>
            <h4>Модели данных:</h4>
            <ul class="nav nav-sidebar">
                <?php foreach ($this->models as $model): ?>
                    <li><a href="<?php echo $controlPanelRoot; ?>model-table?name=<?php echo $model ?>"><?php echo $model ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        SITE_CONTENT
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../js/ie10-viewport-bug-workaround.js"></script>
<script src="../../js/common.js"></script>
</body>
</html>
