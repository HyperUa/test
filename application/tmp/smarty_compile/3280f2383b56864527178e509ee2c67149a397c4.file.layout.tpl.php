<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-14 14:43:46
         compiled from "/home/myproj/webapp/application/modules/default/views/scripts/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14054263715322d4e3b66609-08601523%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3280f2383b56864527178e509ee2c67149a397c4' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/scripts/layout.tpl',
      1 => 1394807351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14054263715322d4e3b66609-08601523',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5322d4e3b81535_39790041',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5322d4e3b81535_39790041')) {function content_5322d4e3b81535_39790041($_smarty_tpl) {?><!DOCTYPE html>
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


        
        <link rel="stylesheet" href="/css/jquery.formstyler.css">
        <script src="/js/jquery.formstyler.min.js"></script>
    <head>

    <body>
        <div class="container">
            <?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php echo $_smarty_tpl->getSubTemplate ("messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


            <div class="row marketing">
                <?php echo $_smarty_tpl->tpl_vars['this']->value->layout()->content;?>

            </div>

            <?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        </div>

        <?php echo $_smarty_tpl->getSubTemplate ("script.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </body>

</html><?php }} ?>
