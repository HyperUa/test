<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-11 08:40:54
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1405752683530764b9049bf5-33655909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68e17a3f484a291fd9a1142b207b906dd8e74b89' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/index/index.tpl',
      1 => 1394527252,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1405752683530764b9049bf5-33655909',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_530764b91327e8_12246374',
  'variables' => 
  array (
    'this' => 0,
    'hasAuth' => 0,
    'pagerfanta' => 0,
    'book' => 0,
    'id' => 0,
    'ganre' => 0,
    'author' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_530764b91327e8_12246374')) {function content_530764b91327e8_12246374($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['hasAuth'] = new Smarty_variable($_smarty_tpl->tpl_vars['this']->value->auth()->hasIdentity(), null, 0);?>
<?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['this']->value->auth()->getIdentity(), null, 0);?>


<div class="col-lg-12">

    <div class="add_new">
        <?php if ($_smarty_tpl->tpl_vars['hasAuth']->value) {?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'book_add');?>
">Добавить</a>
        <?php }?>
    </div>

    <h1>Список книг</h1>

    <ul>
        <?php  $_smarty_tpl->tpl_vars['book'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['book']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pagerfanta']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['book']->key => $_smarty_tpl->tpl_vars['book']->value) {
$_smarty_tpl->tpl_vars['book']->_loop = true;
?>
            <li class="task_list">

                <h4><?php echo $_smarty_tpl->tpl_vars['book']->value->getHTMLName();?>
</h4>

                <?php if ($_smarty_tpl->tpl_vars['hasAuth']->value) {?>
                    <div class="options ui-state-default ui-corner-all">
                        <div class="options-list">
                            <?php if ($_smarty_tpl->tpl_vars['id']->value==$_smarty_tpl->tpl_vars['book']->value->getUser()->getId()) {?>
                                <div class="option">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('id'=>$_smarty_tpl->tpl_vars['book']->value->getId(),'action'=>'delete'),'book_opt');?>
">Delete</a>
                                </div>

                                <div class="option" title=".ui-icon-wrench">
                                    <a title="Редактировать" href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('id'=>$_smarty_tpl->tpl_vars['book']->value->getId(),'action'=>'edit'),'book_opt');?>
"></a>
                                </div>

                                <div class="option">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('id'=>$_smarty_tpl->tpl_vars['book']->value->getId(),'action'=>'edit'),'book_opt');?>
">Edit</a>
                                </div>
                            <?php }?>
                            <div class="option">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('id'=>$_smarty_tpl->tpl_vars['book']->value->getId(),'action'=>'download'),'book_opt');?>
">Download</a>
                            </div>
                        </div>
                        <span class="ui-icon ui-icon-wrench"></span>
                    </div>
                <?php }?>

                <ul class="books_list_data">

                    <li class="books_list_genre">
                        <h6>Жанры:</h6>
                        <ul>
                            <?php  $_smarty_tpl->tpl_vars['ganre'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ganre']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['book']->value->getGenres(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ganre']->key => $_smarty_tpl->tpl_vars['ganre']->value) {
$_smarty_tpl->tpl_vars['ganre']->_loop = true;
?>
                                <li><?php echo $_smarty_tpl->tpl_vars['ganre']->value->getHTMLGenre();?>
</li>
                            <?php } ?>

                            <?php if ($_smarty_tpl->tpl_vars['book']->value->getGenres()->count()==0) {?>
                                <li>Жанры не выбраны</li>
                            <?php }?>
                        </ul>
                    </li>

                    <li class="books_list_authors">
                        <h6>Авторы:</h6>
                        <ul>
                            <?php  $_smarty_tpl->tpl_vars['author'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['author']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['book']->value->getAuthors(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['author']->key => $_smarty_tpl->tpl_vars['author']->value) {
$_smarty_tpl->tpl_vars['author']->_loop = true;
?>
                                <li><?php echo $_smarty_tpl->tpl_vars['author']->value->getHTMLName();?>
</li>
                            <?php } ?>

                            <?php if ($_smarty_tpl->tpl_vars['book']->value->getAuthors()->count()==0) {?>
                                <li>Авторы не назначены</li>
                            <?php }?>
                        </ul>
                    </li>
                </ul>
            </li>
        <?php } ?>
    </ul>

    <?php echo $_smarty_tpl->getSubTemplate ("pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


</div><?php }} ?>
