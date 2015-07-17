<div id="wrapper">

    <!-- MENU DE NAVEGACION -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Menu para Dispositivos mobiles. -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">M-invo</a>
        </div>
        <!-- Fin: Menu para Dispositivos mobiles. -->

        <!-- Menu Secundario Superior Derecho -->
        <ul class="nav navbar-right top-nav">
            <!-- Correo -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu message-dropdown">
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        <strong>

                                        </strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-footer">
                        <a href="#">Read All New Messages</a>
                    </li>
                </ul>
            </li>
            <!--Fin: Correo -->
            <!-- Alertas -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu alert-dropdown">
                    <li>
                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">View All</a>
                    </li>
                </ul>
            </li>
            <!-- Fin: Alertas -->
            <!-- Login Usuario -->
            {{ elements.getUsuario() }}

            <!-- Fin: Login Usuario -->
        </ul>
        <!-- Fin: Menu Secundario Superior Derecho -->

        <!-- Menu Lateral Izquierdo - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                     {{ link_to("index", '<i class="fa fa-fw fa-dashboard inline-block"></i> Dashboard')}}
                </li>
                <li>
                    {{ link_to("charts", '<i class="fa fa-fw fa-bar-chart-o"></i> Charts')}}
                </li>
                <li>
                    {{ link_to("tables", '<i class="fa fa-fw fa-table"></i> Tables')}}
                </li>
                <li>
                    {{ link_to("products", '<i class="fa fa-fw fa-edit"></i> Formularios')}}
                </li>
                <li>
                    {{ link_to("companies", '<i class="fa fa-fw fa-desktop"></i> Companies')}}
                </li>
                <li>
                    {{ link_to("producttypes", '<i class="fa fa-fw fa-wrench"></i> Bootstrap Grid')}}

                </li>
                <li>

                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Calendario <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            {{ link_to("calendario", '<i class="fa fa-fw fa-wrench"></i> Ver Eventos')}}

                        </li>
                        <li>
                            {{ link_to("producttypes", '<i class="fa fa-fw fa-wrench"></i> Agregar Evento')}}

                        </li>
                    </ul>
                </li>
                <li>
                    <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                </li>
                <li>
                    <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <!-- Fin: MENU DE NAVEGACION -->



    <!-- INICIO DEL CONTENIDO -->
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- HEADER del DIV -->
            <div class="row">

                    {{ content() }}

            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- Fin: INICIO DEL CONTENIDO /#page-wrapper -->

</div>
<!-- /#wrapper -->