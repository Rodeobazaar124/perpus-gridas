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

        // Link ke halaman pertama (first) dan sebelumnya (prev)
        if ($halaman_aktif > 1) {
            $prev = $halaman_aktif - 1;
            $link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=1><< First</a> | 
                    <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$prev>< Prev</a> | ";
        } else {
            $link_halaman .= '<< First | < Prev | ';
        }

        // Link halaman 1,2,3, ...
        $angka = ($halaman_aktif > 3 ? ' ... ' : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> | ";
        }
        $angka .= " <b>$halaman_aktif</b> | ";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> | ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? " ... | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>$jmlhalaman</a> | " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next>Next ></a> | 
                     <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>Last >></a> ";
        } else {
            $link_halaman .= ' Next > | Last >>';
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

        // Link ke halaman pertama (first) dan sebelumnya (prev)
        if ($halaman_aktif > 1) {
            $prev = $halaman_aktif - 1;
            $link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=1&kata=$_GET[kata]><< First</a> | 
                    <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$prev&kata=$_GET[kata]>< Prev</a> | ";
        } else {
            $link_halaman .= '<< First | < Prev | ';
        }

        // Link halaman 1,2,3, ...
        $angka = ($halaman_aktif > 3 ? ' ... ' : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i&kata=$_GET[kata]>$i</a> | ";
        }
        $angka .= " <b>$halaman_aktif</b> | ";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i&kata=$_GET[kata]>$i</a> | ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? " ... | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman&kata=$_GET[kata]>$jmlhalaman</a> | " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next&kata=$_GET[kata]>Next ></a> | 
                     <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman&kata=$_GET[kata]>Last >></a> ";
        } else {
            $link_halaman .= ' Next > | Last >>';
        }

        return $link_halaman;
    }
}

// class paging untuk halaman jurnal (menampilkan semua berita)
class Paging2
{
    // Fungsi untuk mencek halaman dan posisi data
    public function cariPosisi($batas)
    {
        if (empty($_GET['halkategori'])) {
            $posisi = 0;
            $_GET['halbuku'] = 1;
        } else {
            $posisi = ($_GET['halbuku'] - 1) * $batas;
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
            $link_halaman .= "<a href=halbuku-1.html class='nextprev'><< First</a>
<a href=halbuku-$prev.html class='nextprev'>< Prev</a>";
        } else {
            $link_halaman .= "<span class='nextprev'><< First</span><span class='nextprev'>< Prev </span> ";
        }

        // Link halaman 1,2,3, …
        $angka = ($halaman_aktif > 3 ? "<span class='nextprev'>…</span>" : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href=halbuku-$i.html>$i</a>  ";
        }
        $angka .= " <span class='current'><b>$halaman_aktif</b></span>";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href=halbuku-$i.html>$i</a>  ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? "<span class='nextprev'>…</span><a href=halbuku-$jmlhalaman.html>$jmlhalaman</a> " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href=halbuku-$next.html class='nextprev'>Next ></a>
<a href=halbuku-$jmlhalaman.html class='nextprev'>Last >></a> ";
        } else {
            $link_halaman .= " <span class='nextprev'>Next ></span> <span class='nextprev'> Last >></span>";
        }

        return $link_halaman;
    }
}

// class paging untuk halaman jurnal (menampilkan semua berita)
class Paging4
{
    // Fungsi untuk mencek halaman dan posisi data
    public function cariPosisi($batas)
    {
        if (empty($_GET['halsubjek'])) {
            $posisi = 0;
            $_GET['halsubjek'] = 1;
        } else {
            $posisi = ($_GET['halsubjek'] - 1) * $batas;
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
            $link_halaman .= "<a href=halsubjek-1.html class='nextprev'><< First</a>
<a href=halsubjek-$prev.html class='nextprev'>< Prev</a>";
        } else {
            $link_halaman .= "<span class='nextprev'><< First</span><span class='nextprev'>< Prev </span> ";
        }

        // Link halaman 1,2,3, …
        $angka = ($halaman_aktif > 3 ? "<span class='nextprev'>…</span>" : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href=halsubjek-$i.html>$i</a>  ";
        }
        $angka .= " <span class='current'><b>$halaman_aktif</b></span>";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href=halsubjek-$i.html>$i</a>  ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? "<span class='nextprev'>…</span><a href=halsubjek-$jmlhalaman.html>$jmlhalaman</a> " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href=halsubjek-$next.html class='nextprev'>Next ></a>
<a href=halsubjek-$jmlhalaman.html class='nextprev'>Last >></a> ";
        } else {
            $link_halaman .= " <span class='nextprev'>Next ></span> <span class='nextprev'> Last >></span>";
        }

        return $link_halaman;
    }
}

