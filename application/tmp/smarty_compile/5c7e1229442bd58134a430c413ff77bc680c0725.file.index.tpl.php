<?php /* Smarty version Smarty-3.1-DEV, created on 2014-02-26 12:52:13
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/authors/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175857480530c61d9c1b760-24199012%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c7e1229442bd58134a430c413ff77bc680c0725' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/authors/index.tpl',
      1 => 1393419140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175857480530c61d9c1b760-24199012',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_530c61d9cf2f53_91642426',
  'variables' => 
  array (
    'this' => 0,
    'authors' => 0,
    'author' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_530c61d9cf2f53_91642426')) {function content_530c61d9cf2f53_91642426($_smarty_tpl) {?><div class="col-lg-12">

    <div class="add_new">
        <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'author_add');?>
">Добавить</a>
    </div>

    <h1>Список Авторов</h1>

    <ul>
        <?php  $_smarty_tpl->tpl_vars['author'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['author']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['authors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['author']->key => $_smarty_tpl->tpl_vars['author']->value) {
$_smarty_tpl->tpl_vars['author']->_loop = true;
?>
            <li class="task_list two-col">
                <div class="left-col">
                    <h4><?php echo $_smarty_tpl->tpl_vars['author']->value->getName();?>
</h4>
                </div>

                <div class="right-col">
                    <ul class="inline-list">
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('action'=>'edit','id'=>$_smarty_tpl->tpl_vars['author']->value->getId()),'author_opt');?>
">Edit</a>
                        </li>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('action'=>'delete','id'=>$_smarty_tpl->tpl_vars['author']->value->getId()),'author_opt');?>
">Delete</a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php } ?>
    </ul>

</div><?php }} ?>
