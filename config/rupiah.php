<?php

function rupiah($angka)
{
    $rupiah = '';
    $rp = strlen($angka);
    while ($rp > 3) {
        $rupiah = '.'.substr($angka, -3).$rupiah;
        $s = strlen($angka) - 3;
        $angka = substr($angka, 0, $s);
        $rp = strlen($angka);
    }
    $rupiah = 'Rp.'.$angka.$rupiah.',00-';

    return $rupiah;
}
