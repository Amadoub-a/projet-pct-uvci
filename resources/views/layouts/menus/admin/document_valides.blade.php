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
        <li>
            <a href="{{ route('back.acte-mariages') }}" class="{{Route::currentRouteName() === 'back.acte-mariages' ? 'mm-active' : ''}}">
                <i class="fa fa-certificate"></i>
                Acte de mariage
            </a>
        </li>
        <li>
            <a href="{{ route('back.acte-deces') }}" class="{{Route::currentRouteName() === 'back.acte-deces' ? 'mm-active' : ''}}">
                <i class="fa fa-certificate"></i>
                Acte de décès
            </a>
        </li>
        <li>
            <a href="{{ route('back.copie-acte') }}" class="{{Route::currentRouteName() === 'back.copie-acte' ? 'mm-active' : ''}}">
                <i class="fa fa-certificate"></i>
                Copie d'acte
            </a>
        </li>
    </ul>
</li>