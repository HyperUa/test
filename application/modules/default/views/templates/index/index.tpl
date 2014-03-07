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

                <h4>{$book->getName()}</h4>

                <ul class="books_list_data">

                    <li class="books_list_genre">
                        <h6>Жанры:</h6>
                        <ul>
                            {foreach from = $book->getGenres() item=ganre}
                                <li>{$ganre->getGenre()}</li>
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
                                <li>{$author->getName()}</li>
                            {/foreach}

                            {if $book->getAuthors()->count() == 0}
                                <li>Авторы не назначены</li>
                            {/if}
                        </ul>
                    </li>

                    {if $hasAuth}
                    <li class="books_list_options">
                        <div class="task_list_options">
                            <ul class="inline-list">
                                {if $id == $book->getUser()->getId()}
                                    <li>
                                        <a href="{$this->url(['id' => $book->getId(), 'action' => 'delete'], 'book_opt')}">Delete</a>
                                    </li>

                                    <li class="ui-state-default ui-corner-all" title=".ui-icon-wrench">
                                        <a title="Редактировать" href="{$this->url(['id' => $book->getId(), 'action' => 'edit'], 'book_opt')}">
                                            <span class="ui-icon ui-icon-wrench"></span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{$this->url(['id' => $book->getId(), 'action' => 'edit'], 'book_opt')}">Edit</a>
                                    </li>
                                {/if}
                                <li>
                                    <a href="{$this->url(['id' => $book->getId(), 'action' => 'download'], 'book_opt')}">Download</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {/if}
                </ul>
            </li>
        {/foreach}
    </ul>

    {include file="pagination.tpl"}

</div>