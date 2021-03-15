@php
$path = explode('/', request()->path());
$path[1] = (array_key_exists(1, $path)> 0)?$path[1]:'';
$path[2] = (array_key_exists(2, $path)> 0)?$path[2]:'';
$path[0] = ($path[0] === '')?'documents':$path[0];
@endphp
<aside id="sidebar-left" class="sidebar-left">
    <div class="sidebar-header">
        <div class="sidebar-title">
            Menu
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    @if(in_array('dashboard', $vc_modules))
                    <li class="{{ ($path[0] === 'dashboard')?'nav-active':'' }}">
                        <a class="nav-link" href="{{ route('tenant.dashboard.index') }}">
                            <i class="fas fa-tachometer-alt" aria-hidden="true"></i>
                            <span>DASHBOARD</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-parent 
                    {{ ($path[0] === 'items')?'nav-active nav-expanded':'' }}
                    {{ ($path[0] === 'categories')?'nav-active nav-expanded':'' }}
                    {{ ($path[0] === 'brands')?'nav-active nav-expanded':'' }}
                    {{ ($path[0] === 'item-lots')?'nav-active nav-expanded':'' }}
                    {{ ($path[0] === 'persons' && $path[1] === 'customers')?'nav-active nav-expanded':'' }}
                    {{ ($path[0] === 'person-types')?'nav-active nav-expanded':'' }}
                    {{ ($path[0] === 'payment_method_types_general')?'nav-active nav-expanded':'' }}
                    {{ ($path[0] === 'persons' && $path[1] === 'suppliers')?'nav-active nav-expanded':'' }}

                    ">
                        <a class="nav-link" href="#">
                            <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                            <span>Catálogos</span>
                        </a>
                        <ul class="nav nav-children">
                            <li class="{{ ($path[0] === 'items')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.items.index')}}">
                                    Productos
                                </a>
                            </li>
                            <li class="{{ ($path[0] === 'categories')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.categories.index')}}">
                                    Categorías
                                </a>
                            </li>
                            <li class="{{ ($path[0] === 'brands')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.brands.index')}}">
                                    Marcas
                                </a>
                            </li>
                            <li class="{{ ($path[0] === 'item-lots')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.item-lots.index')}}">
                                    Series
                                </a>
                            </li>
                            <li class="{{ ($path[0] === 'persons' && $path[1] === 'customers')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.persons.index', ['type' => 'customers'])}}">
                                    Clientes
                                </a>
                            </li>
                            <li class="{{ ($path[0] === 'person-types')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.person_types.index')}}">
                                    Tipos de clientes
                                </a>
                            </li>
                            <li class="{{ ($path[0] === 'payment_method_types_general' && $path[1] === 'purchase')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.payment_method_types_general.index', ['type' => 'purchase'])}}">
                                    Condiciones de pago
                                </a>
                            </li>
                            <li class="{{ ($path[0] === 'persons' && $path[1] === 'suppliers')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.persons.index', ['type' => 'suppliers'])}}">
                                    Proveedores
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(in_array('establishments', $vc_modules))
                    <li class="nav-parent {{ in_array($path[0], ['users', 'establishments'])?'nav-active nav-expanded':'' }}">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <span>Usuarios/Locales & Series</span>
                        </a>
                        <ul class="nav nav-children" style="">
                            <li class="{{ ($path[0] === 'users')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.users.index')}}">
                                    Usuarios
                                </a>
                            </li>
                            <li class="{{ ($path[0] === 'establishments')?'nav-active':'' }}">
                                <a class="nav-link" href="{{route('tenant.establishments.index')}}">
                                    Establecimientos
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                @if(in_array('configuration', $vc_modules))
                <li class="nav-parent {{in_array($path[0], ['companies', 'catalogs', 'advanced', 'tasks', 'inventories','company_accounts','bussiness_turns','offline-configurations','series-configurations','configurations','configuration_mail_servers','terms_conditions','banners','discards']) ? 'nav-active nav-expanded' : ''}}">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cogs" aria-hidden="true"></i>
                        <span>Configuración</span>
                    </a>
                    <ul class="nav nav-children" style="">
                        <li class="{{($path[0] === 'companies') ? 'nav-active': ''}}">
                            <a class="nav-link" href="{{route('tenant.companies.create')}}">
                                Empresa
                            </a>
                        </li>
                        {{-- <li class="{{($path[0] === 'company_accounts') ? 'nav-active': ''}}">
                            <a class="nav-link" href="{{route('tenant.company_accounts.create')}}">
                                Cuentas contables
                            </a>
                        </li> --}}
                        <li class="{{($path[0] === 'bussiness_turns') ? 'nav-active': ''}}">
                            <a class="nav-link" href="{{route('tenant.bussiness_turns.index')}}">
                                Giro de negocio
                            </a>
                        </li>
                        @if(auth()->user()->type != 'integrator')
                        <li class="{{($path[0] === 'catalogs') ? 'nav-active' : ''}}">
                            <a class="nav-link" href="{{route('tenant.catalogs.index')}}">
                                Catálogos
                            </a>
                        </li>
                        @endif

                        <li class="{{($path[0] === 'advanced') ? 'nav-active' : ''}}">
                            <a class="nav-link" href="{{route('tenant.advanced.index')}}">
                                Avanzado
                            </a>
                        </li>

                        <li class="{{($path[1] === 'pdf_templates') ? 'nav-active' : ''}}">
                            <a class="nav-link" href="{{route('tenant.advanced.pdf_templates')}}">
                                Plantillas PDF
                            </a>
                        </li>

                        <li class="{{($path[1] === 'pdf_guide_templates') ? 'nav-active' : ''}}">
                            <a class="nav-link" href="{{route('tenant.advanced.pdf_guide_templates')}}">
                                Plantillas PDF Guía de remisión
                            </a>
                        </li>

                        <li class="{{($path[1] === 'pdf_preprinted_templates') ? 'nav-active' : ''}}">
                            <a class="nav-link" href="{{route('tenant.advanced.pdf_preprinted_templates')}}">
                                Formatos Pre Impresos
                            </a>
                        </li>
                        @if($vc_company->soap_type_id != '03')
                        <li class="{{($path[0] === 'offline-configurations') ? 'nav-active' : ''}}">
                            <a class="nav-link" href="{{route('tenant.offline_configurations.index')}}">
                                Modo offline
                            </a>
                        </li>
                        {{-- <li class="{{($path[0] === 'series-configurations') ? 'nav-active' : ''}}">
                            <a class="nav-link" href="{{route('tenant.series_configurations.index')}}">
                                Numeración de facturación
                            </a>
                        </li> --}}
                        @endif
                        @if(auth()->user()->type != 'integrator' && $vc_company->soap_type_id != '03')
                        <li class="{{($path[0] === 'tasks') ? 'nav-active': ''}}">
                            <a class="nav-link" href="{{route('tenant.tasks.index')}}">Tareas programadas</a>
                        </li>
                        {{-- <li class="{{($path[0] === 'inventories' && $path[1] === 'configuration') ? 'nav-active': ''}}">
                            <a class="nav-link" href="{{route('tenant.inventories.configuration.index')}}">Inventarios</a>
                        </li> --}}
                        @endif
                        <li class="{{ ($path[0] === 'configuration_mail_servers')?'nav-active':'' }}">
                            <a class="nav-link" href="{{route('tenant.configuration_mail_servers.index')}}">
                                Servidores de correo
                            </a>
                        </li>
                        <li class="{{ ($path[0] === 'terms_conditions')?'nav-active':'' }}">
                            <a class="nav-link" href="{{route('tenant.terms_conditions.index')}}">
                                Términos y condiciones
                            </a>
                        </li>
                        <li class="{{ ($path[0] === 'banners')?'nav-active':'' }}">
                            <a class="nav-link" href="{{route('tenant.banners.index')}}">
                                Banners
                            </a>
                        </li>
                        <li class="{{ ($path[0] === 'discards')?'nav-active':'' }}">
                            <a class="nav-link" href="{{route('tenant.discards.index')}}">
                                Descartes
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(in_array('cuenta', $vc_modules))
                <li class=" nav-parent
                        {{ ($path[0] === 'cuenta')?'nav-active nav-expanded':'' }}">
                    <a class="nav-link" href="#">
                        <!--span class="float-right badge badge-red badge-danger mr-3">Nuevo</!--span-->
                        <i class="fas fa-dollar-sign" aria-hidden="true"></i>
                        <span>Mis Pagos</span>
                    </a>
                    <ul class="nav nav-children">
                        <li class="{{ (($path[0] === 'cuenta') && ($path[1] === 'configuration')) ?'nav-active':'' }}">
                            <a class="nav-link" href="{{route('tenant.configuration.index')}}">
                                Configuracion
                            </a>
                        </li>
                        <li class="{{ (($path[0] === 'cuenta') && ($path[1] === 'payment_index')) ?'nav-active':'' }}">
                            <a class="nav-link" href="{{route('tenant.payment.index')}}">
                                Lista de Pagos
                            </a>
                        </li>

                    </ul>
                </li>
                @endif
                </ul>
            </nav>
        </div>
        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>
    </div>
</aside>