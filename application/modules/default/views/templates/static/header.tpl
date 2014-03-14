<div class="header">
    <ul class="nav nav-pills pull-right">
        <li {if $this->checkUrl(['action' => 'index', 'controller' => 'index'])}class="active"{/if}>
            <a href="{$this->url([], 'home')}">Home</a>
        </li>

        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Опции <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{$this->url([], 'authors')}">Авторы</a></li>
                <li class="divider"></li>
                <li><a href="{$this->url([], 'genres')}">Жанры</a></li>
            </ul>
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
