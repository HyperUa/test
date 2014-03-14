<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-14 10:07:31
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/static/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3686063975322d4e3b929f5-23191547%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddb9e67f2099a80f5a82fe6596f2d543ae01d1ea' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/static/header.tpl',
      1 => 1394716118,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3686063975322d4e3b929f5-23191547',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5322d4e3be0a41_55429060',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5322d4e3be0a41_55429060')) {function content_5322d4e3be0a41_55429060($_smarty_tpl) {?><div class="header">
    <ul class="nav nav-pills pull-right">
        <li <?php if ($_smarty_tpl->tpl_vars['this']->value->checkUrl(array('action'=>'index','controller'=>'index'))) {?>class="active"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'home');?>
">Home</a>
        </li>

        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Опции <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'authors');?>
">Авторы</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'genres');?>
">Жанры</a></li>
            </ul>
        </li>

        <?php if ($_smarty_tpl->tpl_vars['this']->value->auth()->hasIdentity()) {?>
            <li <?php if ($_smarty_tpl->tpl_vars['this']->value->checkUrl(array('action'=>'logout','controller'=>'auth'))) {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'logout');?>
">Выйти</a>
            </li>
        <?php } else { ?>
            <li <?php if ($_smarty_tpl->tpl_vars['this']->value->checkUrl(array('action'=>'login','controller'=>'auth'))) {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'login');?>
">Войти</a>
            </li>
        <?php }?>
    </ul>
    <h3 class="text-muted">Тестовое задание</h3>
</div>
<?php }} ?>
