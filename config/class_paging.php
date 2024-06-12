<?php

// class paging untuk halaman administrator
class Paging
{
    // Fungsi untuk mencek halaman dan posisi data
    public function cariPosisi($batas)
    {
        if (empty($_GET['halaman'])) {
            $posisi = 0;
            $_GET['halaman'] = 1;
        } else {
            $posisi = ($_GET['halaman'] - 1) * $batas;
        }

        return $posisi;
    }

    // Fungsi untuk menghitung total halaman
    public function jumlahHalaman($jmldata, $batas)
    {
        $jmlhalaman = ceil($jmldata / $batas);

        return $jmlhalaman;
    }

    // Fungsi untuk link halaman 1,2,3 (untuk admin)
    public function navHalaman($halaman_aktif, $jmlhalaman)
    {
        $link_halaman = '';

        // Preventing XSS by properly escaping the module parameter
        $module = htmlspecialchars($_GET['modul']);

        // Link ke halaman pertama (first) dan sebelumnya (prev)
        if ($halaman_aktif > 1) {
            $prev = $halaman_aktif - 1;
            $link_halaman .= "<li><a href='".$_SERVER['PHP_SELF']."?modul=$module&halaman=1'>&lt;&lt; First</a></li>
                              <li><a href='".$_SERVER['PHP_SELF']."?modul=$module&halaman=$prev'>&lt; Prev</a></li>";
        } else {
            $link_halaman .= '<li>&lt;&lt; First</li><li>&lt; Prev</li>';
        }

        // Link halaman 1,2,3, ...
        $angka = ($halaman_aktif > 3 ? ' ... ' : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<li><a href='".$_SERVER['PHP_SELF']."?modul=$module&halaman=$i'>$i</a></li>";
        }
        $angka .= "<li><a href='#'><b>$halaman_aktif</b></a></li>";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<li><a href='".$_SERVER['PHP_SELF']."?modul=$module&halaman=$i'>$i</a></li>";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? "<li><a href='#'>...</a></li><li><a href='".$_SERVER['PHP_SELF']."?modul=$module&halaman=$jmlhalaman'>$jmlhalaman</a></li>" : '');

        $link_halaman .= $angka;

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= "<li><a href='".$_SERVER['PHP_SELF']."?modul=$module&halaman=$next'>Next &gt;</a></li>
                              <li><a href='".$_SERVER['PHP_SELF']."?modul=$module&halaman=$jmlhalaman'>Last &gt;&gt;</a></li>";
        } else {
            $link_halaman .= '<li>Next &gt;</li><li>Last &gt;&gt;</li>';
        }

        return $link_halaman;
    }
}

// class paging untuk halaman administrator (pencarian berita)
class Paging9
{
    // Fungsi untuk mencek halaman dan posisi data
    public function cariPosisi($batas)
    {
        if (empty($_GET['halaman'])) {
            $posisi = 0;
            $_GET['halaman'] = 1;
        } else {
            $posisi = ($_GET['halaman'] - 1) * $batas;
        }

        return $posisi;
    }

    // Fungsi untuk menghitung total halaman
    public function jumlahHalaman($jmldata, $batas)
    {
        $jmlhalaman = ceil($jmldata / $batas);

        return $jmlhalaman;
    }

    // Fungsi untuk link halaman 1,2,3 (untuk admin)
    public function navHalaman($halaman_aktif, $jmlhalaman)
    {
        $link_halaman = '';

        // Preventing XSS by properly escaping the module and kata parameters
        $module = htmlspecialchars($_GET['module']);
        $kata = htmlspecialchars($_GET['kata']);

        // Link ke halaman pertama (first) dan sebelumnya (prev)
        if ($halaman_aktif > 1) {
            $prev = $halaman_aktif - 1;
            $link_halaman .= "<a href='".$_SERVER['PHP_SELF']."?module=$module&halaman=1&kata=$kata'>&lt;&lt; First</a> | 
                              <a href='".$_SERVER['PHP_SELF']."?module=$module&halaman=$prev&kata=$kata'>&lt; Prev</a> | ";
        } else {
            $link_halaman .= '&lt;&lt; First | &lt; Prev | ';
        }

        // Link halaman 1,2,3, ...
        $angka = ($halaman_aktif > 3 ? ' ... ' : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href='".$_SERVER['PHP_SELF']."?module=$module&halaman=$i&kata=$kata'>$i</a> | ";
        }
        $angka .= " <b>$halaman_aktif</b> | ";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href='".$_SERVER['PHP_SELF']."?module=$module&halaman=$i&kata=$kata'>$i</a> | ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? " ... | <a href='".$_SERVER['PHP_SELF']."?module=$module&halaman=$jmlhalaman&kata=$kata'>$jmlhalaman</a> | " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href='".$_SERVER['PHP_SELF']."?module=$module&halaman=$next&kata=$kata'>Next &gt;</a> | 
                              <a href='".$_SERVER['PHP_SELF']."?module=$module&halaman=$jmlhalaman&kata=$kata'>Last &gt;&gt;</a> ";
        } else {
            $link_halaman .= ' Next &gt; | Last &gt;&gt;';
        }

        return $link_halaman;
    }
}
// class paging untuk halaman berita (menampilkan semua berita)
class Paging2
{
    // Fungsi untuk mencek halaman dan posisi data
    public function cariPosisi($batas)
    {
        if (empty($_GET['halberita'])) {
            $posisi = 0;
            $_GET['halberita'] = 1;
        } else {
            $posisi = ($_GET['halberita'] - 1) * $batas;
        }

        return $posisi;
    }

    // Fungsi untuk menghitung total halaman
    public function jumlahHalaman($jmldata, $batas)
    {
        $jmlhalaman = ceil($jmldata / $batas);

        return $jmlhalaman;
    }

    // Fungsi untuk link halaman 1,2,3
    public function navHalaman($halaman_aktif, $jmlhalaman)
    {
        $link_halaman = '';

        // Link ke halaman pertama (first) dan sebelumnya (prev)
        if ($halaman_aktif > 1) {
            $prev = $halaman_aktif - 1;
            $link_halaman .= "<a href='".$_SERVER['PHP_SELF']."?halberita=1'>&lt;&lt; First</a> | 
                              <a href='".$_SERVER['PHP_SELF']."?halberita=$prev'>&lt; Prev</a> | ";
        } else {
            $link_halaman .= '&lt;&lt; First | &lt; Prev | ';
        }

        // Link halaman 1,2,3, ...
        $angka = ($halaman_aktif > 3 ? ' ... ' : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href='".$_SERVER['PHP_SELF']."?halberita=$i'>$i</a> | ";
        }
        $angka .= " <b>$halaman_aktif</b> | ";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href='".$_SERVER['PHP_SELF']."?halberita=$i'>$i</a> | ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? " ... | <a href='".$_SERVER['PHP_SELF']."?halberita=$jmlhalaman'>$jmlhalaman</a> | " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href='".$_SERVER['PHP_SELF']."?halberita=$next'>Next &gt;</a> | 
                              <a href='".$_SERVER['PHP_SELF']."?halberita=$jmlhalaman'>Last &gt;&gt;</a> ";
        } else {
            $link_halaman .= ' Next &gt; | Last &gt;&gt;';
        }

        return $link_halaman;
    }
}
