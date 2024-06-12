<div class="navbar" style="margin-top:5px;">
    <div class="navbar-inner">
        <div class="container">

            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="?modul=home">
                <?php
                $tampil = mysqli_query(KONEKSI, 'SELECT * FROM profil');

                while ($r = mysqli_fetch_array($tampil)) {
                    echo "<img src='images/$r[logo]' width='40px' ></a>";
                }
                ?>

                <!-- Everything you want hidden at 940px or less, place within here -->
                <div class="nav-collapse collapse">

                    <ul class="nav" style="margin-top:5px;margin-left:0px;">


                        <li class="divider-vertical"></li>
                        <li><a href="?modul=home"> <i class='ion ion-home'></i>
                                Home</a></li>
                        <li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"><i class='ion ion-android-storage dk'></i>Referensi <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="?modul=pengarang">Pengarang</a></li>
                                <li><a href="?modul=penerbit">Penerbit</a></li>
                                <li><a href="?modul=rak">Rak Buku</a></li>
                                <li><a href="?modul=subjek">Subjek</a></li>
                                <li><a href="?modul=kategori">Kategori</a></li>
                                <li><a href="?modul=klasifikasi">Klasifikasi</a></li>

                            </ul>
                        </li>
                        <li class="divider-vertical"></li>
                        <li><a href="?modul=buku"><i class='ion ion-android-book dk'></i>Buku</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="?modul=anggota"><i class='ion-person-stalker dk'></i>Anggota</a></li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"><i class='ion-loop dk'></i>Sirkulasi <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="?modul=peminjaman">Peminjaman</a></li>
                                <li><a href="?modul=pengembalian">Pengembalian</a></li>
                            </ul>
                        </li>
                        <li class="divider-vertical"></li>


                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"><i class='ion-ios7-bookmarks dk'></i>Jurnal
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="?modul=katjurnal">Kategori Jurnal</a></li>
                                <li><a href="?modul=jurnal">Jurnal</a></li>
                            </ul>
                        </li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"><i class='ion ion-pie-graph dk'></i>Laporan
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="?modul=lappengunjung">Laporan Pengunjung</a></li>
                                <li><a href="?modul=rekapbuku">Rekap Buku</a></li>
                                <li><a href="?modul=rekapanggota">Rekap Anggota</a></li>
                                <li><a href="?modul=lapsirkulasi">Laporan Sirkulasi</a></li>
                            </ul>
                        </li>
                        <li>

                        </li>
                        <li>

                        </li>
                    </ul>
                    <div class="btn-group" style="float:right; margin-top:15px;">
                        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class='ion ion-gear-a dk'></i>
                            Pengaturan
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="?modul=profil">Profil Perpustakaan</a></li>
                            <li><a href="?modul=jadwal">Manajemen Jadwal</a></li>
                            <li><a href="?modul=user">Manajemen User</a></li>
                            <li class="divider"></li>
                            <li><a href="#myModal" role="button" data-toggle="modal">Logout</a></li>

                        </ul>
                    </div>

                </div>

        </div>
    </div>
</div>