<li>
    <a href="#" aria-expanded="false">
        <i class="metismenu-icon fa fa-check-circle"></i>
        Documents validés
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul class="{{request()->is('back/document-valides/*') ? 'mm-collapse mm-show' : 'mm-collapse'}}">
        <li>
            <a href="{{ route('back.acte-naissances') }}" class="{{Route::currentRouteName() === 'back.acte-naissances' ? 'mm-active' : ''}}">
                <i class="fa fa-certificate"></i>
                Acte de naissance
            </a>
        </li>
    </ul>
</li>