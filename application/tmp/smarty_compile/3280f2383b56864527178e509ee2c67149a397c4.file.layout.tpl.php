<?php /* Smarty version Smarty-3.1-DEV, created on 2014-02-28 16:42:29
         compiled from "/home/myproj/webapp/application/modules/default/views/scripts/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1193071469530764b91fe7d0-03699331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3280f2383b56864527178e509ee2c67149a397c4' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/scripts/layout.tpl',
      1 => 1393605222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1193071469530764b91fe7d0-03699331',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_530764b92294a8_28578716',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_530764b92294a8_28578716')) {function content_530764b92294a8_28578716($_smarty_tpl) {?><!DOCTYPE html>
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
        <?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


        <div class="row marketing">
            <?php echo $_smarty_tpl->tpl_vars['this']->value->layout()->content;?>

        </div>

        <?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>

</body>
</html>
<?php }} ?>
