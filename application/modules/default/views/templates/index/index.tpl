<div class="col-lg-12">
    <h1>Список книг</h1>

    <div class="left">
        <a href="{$this->url(['controller' => 'index', 'action' => 'add'])}">Добавить</a>
    </div>

    <ul>
        {foreach from = $books item=book}
            <li class="task_list">

                <div class="col-lg-6">
                    <h4>{$book->getName()}</h4>

                    <h6>Жанры:</h6>
                    <ul>
                        {foreach from = $book->getGenre() item=ganre}
                            <li>{$ganre->getGenre()}</li>
                        {/foreach}

                        {if $book->getGenre()->count() == 0}
                            <li>Жанры не выбраны</li>
                        {/if}
                    </ul>
                </div>

                <div class="col-lg-6">
                    <div class="task_list_options">
                        <ul class="inline-list">
                            <li>
                                <a href="{$this->url(['controller' => 'index', 'action' => 'delete', 'id' => $book->getId()])}">Delete</a>
                            </li>
                            <li>
                                <a href="{$this->url(['controller' => 'index', 'action' => 'edit', 'id' => $book->getId()])}">Edit</a>
                            </li>
                            <li>
                                <a href="{$this->url(['controller' => 'index', 'action' => 'download', 'id' => $book->getId()])}">Download</a>
                            </li>
                        </ul>
                    </div>

                    <h6>Авторы:</h6>
                    <ul>
                        {foreach from = $book->getAuthor() item=author}
                            <li>{$author->getName()}</li>
                        {/foreach}

                        {if $book->getAuthor()->count() == 0}
                            <li>Авторы не назначены</li>
                        {/if}
                    </ul>
                </div>
            </li>
        {/foreach}
    </ul>

</div>