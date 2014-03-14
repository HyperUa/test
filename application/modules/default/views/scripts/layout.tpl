<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Test Task</title>

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/task-main.css">
        <link rel="stylesheet" href="/css/bootstrap.icon-large.min.css">


        <script src="/js/jquery-1.11-min.js"></script>
        <script src="/js/task.js"></script>

        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.confirm.min.js"></script>
        <script src="/js/run_prettify.js"></script>


        {*Form Styler*}
        <link rel="stylesheet" href="/css/jquery.formstyler.css">
        <script src="/js/jquery.formstyler.min.js"></script>
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

        {include file="script.tpl"}
    </body>

</html>