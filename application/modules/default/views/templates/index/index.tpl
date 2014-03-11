{assign var=hasAuth value= $this->auth()->hasIdentity()}
{assign var=id value=$this->auth()->getIdentity()}


<div class="col-lg-12">

    <div class="add_new">
        {if $hasAuth}
            <a href="{$this->url([], 'book_add')}">Добавить</a>
        {/if}
    </div>

    <h1>Список книг</h1>

    <ul>
        {foreach from = $pagerfanta item=book}
            <li class="task_list">

                <h4>{$book->getHTMLName()}</h4>

                {if $hasAuth}
                    <div class="options ui-state-default ui-corner-all">
                        <div class="options-list">
                            {if $id == $book->getUser()->getId()}
                                <div class="option">
                                    <a href="{$this->url(['id' => $book->getId(), 'action' => 'delete'], 'book_opt')}">Delete</a>
                                </div>

                                <div class="option" title=".ui-icon-wrench">
                                    <a title="Редактировать" href="{$this->url(['id' => $book->getId(), 'action' => 'edit'], 'book_opt')}"></a>
                                </div>

                                <div class="option">
                                    <a href="{$this->url(['id' => $book->getId(), 'action' => 'edit'], 'book_opt')}">Edit</a>
                                </div>
                            {/if}
                            <div class="option">
                                <a href="{$this->url(['id' => $book->getId(), 'action' => 'download'], 'book_opt')}">Download</a>
                            </div>
                        </div>
                        <span class="ui-icon ui-icon-wrench"></span>
                    </div>
                {/if}

                <ul class="books_list_data">

                    <li class="books_list_genre">
                        <h6>Жанры:</h6>
                        <ul>
                            {foreach from = $book->getGenres() item=ganre}
                                <li>{$ganre->getHTMLGenre()}</li>
                            {/foreach}

                            {if $book->getGenres()->count() == 0}
                                <li>Жанры не выбраны</li>
                            {/if}
                        </ul>
                    </li>

                    <li class="books_list_authors">
                        <h6>Авторы:</h6>
                        <ul>
                            {foreach from = $book->getAuthors() item=author}
                                <li>{$author->getHTMLName()}</li>
                            {/foreach}

                            {if $book->getAuthors()->count() == 0}
                                <li>Авторы не назначены</li>
                            {/if}
                        </ul>
                    </li>
                </ul>
            </li>
        {/foreach}
    </ul>

    {include file="pagination.tpl"}

</div>