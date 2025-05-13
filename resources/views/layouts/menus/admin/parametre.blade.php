<li>
    <a href="#" aria-expanded="false">
        <i class="metismenu-icon pe-7s-config"></i>
        Param&egrave;tre
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul class="{{request()->is('parametre/*') ? 'mm-collapse mm-show' : 'mm-collapse'}}">
        <li>
            <a href="{{ route('parametre.nations.index') }}" class="{{Route::currentRouteName() === 'parametre.nations.index' ? 'mm-active' : ''}}">
                <i class="fa fa-certificate"></i>
                Pays
            </a>
        </li>
        <li>
            <a href="{{ route('parametre.communes.index') }}" class="{{Route::currentRouteName() === 'parametre.communes.index' ? 'mm-active' : ''}}">
                <i class="fa fa-certificate"></i>
                Communes / S-pr&eacute;fecture
            </a>
        </li>
    </ul>
</li>