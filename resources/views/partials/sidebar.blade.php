@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('abrigosoftware.as_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('abrigosoftware.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('abrigosoftware.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('abrigosoftware.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('clean_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-briefcase"></i>
                    <span>@lang('abrigosoftware.clean-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('clean_access')
                    <li>
                        <a href="{{ route('admin.cleans.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('abrigosoftware.cleans.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('minhas_faxina_access')
                    <li>
                        <a href="{{ route('admin.cleans_mine.index') }}">
                            <i class="fa fa-file-text-o"></i>
                            <span>@lang('abrigosoftware.minhas-faxinas.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('faxinas_aberta_access')
                    <li>
                        <a href="{{ route('admin.cleans_open.index') }}">
                            <i class="fa fa-check-circle"></i>
                            <span>@lang('abrigosoftware.faxinas-abertas.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('cleans_feedback_access')
                    <li>
                        <a href="{{ route('admin.cleans_feedbacks.index') }}">
                            <i class="fa fa-exclamation"></i>
                            <span>@lang('abrigosoftware.cleans-feedbacks.title')</span>
                        </a>
                    </li>@endcan
					
					@can('clean_calendar_access')
                    <li>
                        <a href="{{ route('admin.clean_calendar.index') }}">
                            <i class="fa fa-calendar"></i>
                            <span>Calendário</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('configuration_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('abrigosoftware.configurations.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('cleaning_status_access')
                    <li>
                        <a href="{{ route('admin.cleaning_statuses.index') }}">
                            <i class="fa fa-server"></i>
                            <span>@lang('abrigosoftware.cleaning-status.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('cleaning_type_access')
                    <li>
                        <a href="{{ route('admin.cleaning_types.index') }}">
                            <i class="fa fa-list"></i>
                            <span>@lang('abrigosoftware.cleaning-type.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('address_type_access')
                    <li>
                        <a href="{{ route('admin.address_types.index') }}">
                            <i class="fa fa-building-o"></i>
                            <span>@lang('abrigosoftware.address-type.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('clean_category_access')
                    <li>
                        <a href="{{ route('admin.clean_categories.index') }}">
                            <i class="fa fa-exchange"></i>
                            <span>@lang('abrigosoftware.clean-category.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('subscription_status_access')
                    <li>
                        <a href="{{ route('admin.subscription_statuses.index') }}">
                            <i class="fa fa-align-justify"></i>
                            <span>@lang('abrigosoftware.subscription-status.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('payment_status_access')
                    <li>
                        <a href="{{ route('admin.payment_statuses.index') }}">
                            <i class="fa fa-money"></i>
                            <span>@lang('abrigosoftware.payment-status.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('clients_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-address-book-o"></i>
                    <span>@lang('abrigosoftware.clients-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('client_access')
                    <li>
                        <a href="{{ route('admin.users.index', ['role_id' => 4]) }}">
                            <i class="fa fa-address-card-o"></i>
                            <span>@lang('abrigosoftware.clients.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('payment_management_access')
            <li class="">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span>@lang('abrigosoftware.payment-management.title')</span>
                </a>
            </li>@endcan
            

            @php ($unread = App\MessengerTopic::countUnread())
            <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                <a href="{{ route('admin.messenger.index') }}">
                    <i class="fa fa-envelope"></i>

                    <span>Mensagens</span>
                    @if($unread > 0)
						<span class="pull-right-container">
						  <small class="label pull-right bg-yellow">{{ ($unread > 0 ? $unread : '') }}</small>
						</span>
                    @endif
                </a>
            </li>
            <style>
                .page-sidebar-menu .unread * {
                    font-weight:bold !important;
                }
            </style>

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('abrigosoftware.as_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('abrigosoftware.as_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

