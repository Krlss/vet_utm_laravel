<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Dashboard Veterinaria UTM',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Clínica Veterinaria</b>',
    'logo_img' => 'logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'SIM',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'flex flex-col items-center justify-center bg-secondary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => 'sticky-top',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => false,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 400,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */
    'menu' => [

        [
            'text'  => date('d/m/Y'),
            'url' => '#',
            'topnav_right' => true
        ],
        [
            'id' => 2,
            'icon' => 'fa fa-bell',
            'type'         => 'navbar-notification',
            'topnav_right' => true,
            'url' => '#'
        ],

        [
            'text' => 'Dashboard',
            'url'  => '/dashboard',
            'icon'      => 'fas fa-tachometer-alt',
            'can'          => 'dashboard.home',
            'active' => ['']
        ],
        [
            'header' => 'Administración',
            'can' => [
                'dashboard.users.index',
                'dashboard.pets.index',
                'dashboard.reports.index'
            ]
        ],
        [
            'text'      => 'Inventario',
            'icon'      => 'fas fa-bars',
            'active'    => ['dashboard/inventory*'],
            'route'         => 'dashboard.inventory.index',
            'can'          => 'inventory.products.index'
        ],
        [
            'text'      => 'Usuarios',
            'icon'      => 'fas fa-users',
            'active'    => ['dashboard/users*'],
            'route'         => 'dashboard.users.index',
            'can'          => 'dashboard.users.index'
        ],
        [
            'text'      => 'Mascotas',
            'icon'      => 'fas fa-paw',
            'active'    => ['dashboard/pets*'],
            'route'         => 'dashboard.pets.index',
            'can'          => 'dashboard.pets.index'
        ],
        [
            'text'      => 'Reportes',
            'icon'      => 'fas fa-list-alt',
            'active'    => ['dashboard/reports*'],
            'route'         => 'dashboard.reports.index',
            'can'          => 'dashboard.reports.index'
        ],
        [
            'text' => 'Productos por expirar',
            'icon' => 'fa fa-info-circle',
            'route' => 'dashboard.products-expires.index',
            'active' => ['dashboard.products-expires.*'],
            'can' => ['inventory.expires-products.index', 'inventory.expires-stock-products.index']
        ],
        [
            'header' => 'Administración de la página',
            'can' => [
                'dashboard.roles.index',
                'dashboard.audit.index',
                'dashboard.species.index',
                'dashboard.races.index',
                'dashboard.furs.index'
            ]
        ],
        [
            'text'      => 'Auditoria',
            'icon'      => 'fas fa-eye',
            'active'    => ['dashboard/audit*'],
            'route'         => 'dashboard.audit.index',
            'can'          => 'dashboard.audit.index'
        ],
        [
            'text' => 'Mascotas',
            'icon'      => 'fas fa-paw',
            'active'    => ['dashboard/species*', 'dashboard/races*', 'dashboard/furs*'],
            'can'          => ['dashboard.species.index', 'dashboard.races.index', 'dashboard.furs.index'],
            'submenu' => [
                [
                    'text' => 'Especies',
                    'icon' => 'fas fa-otter',
                    'route' => 'dashboard.species.index',
                    'active'    => ['dashboard/species*'],
                    'can'          => 'dashboard.species.index',
                ],
                [
                    'text' => 'Pelajes',
                    'icon' => 'fas fa-list-alt',
                    'route' => 'dashboard.furs.index',
                    'active'    => ['dashboard/furs*'],
                    'can'          => 'dashboard.furs.index',
                ],
                [
                    'text' => 'Razas',
                    'icon' => 'fas fa-tag',
                    'route' => 'dashboard.races.index',
                    'active'    => ['dashboard/races*'],
                    'can'          => 'dashboard.races.index',
                ],
            ]
        ],
        [
            'text' => 'Regiones',
            'icon'      => 'fas fa-map',
            'active'    => ['dashboard/provinces*', 'dashboard/cantons*', 'dashboard/parishs*'],
            'can'          => ['dashboard.provinces.index', 'dashboard.cantons.index', 'dashboard.parishs.index'],
            'submenu' => [
                [
                    'text' => 'Provincias',
                    'route' => 'dashboard.provinces.index',
                    'active'    => ['dashboard/provinces*'],
                    'can'          => 'dashboard.provinces.index',
                ],
                [
                    'text' => 'Cantones',
                    'route' => 'dashboard.cantons.index',
                    'active'    => ['dashboard/cantons*'],
                    'can'          => 'dashboard.cantons.index',
                ],
                [
                    'text' => 'Parroquias',
                    'route' => 'dashboard.parishs.index',
                    'active'    => ['dashboard/parishs*'],
                    'can'          => 'dashboard.parishs.index',
                ],
            ]
        ],
        [
            'text' => 'Categorías',
            'route' => 'categories.index',
            'icon' => 'fa fa-tag',
            'active'    => ['categories*'],
            'can' => 'inventory.categories.index'
        ],
        [
            'text' => 'Tipos',
            'route' => 'types.index',
            'icon' => 'fa fa-bookmark',
            'active'    => ['types*'],
            'can' => 'inventory.types.index'
        ],
        [
            'text' => 'Unidades de medida',
            'route' => 'units.index',
            'icon' => 'fa fa-list',
            'active'    => ['units*'],
            'can' => 'inventory.units.index'
        ],
        [
            'text'      => 'Roles y permisos',
            'icon'      => 'fas fa-list-alt',
            'active'    => ['dashboard/roles*', 'dashboard/permissions*'],
            'route'         => 'dashboard.roles.index',
            'can'          => 'dashboard.roles.index'
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
