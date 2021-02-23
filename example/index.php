<!DOCTYPE html>
<html>
<head>
<!--Подключение файла с ajax-->
<script src="ajax.js" type="text/javascript"></script>
<!--Подключение файла с кодом JS-->
<script src="example.js" type="text/javascript"></script>
</head>
<body>
  <h1>Страница для работы с Ajax</h1>
<!--Блок в котором появится результат работы ajax-->
<div class='ajaxresult'></div>
<!--Выполнение функции, исполняющей код на JS при загрузке документа-->
<script>onload='functionforajax()';</script>
<!--Исполнение функции, исполняющей код на JS каждые 5 секунд-->
<script>setInterval('functionforajax()',5000);</script>
</body>
</html>
