<?php /* Smarty version Smarty-3.1-DEV, created on 2014-03-05 16:51:36
         compiled from "/home/myproj/webapp/application/modules/default/views/templates/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1405752683530764b9049bf5-33655909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68e17a3f484a291fd9a1142b207b906dd8e74b89' => 
    array (
      0 => '/home/myproj/webapp/application/modules/default/views/templates/index/index.tpl',
      1 => 1394038298,
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
    'pagerfanta' => 0,
    'book' => 0,
    'ganre' => 0,
    'author' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_530764b91327e8_12246374')) {function content_530764b91327e8_12246374($_smarty_tpl) {?><div class="col-lg-12">

    <div class="add_new">
        <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array(),'book_add');?>
">Добавить</a>
    </div>

    <h1>Список книг</h1>

    <ul>
        <?php  $_smarty_tpl->tpl_vars['book'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['book']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pagerfanta']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['book']->key => $_smarty_tpl->tpl_vars['book']->value) {
$_smarty_tpl->tpl_vars['book']->_loop = true;
?>
            <li class="task_list">

                <h4><?php echo $_smarty_tpl->tpl_vars['book']->value->getName();?>
</h4>

                <ul class="books_list_data">

                    <li class="books_list_genre">
                        <h6>Жанры:</h6>
                        <ul>
                            <?php  $_smarty_tpl->tpl_vars['ganre'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ganre']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['book']->value->getGenres(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ganre']->key => $_smarty_tpl->tpl_vars['ganre']->value) {
$_smarty_tpl->tpl_vars['ganre']->_loop = true;
?>
                                <li><?php echo $_smarty_tpl->tpl_vars['ganre']->value->getGenre();?>
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
                                <li><?php echo $_smarty_tpl->tpl_vars['author']->value->getName();?>
</li>
                            <?php } ?>

                            <?php if ($_smarty_tpl->tpl_vars['book']->value->getAuthors()->count()==0) {?>
                                <li>Авторы не назначены</li>
                            <?php }?>
                        </ul>
                    </li>

                    <li class="books_list_options">
                        <div class="task_list_options">
                            <ul class="inline-list">
                                <li>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('id'=>$_smarty_tpl->tpl_vars['book']->value->getId(),'action'=>'delete'),'book_opt');?>
">Delete</a>
                                </li>

                                <li class="ui-state-default ui-corner-all" title=".ui-icon-wrench">
                                    <a title="Редактировать" href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('id'=>$_smarty_tpl->tpl_vars['book']->value->getId(),'action'=>'edit'),'book_opt');?>
">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('id'=>$_smarty_tpl->tpl_vars['book']->value->getId(),'action'=>'edit'),'book_opt');?>
">Edit</a>
                                </li>
                                <li>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url(array('id'=>$_smarty_tpl->tpl_vars['book']->value->getId(),'action'=>'download'),'book_opt');?>
">Download</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </li>
        <?php } ?>
    </ul>

    <?php echo $_smarty_tpl->getSubTemplate ("pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


</div><?php }} ?>
