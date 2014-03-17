<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-17 09:53:08
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/static/messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15467193355322d4e3bfa3e0-89860483%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cee7f5a6f8c31f524512f6165a457226d23c494' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/static/messages.tpl',
      1 => 1395049948,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15467193355322d4e3bfa3e0-89860483',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5322d4e3c105b4_99643834',
  'variables' => 
  array (
    'flashMessenger' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5322d4e3c105b4_99643834')) {function content_5322d4e3c105b4_99643834($_smarty_tpl) {?><div class="hide" id="messanger">
    <div class="messages">
        <?php  $_smarty_tpl->tpl_vars['message'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['message']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['flashMessenger']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['message']->key => $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->_loop = true;
?>
            <p>
                <i class="icon-large icon-exclamation-sign"></i>
                <span><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span>
            </p>
        <?php } ?>
    </div>
</div>

<?php if (count($_smarty_tpl->tpl_vars['flashMessenger']->value)>0) {?>
    <script>
        (function() {
            Task.Message.showMessages();
        })();
    </script>
<?php }?>
<?php }} ?>
