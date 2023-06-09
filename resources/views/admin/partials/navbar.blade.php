<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="m-0 p-0 container-fluid">
        <button class="sidebar-toggle navbar-toggle--sidebar"
                id="sidebar-toggle">
            @include('components.icons.toggle')
        </button>

        <button class="navbar-toggler navbar-toggle--navbar"
                id="navbar-toggle"
                data-toggle="collapse"
                data-target="#navbar-content">
            @include('components.icons.toggle')
        </button>

        <div class="collapse navbar-collapse" id="navbar-content">
            <ul class="navbar-nav d-flex justify-content-end w-100">
                @if(auth()->user()->isOwner())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        {{ __('_section.users') }}
                    </a>
                </li>
                @endif
                @if(auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.create') }}">
                        Регистрация клиента
                    </a>
                </li>
                @endif
                @if(is_setting('1'))
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" data-toggle="dropdown">
                        {{ __('_section.catalog') }}
                    </a>
                    <div class="navbar-dropdown-menu dropdown-menu">
                        @if(is_access('benefit_read'))
                        <a class="dropdown-item" href="{{ route('benefits.index') }}">
                            {{ __('_section.benefits') }}
                        </a>
                        @endif
                        @if(is_access('method_read'))
                        <a class="dropdown-item" href="{{ route('methods.index') }}">
                            {{ __('_section.methods') }}
                        </a>
                        @endif
                        @if(is_access('education_read'))
                        <a class="dropdown-item" href="{{ route('educations.index') }}">
                            {{ __('_section.educations') }}
                        </a>
                        @endif
                        @if(is_access('specialization_read'))
                        <a class="dropdown-item" href="{{ route('specializations.index') }}">
                            {{ __('_section.specializations') }}
                        </a>
                        @endif
                    </div>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link pr-3" href="#" data-toggle="dropdown">
                        {{ auth()->user()->surname_name }}
                    </a>
                    <form class="navbar-dropdown-menu dropdown-menu"
                          action="{{ route('logout') }}"
                          method="POST">
                        @csrf
                        <button class="dropdown-item">
                            {{ __('_action.exit') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
