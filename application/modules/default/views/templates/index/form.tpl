

<form id="{$form->getName()}" action="{$form->getAction()}" method="{$form->getMethod()}">

    {$form->name}

    {$form->genres}

    {*<div>*}
        {*<button id="add_genre_button" type="button" class="btn btn-default navbar-btn">Добавить Жанр</button>*}

        {*<div id="add_genre_text" class="hide">*}
            {*<label for="add_new_genre">Добавить новый жанр</label>*}
            {*<input id="add_new_genre" type="text" placeholder="Название"/>*}
        {*</div>*}
    {*</div>*}

    {$form->authors}

    {$form->file}

    {$form->submit}

</form>