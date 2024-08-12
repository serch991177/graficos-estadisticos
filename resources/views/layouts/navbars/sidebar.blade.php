<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ _('WD') }}</a>
            <a href="#" class="simple-text logo-normal">{{ _('White Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ _('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#facebook-feature" aria-expanded="true">
                    <i class="fab fa-facebook" ></i>
                    <span class="nav-link-text" >{{ __('Facebook') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="facebook-feature">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'dashboard') class="active " @endif>
                            <a href="{{ route('home')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ _('Graficos') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'reportes_facebook') class="active " @endif>
                            <a href="{{ route('reportes_facebook')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('Reportes') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#Instagram-feat" aria-expanded="true">
                    <i class="fab fa-instagram" ></i>
                    <span class="nav-link-text" >{{ __('Instagram') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="Instagram-feat">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ _('Graficos') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('Reportes') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>