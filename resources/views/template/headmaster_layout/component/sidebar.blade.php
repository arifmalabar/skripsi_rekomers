<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-success">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="https://smkn8malang.sch.id/img/logo.png" alt="AdminLTE Logo" class="brand-image"
            style="width: 30px; height: auto;">
        <span class="brand-text font-weight-bold">REKOMERS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img style="margin-top: 10px;" src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="/profile" class="d-block">Bahrul</a>
                <span class="right badge badge-success">Admin</span>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        @php
        //$curr = request()->route()->getActionName();
        @endphp
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Main</li>

                <li class="nav-item">
                    <a href="/kakomli/dashboard" class="nav-link {{ $nama == 'dashboard' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kakomli/guru" class="nav-link {{ $nama == 'guru' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-pen"></i>
                        <p>Teachers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kakomli/jurusan" class="nav-link {{ $nama == 'jurusan' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-university"></i>
                        <p>Jurusan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kakomli/kelas" class="nav-link {{ $nama == 'kelas' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-walking"></i>
                        <p>Kelas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/teacher/grades" class="nav-link {{ $nama == 'penilaian' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-pen"></i>
                        <p>Nilai</p>
                    </a>
                </li>

                <li class="nav-header">Mapel</li>
                <li class="nav-item">
                    <a href="/kakomli/mata_pelajaran" class="nav-link {{ $nama == 'course' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-users"></i>
                        <p>Mapel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kakomli/clustering" class="nav-link {{ $nama == 'clustering' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-users"></i>
                        <p>Clustering Mapel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/produk" class="nav-link {{ $nama == 'manufacturing' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-users"></i>
                        <p>Clustering Report</p>
                    </a>
                </li>
                <!--<li class="nav-header">Purchase</li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $nama == 'purchase' ? 'active' : '' }}">
                        <i class="fas fa-cart-plus"></i>
                        <p>
                            Purchase
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/purchase/rfq" class="nav-link {{ $nama == 'rfq' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>RFQ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PO</p>
                            </a>
                        </li>
                    </ul>
                </li>-->
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>