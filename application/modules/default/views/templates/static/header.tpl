<div class="header">
    <ul class="nav nav-pills pull-right">
        <li {if $this->checkUrl(['action' => 'index', 'controller' => 'index'])}class="active"{/if}>
            <a href="{$this->url([], 'home')}">Home</a>
        </li>

        {* <li><a href="#">Войти</a></li>
        <li><a href="#">Зарегистрироваться</a></li>
        <li {if Task_Main::checkUrl(['action' => 'index', 'controller' => 'authors'])}class="active"{/if}>
            <a href="{$this->url([], 'authors')}">Авторы</a>
        </li>

        <li {if Task_Main::checkUrl(['action' => 'index', 'controller' => 'genres'])}class="active"{/if}>
            <a href="{$this->url([], 'genres')}">Жанры</a>
        </li>*}
        <li {if $this->checkUrl(['action' => 'options', 'controller' => 'index'])}class="active"{/if}>
            <a href="{$this->url([], 'options')}">Опции</a>
        </li>


        {if $this->auth()->hasIdentity()}
            <li {if $this->checkUrl(['action' => 'logout', 'controller' => 'auth'])}class="active"{/if}>
                <a href="{$this->url([], 'logout')}">Выйти</a>
            </li>
        {else}
            <li {if $this->checkUrl(['action' => 'login', 'controller' => 'auth'])}class="active"{/if}>
                <a href="{$this->url([], 'login')}">Войти</a>
            </li>
        {/if}
    </ul>
    <h3 class="text-muted">Тестовое задание</h3>
</div>
