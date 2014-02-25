<div class="col-lg-12">

    <div class="add_new">
        <a href="{$this->url([], 'add_auth')}">Добавить</a>
    </div>

    <h1>Список Авторов</h1>

    <ul>
        {foreach from = $authors item=author}
            <li class="task_list two-col">
                <div class="left-col">
                    <h4>{$author->getName()}</h4>
                </div>

                <div class="right-col">
                    <ul class="inline-list">
                        <li>
                            <a href="{$this->url(['id' => $author->getId()], 'edit_auth')}">Edit</a>
                        </li>
                        <li>
                            <a href="{$this->url(['id' => $author->getId()], 'delete_auth')}">Delete</a>
                        </li>
                    </ul>
                </div>
            </li>
        {/foreach}
    </ul>

</div>