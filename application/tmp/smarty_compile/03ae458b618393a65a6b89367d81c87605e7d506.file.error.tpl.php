<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-05 12:37:00
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/error/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135323617053075dc48c4d52-74587550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '135323617053075dc48c4d52-74587550',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_53075dc4aee8b3_24349678',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53075dc4aee8b3_24349678')) {function content_53075dc4aee8b3_24349678($_smarty_tpl) {?><h1>n error occurred</h1>


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
