<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-14 10:09:13
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/error/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9543264875322d549e641a2-90587353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03ae458b618393a65a6b89367d81c87605e7d506' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/error/error.tpl',
      1 => 1394023017,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9543264875322d549e641a2-90587353',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5322d549e95540_28409606',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5322d549e95540_28409606')) {function content_5322d549e95540_28409606($_smarty_tpl) {?><h1>n error occurred</h1>


<h2><?php echo $_smarty_tpl->tpl_vars['this']->value->message;?>
</h2>

<?php if ($_smarty_tpl->tpl_vars['this']->value->exception) {?>
    <h3>
        Exception information:
    </h3>
    <p>
        <b>Message:</b> <?php echo $_smarty_tpl->tpl_vars['this']->value->exception->getMessage();?>

    </p>
    <h3>
        Stack trace:
    </h3>
    <pre><?php echo $_smarty_tpl->tpl_vars['this']->value->exception->getTraceAsString();?>

  </pre>
    <h3>
        Request Parameters:
    </h3>
    <pre><?php echo var_export($_smarty_tpl->tpl_vars['this']->value->request->getParams(),true);?>

  </pre>
<?php }?><?php }} ?>
