<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li class="header">Навигация</li>
    <li class="treeview">
        <a href="/">
            <i class="fa fa-dashboard"></i> <span>На сайт</span>
        </a>
    </li>
    <li>
        <a href="{{route('posts.index')}}">
            <i class="fa fa-sticky-note-o"></i> <span>Объявления</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">1</small>
            </span>
        </a>
    </li>
    <li><a href=""><i class="fa fa-tags"></i> <span>Мета Теги</span></a></li>
    <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>
</ul>