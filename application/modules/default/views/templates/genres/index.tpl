<div class="col-lg-12">

    <div class="add_new">
        <a href="{$this->url([], 'add_genre')}">Добавить</a>
    </div>

    <h1>Список жанров</h1>

    <ul>
        {foreach from = $genres item=genre}
        <li class="task_list two-col">
            <div class="left-col">
                <h4>{$genre->getGenre()}</h4>
            </div>

            <div class="right-col">
                <ul class="inline-list">
                    <li>
                        <a href="{$this->url(['id' => $genre->getId()], 'edit_genre')}">Edit</a>
                    </li>
                    <li>
                        <a href="{$this->url(['id' => $genre->getId()], 'delete_genre')}">Delete</a>
                    </li>
                </ul>
            </div>
        </li>
        {/foreach}
    </ul>

</div>