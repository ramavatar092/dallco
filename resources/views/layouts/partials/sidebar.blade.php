<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-boxicons-template/index.html">
                    <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/logo.png" /></div>
                    <h2 class="brand-text mb-0">Frest</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="">
            <li class=" nav-item"><a href="{{ route('dashboard') }}"><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            {{--<li class=" navigation-header"><span>Apps</span>
            </li>
            <li class=" nav-item"><a href="app-email.html"><i class="bx bx-envelope"></i><span class="menu-title" data-i18n="Email">Email</span></a>
            </li>
            <li class=" nav-item"><a href="app-chat.html"><i class="bx bx-chat"></i><span class="menu-title" data-i18n="Chat">Chat</span></a>
            </li>
            <li class=" nav-item"><a href="app-todo.html"><i class="bx bx-check-circle"></i><span class="menu-title" data-i18n="Todo">Todo</span></a>
            </li>
            <li class=" nav-item"><a href="app-calendar.html"><i class="bx bx-calendar"></i><span class="menu-title" data-i18n="Calendar">Calendar</span></a>
            </li>
            <li class=" nav-item"><a href="app-kanban.html"><i class="bx bx-grid-alt"></i><span class="menu-title" data-i18n="Kanban">Kanban</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-file"></i><span class="menu-title" data-i18n="Invoice">Invoice</span></a>
                <ul class="menu-content">
                    <li><a href="app-invoice-list.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Invoice List</span></a>
                    </li>
                    <li><a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice">Invoice</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Edit">Invoice Edit</span></a>
                    </li>
                    <li><a href="app-invoice-add.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">Invoice Add</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="app-file-manager.html"><i class="bx bx-save"></i><span class="menu-title" data-i18n="File Manager">File Manager</span></a>
            </li>
            <li class=" navigation-header"><span>UI Elements</span>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-repeat"></i><span class="menu-title" data-i18n="Content">Content</span></a>
                <ul class="menu-content">
                    <li><a href="content-grid.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Grid">Grid</span></a>
                    </li>
                    <li><a href="content-typography.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Typography">Typography</span></a>
                    </li>
                    <li><a href="content-text-utilities.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Text Utilities">Text Utilities</span></a>
                    </li>
                    <li><a href="content-syntax-highlighter.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Syntax Highlighter">Syntax Highlighter</span></a>
                    </li>
                    <li><a href="content-helper-classes.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Helper Classes">Helper Classes</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="colors.html"><i class="bx bx-droplet"></i><span class="menu-title" data-i18n="Colors">Colors</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-bulb"></i><span class="menu-title" data-i18n="Icons">Icons</span></a>
                <ul class="menu-content">
                    <li><a href="icons-livicons.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="LivIcons">LivIcons</span></a>
                    </li>
                    <li><a href="icons-boxicons.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="boxicons">Boxicons</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-square-rounded"></i><span class="menu-title" data-i18n="Card">Card</span></a>
                <ul class="menu-content">
                    <li><a href="card-basic.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Basic">Basic</span></a>
                    </li>
                    <li><a href="card-actions.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Card Actions">Card Actions</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="widgets.html"><i class="bx bx-grid"></i><span class="menu-title" data-i18n="Card Widgets">Widgets</span><span class="badge badge-light-primary badge-pill badge-round float-right">New</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-briefcase-alt-2"></i><span class="menu-title" data-i18n="Components">Components</span></a>
                <ul class="menu-content">
                    <li><a href="component-alerts.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Alerts">Alerts</span></a>
                    </li>
                    <li><a href="component-buttons-basic.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Buttons">Buttons</span></a>
                    </li>
                    <li><a href="component-breadcrumbs.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Breadcrumbs">Breadcrumbs</span></a>
                    </li>
                    <li><a href="component-carousel.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Carousel">Carousel</span></a>
                    </li>
                    <li><a href="component-collapse.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Collapse">Collapse</span></a>
                    </li>
                    <li><a href="component-dropdowns.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Dropdowns">Dropdowns</span></a>
                    </li>
                    <li><a href="component-list-group.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="List Group">List Group</span></a>
                    </li>
                    <li><a href="component-modals.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Modals">Modals</span></a>
                    </li>
                    <li><a href="component-pagination.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Pagination">Pagination</span></a>
                    </li>
                    <li><a href="component-navbar.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Navbar">Navbar</span></a>
                    </li>
                    <li><a href="component-tabs-component.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Tabs Component">Tabs Component</span></a>
                    </li>
                    <li><a href="component-pills-component.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Pills Component">Pills Component</span></a>
                    </li>
                    <li><a href="component-tooltips.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Tooltips">Tooltips</span></a>
                    </li>
                    <li><a href="component-popovers.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Popovers">Popovers</span></a>
                    </li>
                    <li><a href="component-badges.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Badges">Badges</span></a>
                    </li>
                    <li><a href="component-pill-badges.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Pill Badges">Pill Badges</span></a>
                    </li>
                    <li><a href="component-progress.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Progress">Progress</span></a>
                    </li>
                    <li><a href="component-media-objects.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Media Objects">Media Objects</span></a>
                    </li>
                    <li><a href="component-spinner.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Spinner">Spinner</span></a>
                    </li>
                    <li><a href="component-bs-toast.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Toasts">Toasts</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-briefcase"></i><span class="menu-title" data-i18n="Extra Components">Extra Components</span></a>
                <ul class="menu-content">
                    <li><a href="ex-component-avatar.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Avatar">Avatar</span></a>
                    </li>
                    <li><a href="ex-component-chips.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Chips">Chips</span></a>
                    </li>
                    <li><a href="ex-component-divider.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Divider">Divider</span></a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span>Forms &amp; Tables</span>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-check"></i><span class="menu-title" data-i18n="Form Elements">Form Elements</span></a>
                <ul class="menu-content">
                    <li><a href="form-inputs.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Input">Input</span></a>
                    </li>
                    <li><a href="form-input-groups.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Input Groups">Input Groups</span></a>
                    </li>
                    <li><a href="form-number-input.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Number Input">Number Input</span></a>
                    </li>
                    <li><a href="form-select.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Select">Select</span></a>
                    </li>
                    <li><a href="form-radio.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Radio">Radio</span></a>
                    </li>
                    <li><a href="form-checkbox.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Checkbox">Checkbox</span></a>
                    </li>
                    <li><a href="form-switch.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Switch">Switch</span></a>
                    </li>
                    <li><a href="form-textarea.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Textarea">Textarea</span></a>
                    </li>
                    <li><a href="form-quill-editor.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Quill Editor">Quill Editor</span></a>
                    </li>
                    <li><a href="form-file-uploader.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="File Uploader">File Uploader</span></a>
                    </li>
                    <li><a href="form-date-time-picker.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Date &amp; Time Picker">Date &amp; Time Picker</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="form-layout.html"><i class="bx bx-slider"></i><span class="menu-title" data-i18n="Form Layout">Form Layout</span></a>
            </li>
            <li class=" nav-item"><a href="form-wizard.html"><i class="bx bx-list-plus"></i><span class="menu-title" data-i18n="Form Wizard">Form Wizard</span></a>
            </li>
            <li class=" nav-item"><a href="form-validation.html"><i class="bx bx-check-shield"></i><span class="menu-title" data-i18n="Form Validation">Form Validation</span></a>
            </li>
            <li class=" nav-item"><a href="form-repeater.html"><i class="bx bx-detail"></i><span class="menu-title" data-i18n="Form Repeater">Form Repeater</span></a>
            </li>
            <li class=" nav-item"><a href="table.html"><i class="bx bx-grid-alt"></i><span class="menu-title" data-i18n="Table">Table</span></a>
            </li>
            <li class=" nav-item"><a href="table-extended.html"><i class="bx bx-table"></i><span class="menu-title" data-i18n="bx bx-selection">Table extended</span></a>
            </li>
            <li class=" nav-item"><a href="table-datatable.html"><i class="bx bx-map-alt"></i><span class="menu-title" data-i18n="Datatable">Datatable</span></a>
            </li>
            <li class=" navigation-header"><span>Pages</span>
            </li>
            <li class=" nav-item"><a href="page-user-profile.html"><i class="bx bx-user"></i><span class="menu-title" data-i18n="User Profile">User Profile</span></a>
            </li>
            <li class=" nav-item"><a href="page-faq.html"><i class="bx bx-help-circle"></i><span class="menu-title" data-i18n="FAQ">FAQ</span></a>
            </li>
            <li class=" nav-item"><a href="page-knowledge-base.html"><i class="bx bx-error-circle"></i><span class="menu-title" data-i18n="Knowledge Base">Knowledge Base</span></a>
            </li>
            <li class=" nav-item"><a href="page-search.html"><i class="bx bx-search"></i><span class="menu-title" data-i18n="Search">Search</span></a>
            </li>
            <li class=" nav-item"><a href="page-account-settings.html"><i class="bx bx-wrench"></i><span class="menu-title" data-i18n="Account Settings">Account Settings</span></a>
            </li>--}}


            <li class=" nav-item"><a href="#"><i class="bx bx-user-plus"></i><span class="menu-title" data-i18n="User">User</span></a>
                <ul class="menu-content">
                    <li><a href="{{ route('users.index') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="List">List</span></a>
                    </li>
                </ul>
            </li>
             <li class=" nav-item"><a href="#"><i class="bx bx-user-plus"></i><span class="menu-title" data-i18n="Coupon">Coupon Management</span></a>
                <ul class="menu-content">
                    <li><a href="{{ route('coupons.index') }}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="List">List</span></a>
                    </li>
                </ul>
            </li>


            {{--<li class=" nav-item"><a href="#"><i class="bx bx-building"></i><span class="menu-title" data-i18n="Starter kit">Starter kit</span></a>
                <ul class="menu-content">
                    <li><a href="../../../starter-kit/ltr/vertical-menu-boxicons-template/sk-layout-1-column.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="1 column">1 column</span></a>
                    </li>
                    <li><a href="../../../starter-kit/ltr/vertical-menu-boxicons-template/sk-layout-2-columns.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="2 columns">2 columns</span></a>
                    </li>
                    <li><a href="../../../starter-kit/ltr/vertical-menu-boxicons-template/sk-layout-fixed-navbar.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Fixed navbar">Fixed navbar</span></a>
                    </li>
                    <li><a href="../../../starter-kit/ltr/vertical-menu-boxicons-template/sk-layout-fixed.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Fixed layout">Fixed layout</span></a>
                    </li>
                    <li><a href="../../../starter-kit/ltr/vertical-menu-boxicons-template/sk-layout-static.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Static layout">Static layout</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-lock-open-alt"></i><span class="menu-title" data-i18n="Authentication">Authentication</span></a>
                <ul class="menu-content">
                    <li><a href="auth-login.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Login">Login</span></a>
                    </li>
                    <li><a href="auth-register.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Register">Register</span></a>
                    </li>
                    <li><a href="auth-forgot-password.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Forgot Password">Forgot Password</span></a>
                    </li>
                    <li><a href="auth-reset-password.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Reset Password">Reset Password</span></a>
                    </li>
                    <li><a href="auth-lock-screen.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Lock Screen">Lock Screen</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-share-alt"></i><span class="menu-title" data-i18n="Miscellaneous">Miscellaneous</span></a>
                <ul class="menu-content">
                    <li><a href="page-coming-soon.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Coming Soon">Coming Soon</span></a>
                    </li>
                    <li><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Error">Error</span></a>
                        <ul class="menu-content">
                            <li><a href="error-404.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="404">404</span></a>
                            </li>
                            <li><a href="error-500.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="500">500</span></a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="page-not-authorized.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Not Authorized">Not Authorized</span></a>
                    </li>
                    <li><a href="page-maintenance.html" target="_blank"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Maintenance">Maintenance</span></a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span>Charts &amp; Maps</span>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-pie-chart-alt"></i><span class="menu-title" data-i18n="Charts">Charts</span><span class="badge badge-pill badge-round badge-light-success float-right mr-2">3</span></a>
                <ul class="menu-content">
                    <li><a href="chart-apex.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Apex">Apex</span></a>
                    </li>
                    <li><a href="chart-chartjs.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Chartjs">Chartjs</span></a>
                    </li>
                    <li><a href="chart-chartist.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Chartist">Chartist</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="maps-google.html"><i class="bx bx-globe"></i><span class="menu-title" data-i18n="Google Maps">Google Maps</span></a>
            </li>
            <li class=" navigation-header"><span>Extensions</span>
            </li>
            <li class=" nav-item"><a href="ext-component-sweet-alerts.html"><i class="bx bx-error"></i><span class="menu-title" data-i18n="Sweet Alert">Sweet Alert</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-toastr.html"><i class="bx bx-map-alt"></i><span class="menu-title" data-i18n="Toastr">Toastr</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-noui-slider.html"><i class="bx bx-slider-alt"></i><span class="menu-title" data-i18n="NoUi Slider">NoUi Slider</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-drag-drop.html"><i class="bx bx-copy-alt"></i><span class="menu-title" data-i18n="Drag &amp; Drop">Drag &amp; Drop</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-tour.html"><i class="bx bx-paper-plane"></i><span class="menu-title" data-i18n="Tour">Tour</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-swiper.html"><i class="bx bx-tab"></i><span class="menu-title" data-i18n="l18n">Swiper</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-treeview.html"><i class="bx bx-menu-alt-left"></i><span class="menu-title" data-i18n="l18n">Treeview</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-block-ui.html"><i class="bx bx-fullscreen"></i><span class="menu-title" data-i18n="l18n">Block-UI</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-media-player.html"><i class="bx bx-music"></i><span class="menu-title" data-i18n="l18n">Media Player</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-miscellaneous.html"><i class="bx bx-sitemap"></i><span class="menu-title" data-i18n="Miscellaneous">Miscellaneous</span></a>
            </li>
            <li class=" nav-item"><a href="ext-component-i18n.html"><i class="bx bx-globe"></i><span class="menu-title" data-i18n="i18n">i18n</span></a>
            </li>
            <li class=" navigation-header"><span>Others</span>
            </li>
            <li class=" nav-item"><a href="#"><i class="bx bx-menu"></i><span class="menu-title" data-i18n="Menu Levels">Menu Levels</span></a>
                <ul class="menu-content">
                    <li><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Second Level">Second Level</span></a>
                    </li>
                    <li><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Second Level">Second Level</span></a>
                        <ul class="menu-content">
                            <li><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Third Level">Third Level</span></a>
                            </li>
                            <li><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Third Level">Third Level</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="disabled nav-item"><a href="#"><i class="bx bx-unlink"></i><span class="menu-title" data-i18n="Disabled Menu">Disabled Menu</span></a>
            </li>
            <li class=" navigation-header"><span>Support</span>
            </li>
            <li class=" nav-item"><a href="https://pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/documentation" target="_blank"><i class="bx bx-folder"></i><span class="menu-title" data-i18n="Documentation">Documentation</span></a>
            </li>
            <li class=" nav-item"><a href="https://pixinvent.ticksy.com/" target="_blank"><i class="bx bx-purchase-tag-alt"></i><span class="menu-title" data-i18n="Raise Support">Raise Support</span></a>
            </li>--}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->