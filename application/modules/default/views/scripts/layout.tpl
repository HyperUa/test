<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Test Task</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/smoothness/jquery-ui-1.10.4.custom.min.css" >
    <link rel="stylesheet" href="/css/task-main.css">


    <script src="/js/jquery-1.11-min.js"></script>
    <script src="/js/jquery-ui-1.10.4.custom.min.js"></script>

    <script src="/js/task.js"></script>
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
