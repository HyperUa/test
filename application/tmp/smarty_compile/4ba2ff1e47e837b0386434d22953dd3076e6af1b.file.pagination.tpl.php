<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-14 10:07:31
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/static/pagination.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17058050725322d4e3ad7be0-51800569%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ba2ff1e47e837b0386434d22953dd3076e6af1b' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/static/pagination.tpl',
      1 => 1394020773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17058050725322d4e3ad7be0-51800569',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagerfanta' => 0,
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5322d4e3af16d3_59165045',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5322d4e3af16d3_59165045')) {function content_5322d4e3af16d3_59165045($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['pagerfanta']->value)) {?>
    <div class="pagerfanta">
        <?php echo $_smarty_tpl->tpl_vars['this']->value->paginator($_smarty_tpl->tpl_vars['this']->value->pagerfanta);?>

    </div>
<?php }?>
<?php }} ?>
