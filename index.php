<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
?>


<!DOCTYPE html>
<html>

<head>
  <title>Admin Dashboard HTML Template</title>
  <meta charset="utf-8">
  <meta content="ie=edge" http-equiv="x-ua-compatible">
  <meta content="template language" name="keywords">
  <meta content="Tamerlan Soziev" name="author">
  <meta content="Admin dashboard html template" name="description">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="favicon.png" rel="shortcut icon">
  <link href="apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">
  <link href="bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
  <link href="bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <link href="bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
  <link href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
  <link href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
  <link href="bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
  <link href="css/main.css?version=4.5.0" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body class="menu-position-side menu-side-left full-screen">
  <div class="all-wrapper solid-bg-all">
    <!--------------------
      START - Top Bar
      -------------------->
    <div class="top-bar color-scheme-bright">
      <div class="logo-w menu-size">
        <a class="logo" href="index.html">
          <div class="logo-element"></div>
          <div class="logo-label">
            Clean Admin
          </div>
        </a>
      </div>

      <div class="top-menu-controls">



        <div class="logged-user-w">
          <div class="logged-user-i">
            <!-- <div class="avatar-w">
              <img alt="" src="img/avatar2.png">
            </div> -->
            <button type="button" class="btn btn-md btn-success">Log Out</button>
            <div class="logged-user-menu color-style-bright">
              <div class="logged-user-avatar-info">
                <div class="logged-user-info-w">
                  <div class="logged-user-name" style="visibility: hidden;">
                    Logged User
                  </div>
                </div>
              </div>
              <div class="bg-icon">
                <i class="os-icon os-icon-wallet-loaded"></i>
              </div>
              <ul>
                <li>
                  <a href="logout.php"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>

    </div>

    <div class="layout-w">
      <!--------------------
        START - Mobile Menu
        -------------------->
      <div class="menu-mobile menu-activated-on-click color-scheme-dark">
        <div class="mm-logo-buttons-w">
          <a class="mm-logo" href="index.html"><img src="img/logo.png"><span>Clean Admin</span></a>
          <div class="mm-buttons">
            <div class="content-panel-open">
              <div class="os-icon os-icon-grid-circles"></div>
            </div>
            <div class="mobile-menu-trigger">
              <div class="os-icon os-icon-hamburger-menu-1"></div>
            </div>
          </div>
        </div>
        <div class="menu-and-user">
          <div class="logged-user-w">
            <div class="avatar-w">
              <img alt="" src="img/avatar1.jpg">
            </div>
            <div class="logged-user-info-w">
              <div class="logged-user-name">
                Maria Gomez
              </div>
              <div class="logged-user-role">
                Administrator
              </div>
            </div>
          </div>
          <!--------------------
            START - Mobile Menu List
            -------------------->
          <ul class="main-menu">
            <li class="has-sub-menu">
              <a href="index.html">
                <div class="icon-w">
                  <div class="os-icon os-icon-layout"></div>
                </div>
                <span>Dashboard</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="index.html">Dashboard 1</a>
                </li>
                <li>
                  <a href="apps_crypto.html">Crypto Dashboard <strong class="badge badge-danger">Hot</strong></a>
                </li>
                <li>
                  <a href="apps_support_dashboard.html">Dashboard 3</a>
                </li>
                <li>
                  <a href="apps_projects.html">Dashboard 4</a>
                </li>
                <li>
                  <a href="apps_bank.html">Dashboard 5</a>
                </li>
                <li>
                  <a href="layouts_menu_top_image.html">Dashboard 6</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="layouts_menu_top_image.html">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Menu Styles</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="layouts_menu_side_full.html">Side Menu Light</a>
                </li>
                <li>
                  <a href="layouts_menu_side_full_dark.html">Side Menu Dark</a>
                </li>
                <li>
                  <a href="layouts_menu_side_transparent.html">Side Menu Transparent <strong class="badge badge-danger">New</strong></a>
                </li>
                <li>
                  <a href="apps_pipeline.html">Side &amp; Top Dark</a>
                </li>
                <li>
                  <a href="apps_projects.html">Side &amp; Top</a>
                </li>
                <li>
                  <a href="layouts_menu_side_mini.html">Mini Side Menu</a>
                </li>
                <li>
                  <a href="layouts_menu_side_mini_dark.html">Mini Menu Dark</a>
                </li>
                <li>
                  <a href="layouts_menu_side_compact.html">Compact Side Menu</a>
                </li>
                <li>
                  <a href="layouts_menu_side_compact_dark.html">Compact Menu Dark</a>
                </li>
                <li>
                  <a href="layouts_menu_right.html">Right Menu</a>
                </li>
                <li>
                  <a href="layouts_menu_top.html">Top Menu Light</a>
                </li>
                <li>
                  <a href="layouts_menu_top_dark.html">Top Menu Dark</a>
                </li>
                <li>
                  <a href="layouts_menu_top_image.html">Top Menu Image <strong class="badge badge-danger">New</strong></a>
                </li>
                <li>
                  <a href="layouts_menu_sub_style_flyout.html">Sub Menu Flyout</a>
                </li>
                <li>
                  <a href="layouts_menu_sub_style_flyout_dark.html">Sub Flyout Dark</a>
                </li>
                <li>
                  <a href="layouts_menu_sub_style_flyout_bright.html">Sub Flyout Bright</a>
                </li>
                <li>
                  <a href="layouts_menu_side_compact_click.html">Menu Inside Click</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="apps_bank.html">
                <div class="icon-w">
                  <div class="os-icon os-icon-package"></div>
                </div>
                <span>Applications</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="apps_email.html">Email Application</a>
                </li>
                <li>
                  <a href="apps_support_dashboard.html">Support Dashboard</a>
                </li>
                <li>
                  <a href="apps_support_index.html">Tickets Index</a>
                </li>
                <li>
                  <a href="apps_crypto.html">Crypto Dashboard <strong class="badge badge-danger">New</strong></a>
                </li>
                <li>
                  <a href="apps_projects.html">Projects List</a>
                </li>
                <li>
                  <a href="apps_bank.html">Banking <strong class="badge badge-danger">New</strong></a>
                </li>
                <li>
                  <a href="apps_full_chat.html">Chat Application</a>
                </li>
                <li>
                  <a href="apps_todo.html">To Do Application <strong class="badge badge-danger">New</strong></a>
                </li>
                <li>
                  <a href="misc_chat.html">Popup Chat</a>
                </li>
                <li>
                  <a href="apps_pipeline.html">CRM Pipeline</a>
                </li>
                <li>
                  <a href="rentals_index_grid.html">Property Listing <strong class="badge badge-danger">New</strong></a>
                </li>
                <li>
                  <a href="misc_calendar.html">Calendar</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-file-text"></div>
                </div>
                <span>Pages</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="misc_invoice.html">Invoice</a>
                </li>
                <li>
                  <a href="ecommerce_order_info.html">Order Info <strong class="badge badge-danger">New</strong></a>
                </li>
                <li>
                  <a href="rentals_index_grid.html">Property Listing <strong class="badge badge-danger">New</strong></a>
                </li>
                <li>
                  <a href="misc_charts.html">Charts</a>
                </li>
                <li>
                  <a href="auth_login.html">Login</a>
                </li>
                <li>
                  <a href="auth_register.html">Register</a>
                </li>
                <li>
                  <a href="auth_lock.html">Lock Screen</a>
                </li>
                <li>
                  <a href="misc_pricing_plans.html">Pricing Plans</a>
                </li>
                <li>
                  <a href="misc_error_404.html">Error 404</a>
                </li>
                <li>
                  <a href="misc_error_500.html">Error 500</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-life-buoy"></div>
                </div>
                <span>UI Kit</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="uikit_modals.html">Modals <strong class="badge badge-danger">New</strong></a>
                </li>
                <li>
                  <a href="uikit_alerts.html">Alerts</a>
                </li>
                <li>
                  <a href="uikit_grid.html">Grid</a>
                </li>
                <li>
                  <a href="uikit_progress.html">Progress</a>
                </li>
                <li>
                  <a href="uikit_popovers.html">Popover</a>
                </li>
                <li>
                  <a href="uikit_tooltips.html">Tooltips</a>
                </li>
                <li>
                  <a href="uikit_buttons.html">Buttons</a>
                </li>
                <li>
                  <a href="uikit_dropdowns.html">Dropdowns</a>
                </li>
                <li>
                  <a href="uikit_typography.html">Typography</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-mail"></div>
                </div>
                <span>Emails</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="emails_welcome.html">Welcome Email</a>
                </li>
                <li>
                  <a href="emails_order.html">Order Confirmation</a>
                </li>
                <li>
                  <a href="emails_payment_due.html">Payment Due</a>
                </li>
                <li>
                  <a href="emails_forgot.html">Forgot Password</a>
                </li>
                <li>
                  <a href="emails_activate.html">Activate Account</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-users"></div>
                </div>
                <span>Users</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="users_profile_big.html">Big Profile</a>
                </li>
                <li>
                  <a href="users_profile_small.html">Compact Profile</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-edit-32"></div>
                </div>
                <span>Forms</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="forms_regular.html">Regular Forms</a>
                </li>
                <li>
                  <a href="forms_validation.html">Form Validation</a>
                </li>
                <li>
                  <a href="forms_wizard.html">Form Wizard</a>
                </li>
                <li>
                  <a href="forms_uploads.html">File Uploads</a>
                </li>
                <li>
                  <a href="forms_wisiwig.html">Wisiwig Editor</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-grid"></div>
                </div>
                <span>Tables</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="tables_regular.html">Regular Tables</a>
                </li>
                <li>
                  <a href="tables_datatables.html">Data Tables</a>
                </li>
                <li>
                  <a href="tables_editable.html">Editable Tables</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-zap"></div>
                </div>
                <span>Icons</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="icon_fonts_simple_line_icons.html">Simple Line Icons</a>
                </li>
                <li>
                  <a href="icon_fonts_feather.html">Feather Icons</a>
                </li>
                <li>
                  <a href="icon_fonts_themefy.html">Themefy Icons</a>
                </li>
                <li>
                  <a href="icon_fonts_picons_thin.html">Picons Thin</a>
                </li>
                <li>
                  <a href="icon_fonts_dripicons.html">Dripicons</a>
                </li>
                <li>
                  <a href="icon_fonts_eightyshades.html">Eightyshades</a>
                </li>
                <li>
                  <a href="icon_fonts_entypo.html">Entypo</a>
                </li>
                <li>
                  <a href="icon_fonts_font_awesome.html">Font Awesome</a>
                </li>
                <li>
                  <a href="icon_fonts_foundation_icon_font.html">Foundation Icon Font</a>
                </li>
                <li>
                  <a href="icon_fonts_metrize_icons.html">Metrize Icons</a>
                </li>
                <li>
                  <a href="icon_fonts_picons_social.html">Picons Social</a>
                </li>
                <li>
                  <a href="icon_fonts_batch_icons.html">Batch Icons</a>
                </li>
                <li>
                  <a href="icon_fonts_dashicons.html">Dashicons</a>
                </li>
                <li>
                  <a href="icon_fonts_typicons.html">Typicons</a>
                </li>
                <li>
                  <a href="icon_fonts_weather_icons.html">Weather Icons</a>
                </li>
                <li>
                  <a href="icon_fonts_light_admin.html">Light Admin</a>
                </li>
              </ul>
            </li>
          </ul>
          <!--------------------
            END - Mobile Menu List
            -------------------->
          <div class="mobile-menu-magic">
            <h4>
              Light Admin
            </h4>
            <p>
              Clean Bootstrap 4 Template
            </p>
            <div class="btn-w">
              <a class="btn btn-white btn-rounded" href="https://themeforest.net/item/light-admin-clean-bootstrap-dashboard-html-template/19760124?ref=Osetin" target="_blank">Purchase Now</a>
            </div>
          </div>
        </div>
      </div>

      <div class="content-w">
        <div class="content-i">
          <div class="content-box">
            <div class="element-wrapper compact pt-4">
              <h3 class="element-header">
                MONTHLY <span style="font-weight: bold;">OVERVIEW</span>
              </h3>
              <div class="element-box-tp">

                <div class="d-flex justify-content-center" id="dashBoardLoader">
                  <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-4 col-xxxl-4">
                    <a class="element-box el-tablo" href="#">
                      <div class="label">
                        Worked Hours Total
                      </div>
                      <div class="value" id="totalWorkedHours">
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-4 col-xxxl-4">
                    <a class="element-box el-tablo" href="#">
                      <div class="label">
                        Target Sales
                      </div>
                      <div class="value" id="targetSales">
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-4 col-xxxl-4">
                    <a class="element-box el-tablo" href="#">
                      <div class="label">
                        Sales Total
                      </div>
                      <div class="value" id="salesTotal">
                      </div>
                    </a>
                  </div>

                </div>
                <div class="row">
                  <div class="col-sm-4 col-xxxl-4">
                    <a class="element-box el-tablo" href="#">
                      <div class="label">
                        Profit Surplus
                      </div>
                      <div class="value" id="profit">
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-4 col-xxxl-4">
                    <a class="element-box el-tablo" href="#">
                      <div class="label">
                        Loss
                      </div>
                      <div class="value" id="loss">
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-4 col-xxxl-4">
                    <a class="element-box el-tablo" href="#">
                      <div class="label">
                        Productivity Rate
                      </div>
                      <div class="value" id="productivityRate">
                      </div>
                    </a>
                  </div>

                </div>
                <div class="row">
                  <div class="col-sm-3 col-xxxl-3">
                    <div class="element-wrapper">
                      <h3 class="element-header">
                        <span style="font-weight: bold;"> Projects </span>
                      </h3>
                      <div class="element-box less-padding">
                        <div class="d-flex justify-content-center" id="projectsLoader">
                          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>
                        <div class="el-chart-w">
                          <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                            </div>
                          </div>
                          <canvas height="244" id="donutChart123" width="244" class="chartjs-render-monitor" style="display: block; width: 244px; height: 244px;"></canvas>
                          <div class="inside-donut-chart-label" id="noOfProjects">
                          </div>
                        </div>
                        <div class="el-legend condensed">
                          <div class="row" id="projectsData">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-9 col-xxxl-9">
                    <div class="element-wrapper">
                      <h3 class="element-header" style="visibility: hidden;">
                        Project <span style="font-weight: bold;"> Forecast </span>
                      </h3>
                      <div class="element-box">
                        <div class="os-tabs-w">
                          <div class="os-tabs-controls">
                            <ul class="nav nav-tabs smaller">
                              <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab_overview">Overview</a>
                              </li>
                            </ul>

                          </div>
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_overview">
                              <div class="d-flex justify-content-center" id="forecastLoader">
                                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                  <span class="sr-only">Loading...</span>
                                </div>
                              </div>
                              <div class="el-tablo bigger">
                                <div class="row">

                                  <div class="col-md-3">
                                    <div class="label ">
                                      <h5 class="element-header">
                                        Project <span style="font-weight: bold;"> Forecast </span>
                                      </h5>
                                    </div>
                                    <div class="value" id="projectForecast">
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="label ">
                                      <h5 class="element-header">
                                        Job <span style="font-weight: bold;"> Hours </span>
                                      </h5>
                                    </div>
                                    <div class="value" id="jobHours">
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="label ">
                                      <h5 class="element-header">
                                        fully <span style="font-weight: bold;"> Occupied EMployees </span>
                                      </h5>
                                    </div>
                                    <div class="value" id="occupiedEmployees">
                                    </div>
                                  </div>

                                </div>
                              </div>
                              <div class="el-chart-w">
                                <div class="chartjs-size-monitor">
                                  <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                  </div>
                                  <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                  </div>
                                </div>
                                <canvas height="200" id="lineChart" width="803" class="chartjs-render-monitor" style="display: block; width: 803px; height: 200px;"></canvas>
                              </div>
                            </div>
                            <div class="tab-pane" id="tab_sales"></div>
                            <div class="tab-pane" id="tab_conversion"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <!-- <div class="col-sm-7 col-xxl-6">
                      <div class="element-wrapper">
                        <div class="element-actions">
                          <form class="form-inline justify-content-sm-end">
                            <select class="form-control form-control-sm rounded">
                              <option value="Pending">
                                Today
                              </option>
                              <option value="Active">
                                Last Week
                              </option>
                              <option value="Cancelled">
                                Last 30 Days
                              </option>
                            </select>
                          </form>
                        </div>
                        <h6 class="element-header">
                          Inventory Stats
                        </h6>
                        <div class="element-box">
                          <div class="os-progress-bar primary">
                            <div class="bar-labels">
                              <div class="bar-label-left">
                                <span class="bigger">Eyeglasses</span>
                              </div>
                              <div class="bar-label-right">
                                <span class="info">25 items / 10 remaining</span>
                              </div>
                            </div>
                            <div class="bar-level-1" style="width: 100%">
                              <div class="bar-level-2" style="width: 70%">
                                <div class="bar-level-3" style="width: 40%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="os-progress-bar primary">
                            <div class="bar-labels">
                              <div class="bar-label-left">
                                <span class="bigger">Outwear</span>
                              </div>
                              <div class="bar-label-right">
                                <span class="info">18 items / 7 remaining</span>
                              </div>
                            </div>
                            <div class="bar-level-1" style="width: 100%">
                              <div class="bar-level-2" style="width: 40%">
                                <div class="bar-level-3" style="width: 20%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="os-progress-bar primary">
                            <div class="bar-labels">
                              <div class="bar-label-left">
                                <span class="bigger">Shoes</span>
                              </div>
                              <div class="bar-label-right">
                                <span class="info">15 items / 12 remaining</span>
                              </div>
                            </div>
                            <div class="bar-level-1" style="width: 100%">
                              <div class="bar-level-2" style="width: 60%">
                                <div class="bar-level-3" style="width: 30%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="os-progress-bar primary">
                            <div class="bar-labels">
                              <div class="bar-label-left">
                                <span class="bigger">Jeans</span>
                              </div>
                              <div class="bar-label-right">
                                <span class="info">12 items / 4 remaining</span>
                              </div>
                            </div>
                            <div class="bar-level-1" style="width: 100%">
                              <div class="bar-level-2" style="width: 30%">
                                <div class="bar-level-3" style="width: 10%"></div>
                              </div>
                            </div>
                          </div>
                          <div class="mt-4 border-top pt-3">
                            <div class="element-actions  d-sm-block">
                              <form class="form-inline justify-content-sm-end">
                                <select class="form-control form-control-sm form-control-faded">
                                  <option selected="true">
                                    Last 30 days
                                  </option>
                                  <option>
                                    This Week
                                  </option>
                                  <option>
                                    This Month
                                  </option>
                                  <option>
                                    Today
                                  </option>
                                </select>
                              </form>
                            </div>
                            <h6 class="element-box-header">
                              Inventory History
                            </h6>
                            <div class="el-chart-w"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                              <canvas data-chart-data="13,28,19,24,43,49,40,35,42,46,38,32,45" height="84" id="liteLineChartV3" width="508" style="display: block; width: 508px; height: 84px;" class="chartjs-render-monitor"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--END - Questions per product-->
                </div>
                <div class="col-sm-7 col-xxl-6">
                  <div class="element-wrapper">
                    <h3 class="element-header">
                      <span style="font-weight: bold;"> Employees </span>
                    </h3>
                    <div class="element-box">
                      <div class="table-responsive">
                        <div class="d-flex justify-content-center" id="employeeLoader">
                          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>
                        <table class="table table-lightborder">
                          <thead>
                            <tr>
                              <th>
                                Employee Name
                              </th>
                              <th>
                                Worked hours
                              </th>
                              <th>
                                Productivity rate
                              </th>
                            </tr>
                          </thead>
                          <tbody id="employeeTable">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row pt-4">
                <div class="col-sm-12">
                  <div class="element-wrapper">
                    <h3 class="element-header">
                      By <span style="font-weight: bold;">Client</span>
                    </h3>
                    <div class="element-box-tp">
                      <div class="table-responsive" style="width: 100%;">
                        <div class="d-flex justify-content-center" id="clientLoader">
                          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>
                        <table class="table table-padded">
                          <thead>
                            <tr>
                              <th></th>
                              <th>
                                Client
                              </th>
                              <th>
                                Project amount
                              </th>
                              <th class="text-center">
                                Profit share
                              </th>
                              <th>
                                Time share
                              </th>
                              <th>
                                <span style="font-weight: bold;"> ×90€</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody id="clientTable">
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="display-type"></div>
  </div>
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/popper.js/dist/umd/popper.min.js"></script>
  <script src="bower_components/moment/moment.js"></script>
  <script src="bower_components/chart.js/dist/Chart.min.js"></script>
  <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
  <script src="bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
  <script src="bower_components/ckeditor/ckeditor.js"></script>
  <script src="bower_components/bootstrap-validator/dist/validator.min.js"></script>
  <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
  <script src="bower_components/dropzone/dist/dropzone.js"></script>
  <script src="bower_components/editable-table/mindmup-editabletable.js"></script>
  <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="bower_components/tether/dist/js/tether.min.js"></script>
  <script src="bower_components/slick-carousel/slick/slick.min.js"></script>
  <script src="bower_components/bootstrap/js/dist/util.js"></script>
  <script src="bower_components/bootstrap/js/dist/alert.js"></script>
  <script src="bower_components/bootstrap/js/dist/button.js"></script>
  <script src="bower_components/bootstrap/js/dist/carousel.js"></script>
  <script src="bower_components/bootstrap/js/dist/collapse.js"></script>
  <script src="bower_components/bootstrap/js/dist/dropdown.js"></script>
  <script src="bower_components/bootstrap/js/dist/modal.js"></script>
  <script src="bower_components/bootstrap/js/dist/tab.js"></script>
  <script src="bower_components/bootstrap/js/dist/tooltip.js"></script>
  <script src="bower_components/bootstrap/js/dist/popover.js"></script>
  <script src="js/demo_customizer.js?version=4.5.0"></script>
  <script src="js/main.js?version=4.5.0"></script>
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-XXXXXXXX-9', 'auto');
    ga('send', 'pageview');
  </script>

  <script src="js/getDashboard.js"></script>
</body>

</html>