// class paging untuk halaman jurnal (menampilkan semua berita)
class Paging3
{
    // Fungsi untuk mencek halaman dan posisi data
    public function cariPosisi($batas)
    {
        if (empty($_GET['halkategori'])) {
            $posisi = 0;
            $_GET['halkategori'] = 1;
        } else {
            $posisi = ($_GET['halkategori'] - 1) * $batas;
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
            $link_halaman .= "<a href=halkategori-1.html class='nextprev'><< First</a>
<a href=halkategori-$prev.html class='nextprev'>< Prev</a>";
        } else {
            $link_halaman .= "<span class='nextprev'><< First</span><span class='nextprev'>< Prev </span> ";
        }

        // Link halaman 1,2,3, …
        $angka = ($halaman_aktif > 3 ? "<span class='nextprev'>…</span>" : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href=halkategori-$i.html>$i</a>  ";
        }
        $angka .= " <span class='current'><b>$halaman_aktif</b></span>";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href=halkategori-$i.html>$i</a>  ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? "<span class='nextprev'>…</span><a href=halkategori-$jmlhalaman.html>$jmlhalaman</a> " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href=halkategori-$next.html class='nextprev'>Next ></a>
<a href=halkategori-$jmlhalaman.html class='nextprev'>Last >></a> ";
        } else {
            $link_halaman .= " <span class='nextprev'>Next ></span> <span class='nextprev'> Last >></span>";
        }

        return $link_halaman;
    }
}

// class paging untuk halaman download (menampilkan semua download)
class Paging5
{
    // Fungsi untuk mencek halaman dan posisi data
    public function cariPosisi($batas)
    {
        if (empty($_GET['haldownload'])) {
            $posisi = 0;
            $_GET['haldownload'] = 1;
        } else {
            $posisi = ($_GET['haldownload'] - 1) * $batas;
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
            $link_halaman .= "<a href=haldownload-1.html><< First</a> | 
                    <a href=haldownload-$prev.html>< Prev</a> | ";
        } else {
            $link_halaman .= '<< First | < Prev | ';
        }

        // Link halaman 1,2,3, ...
        $angka = ($halaman_aktif > 3 ? ' ... ' : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href=haldownload-$i.html>$i</a> | ";
        }
        $angka .= " <b>$halaman_aktif</b> | ";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href=haldownload-$i.html>$i</a> | ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? " ... | <a href=haldownload-$jmlhalaman.html>$jmlhalaman</a> | " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href=haldownload-$next.html>Next ></a> | 
                     <a href=haldownload-$jmlhalaman.html>Last >></a> ";
        } else {
            $link_halaman .= ' Next > | Last >>';
        }

        return $link_halaman;
    }
}

// class paging untuk halaman galeri foto
class Paging6
{
    public function cariPosisi($batas)
    {
        if (empty($_GET['halgaleri'])) {
            $posisi = 0;
            $_GET['halgaleri'] = 1;
        } else {
            $posisi = ($_GET['halgaleri'] - 1) * $batas;
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
            $link_halaman .= "<a href=halgaleri-$_GET[id]-1.html><< First</a> | 
                    <a href=halgaleri-$_GET[id]-$prev.html>< Prev</a> | ";
        } else {
            $link_halaman .= '<< First | < Prev | ';
        }

        // Link halaman 1,2,3, ...
        $angka = ($halaman_aktif > 3 ? ' ... ' : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href=halgaleri-$_GET[id]-$i.html>$i</a> | ";
        }
        $angka .= " <b>$halaman_aktif</b> | ";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href=halgaleri-$_GET[id]-$i.html>$i</a> | ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? " ... | <a href=halgaleri-$_GET[id]-$jmlhalaman.html>$jmlhalaman</a> | " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href=halgaleri-$_GET[id]-$next.html>Next ></a> | 
                     <a href=halgaleri-$_GET[id]-$jmlhalaman.html>Last >></a> ";
        } else {
            $link_halaman .= ' Next > | Last >>';
        }

        return $link_halaman;
    }
}

// class paging untuk halaman komentar
class Paging7
{
    public function cariPosisi($batas)
    {
        if (empty($_GET['halkomentar'])) {
            $posisi = 0;
            $_GET['halkomentar'] = 1;
        } else {
            $posisi = ($_GET['halkomentar'] - 1) * $batas;
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
            $link_halaman .= "<a href=halkomentar-$_GET[id]-1.html><< First</a> | 
                    <a href=halkomentar-$_GET[id]-$prev.html>< Prev</a> | ";
        } else {
            $link_halaman .= '<< First | < Prev | ';
        }

        // Link halaman 1,2,3, ...
        $angka = ($halaman_aktif > 3 ? ' ... ' : ' ');
        for ($i = $halaman_aktif - 2; $i < $halaman_aktif; $i++) {
            if ($i < 1) {
                continue;
            }
            $angka .= "<a href=halkomentar-$_GET[id]-$i.html>$i</a> | ";
        }
        $angka .= " <b>$halaman_aktif</b> | ";

        for ($i = $halaman_aktif + 1; $i < ($halaman_aktif + 3); $i++) {
            if ($i > $jmlhalaman) {
                break;
            }
            $angka .= "<a href=halkomentar-$_GET[id]-$i.html>$i</a> | ";
        }
        $angka .= ($halaman_aktif + 2 < $jmlhalaman ? " ... | <a href=halkomentar-$_GET[id]-$jmlhalaman.html>$jmlhalaman</a> | " : ' ');

        $link_halaman .= "$angka";

        // Link ke halaman berikutnya (Next) dan terakhir (Last)
        if ($halaman_aktif < $jmlhalaman) {
            $next = $halaman_aktif + 1;
            $link_halaman .= " <a href=halkomentar-$_GET[id]-$next.html>Next ></a> | 
                     <a href=halkomentar-$_GET[id]-$jmlhalaman.html>Last >></a> ";
        } else {
            $link_halaman .= ' Next > | Last >>';
        }

        return $link_halaman;
    }
}
