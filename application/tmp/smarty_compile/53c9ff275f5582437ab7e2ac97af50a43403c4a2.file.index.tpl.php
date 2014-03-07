<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-06 15:51:35
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/genres/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:832654816530c6bd946f062-67639502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53c9ff275f5582437ab7e2ac97af50a43403c4a2' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/genres/index.tpl',
      1 => 1394121085,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '832654816530c6bd946f062-67639502',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_530c6bd95486a1_76173073',
  'variables' => 
  array (
    'this' => 0,
    'hasAuth' => 0,
    'pagerfanta' => 0,
    'genre' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_530c6bd95486a1_76173073')) {function content_530c6bd95486a1_76173073($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['hasAuth'] = new Smarty_variable($_smarty_tpl->tpl_vars['this']->value->auth()->hasIdentity(), null, 0);?>

<div class="col-lg-12">

    <?php if ($_smarty_tpl->tpl_vars['hasAuth']->value) {?>
        <div class="add_new">
            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'genre_add');?>
">Добавить</a>
        </div>
    <?php }?>

    <h1>Список жанров</h1>

    <ul>
        <?php  $_smarty_tpl->tpl_vars['genre'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['genre']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pagerfanta']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['genre']->key => $_smarty_tpl->tpl_vars['genre']->value) {
$_smarty_tpl->tpl_vars['genre']->_loop = true;
?>
        <li class="task_list two-col">
            <div class="left-col">
                <h4><?php echo $_smarty_tpl->tpl_vars['genre']->value->getGenre();?>
</h4>
            </div>

            <?php if ($_smarty_tpl->tpl_vars['hasAuth']->value) {?>
                <div class="right-col">
                    <ul class="inline-list">
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('action'=>'edit','id'=>$_smarty_tpl->tpl_vars['genre']->value->getId()),'genre_opt');?>
">Edit</a>
                        </li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('action'=>'delete','id'=>$_smarty_tpl->tpl_vars['genre']->value->getId()),'genre_opt');?>
">Delete</a>
                        </li>
                    </ul>
                </div>
            <?php }?>
        </li>
        <?php } ?>
    </ul>

    <?php echo $_smarty_tpl->getSubTemplate ("pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div><?php }} ?>
