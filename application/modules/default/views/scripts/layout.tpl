<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Test Task</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/theme.css">


    {*<script crossorigin="anonymous" src="https://github.global.ssl.fastly.net/assets/frameworks-574a9489245858832a859b24d9512f49073e995a.js" type="text/javascript"></script>*}
<head>


<body>

    <div class="container">
        {include file="header.tpl"}
        {include file="messages.tpl"}

        <div class="row marketing">
            {$this->layout()->content}
        </div>

        {include file="footer.tpl"}
    </div>

</body>
</html>
