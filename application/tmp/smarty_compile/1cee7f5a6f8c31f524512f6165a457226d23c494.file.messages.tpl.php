<?php /* Smarty version Smarty-3.1-DEV, created on 2014-02-28 16:43:04
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/static/messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35051076453076981a9d615-02356821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cee7f5a6f8c31f524512f6165a457226d23c494' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/static/messages.tpl',
      1 => 1393605784,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35051076453076981a9d615-02356821',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_53076981adc062_49461865',
  'variables' => 
  array (
    'flashMessenger' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53076981adc062_49461865')) {function content_53076981adc062_49461865($_smarty_tpl) {?><div id="messanger" class="ui-widget hide">
    <div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all messages">
        <?php  $_smarty_tpl->tpl_vars['message'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['message']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['flashMessenger']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['message']->key => $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->_loop = true;
?>
            <p>
                <span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
                <span><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
            </p>
        <?php } ?>
    </div>
</div>

<script>
    (function() {
        Task.Message.showMessages('#messanger');
    })();
</script><?php }} ?>
