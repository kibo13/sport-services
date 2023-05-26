<nav id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <a class="sidebar-logo__link" href="{{ route('home') }}">
                <img class="sidebar-logo__icon"
                     src="{{ asset('assets/icons/logo.svg') }}"
                     alt="{{ __('logotype') }}"
                     title="{{ __('_section.cabinet') }}">
                <span class="sidebar-logo__text">
                    {{ __('_section.cabinet') }}
                </span>
            </a>
        </div>
    </div>
    <ul class="sidebar-list">
        <li class="sidebar-list__item {{ is_active('home', 'sidebar-list__item--active') }}">
            <a class="sidebar-list__link" href="{{ route('home') }}" title="{{ __('_section.home') }}">
                <i class="fa fa-home sidebar-list__icon"></i>
                <span class="sidebar-list__text">
                    {{ __('_section.home') }}
                </span>
            </a>
        </li>
        <li class="sidebar-list__item {{ is_active('profile*', 'sidebar-list__item--active') }}">
            <a class="sidebar-list__link" href="{{ route('profile.index') }}" title="{{ __('_section.profile') }}">
                <i class="fa fa-user-circle-o sidebar-list__icon"></i>
                <span class="sidebar-list__text">
                    {{ __('_section.profile') }}
                </span>
            </a>
        </li>
        @if(is_access('service_read'))
        <li class="sidebar-list__item {{ is_active('service*', 'sidebar-list__item--active') }}">
            <a class="sidebar-list__link" href="{{ route('services.index') }}" title="{{ __('_section.services') }}">
                <i class="fa fa-globe sidebar-list__icon"></i>
                <span class="sidebar-list__text">
                    {{ __('_section.services') }}
                </span>
            </a>
        </li>
        @endif
        <li class="sidebar-list__item {{ is_active('rules*', 'sidebar-list__item--active') }}">
            <a class="sidebar-list__link" href="{{ route('rules.index') }}" title="{{ __('_section.rules') }}">
                <i class="fa fa-file-text-o sidebar-list__icon"></i>
                <span class="sidebar-list__text">
                    {{ __('_section.rules') }}
                </span>
            </a>
        </li>
        @if(is_access('client_read'))
        <li class="sidebar-list__item {{ is_active('clients*', 'sidebar-list__item--active') }}">
            <a class="sidebar-list__link" href="{{ route('clients.index') }}" title="{{ __('_section.clients') }}">
                <i class="fa fa-users sidebar-list__icon"></i>
                <span class="sidebar-list__text">
                    {{ __('_section.clients') }}
                </span>
            </a>
        </li>
        @endif
        @if(is_access('trainer_read'))
        <li class="sidebar-list__item {{ is_active('trainers*', 'sidebar-list__item--active') }}">
            <a class="sidebar-list__link" href="{{ route('trainers.index') }}" title="{{ __('_section.trainers') }}">
                <i class="fa fa-universal-access sidebar-list__icon"></i>
                <span class="sidebar-list__text">
                    {{ __('_section.trainers') }}
                </span>
            </a>
        </li>
        @endif
        @if(is_access('event_read'))
        <li class="sidebar-list__item {{ is_active('event*', 'sidebar-list__item--active') }}">
            <a class="sidebar-list__link" href="{{ route('events.index') }}" title="{{ __('_section.events') }}">
                <i class="fa fa-calendar-o  sidebar-list__icon"></i>
                <span class="sidebar-list__text">
                {{ __('_section.events') }}
            </span>
            </a>
        </li>
        @endif
        @if(is_access('report_read'))
        <li class="sidebar-list__item {{ is_active('report*', 'sidebar-list__item--active') }}">
            <a class="sidebar-list__link" href="{{ route('reports.index') }}" title="{{ __('_section.reports') }}">
                <i class="fa fa-file-text-o sidebar-list__icon"></i>
                <span class="sidebar-list__text">
                    {{ __('_section.reports') }}
                </span>
            </a>
        </li>
        @endif
    </ul>
</nav>
