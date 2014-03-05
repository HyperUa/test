<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-05 15:00:23
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/static/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1012306393530764b9247882-91832858%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddb9e67f2099a80f5a82fe6596f2d543ae01d1ea' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/static/header.tpl',
      1 => 1394031154,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1012306393530764b9247882-91832858',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_530764b9263343_86981669',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_530764b9263343_86981669')) {function content_530764b9263343_86981669($_smarty_tpl) {?><div class="header">
    <ul class="nav nav-pills pull-right">
        <li <?php if ($_smarty_tpl->tpl_vars['this']->value->checkUrl(array('action'=>'index','controller'=>'index'))) {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'home');?>
">Home</a>
        </li>

        
        <li <?php if ($_smarty_tpl->tpl_vars['this']->value->checkUrl(array('action'=>'options','controller'=>'index'))) {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'options');?>
">Опции</a>
        </li>

        <li <?php if ($_smarty_tpl->tpl_vars['this']->value->checkUrl(array('action'=>'login','controller'=>'auth'))) {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'login');?>
">Войти</a>
        </li>
    </ul>
    <h3 class="text-muted">Тестовое задание</h3>
</div>
<?php }} ?>
