        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <a href="../index.php" class="brand-link">
                <span class="brand-text font-weight-light">Volver Al Anuario</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    
                    <div class="info" style="color: white;">
                        <?php echo $_SESSION['nombre']; ?>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Escritorio
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="admin-area.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inicio</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Gestión Admins
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="lista-admin.php" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Ver todos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="crear-admin.php" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                        <p>Agregar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Gestión Miembros
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="lista-miembro.php" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Ver todos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="crear-miembro.php" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                        <p>Agregar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>