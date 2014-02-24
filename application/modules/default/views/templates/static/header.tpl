<div class="header">
    <ul class="nav nav-pills pull-right">
        <li {if Task_Main::checkUrl(['action' => 'index', 'controller' => 'index'])}class="active"{/if}>
            <a href="{$this->url(['controller' => 'index', 'action' => 'index'])}">Home</a>
        </li>
        <li><a href="#">Войти</a></li>
        <li><a href="#">Зарегистрироваться</a></li>
    </ul>
    <h3 class="text-muted">Тестовое задание</h3>
</div>
