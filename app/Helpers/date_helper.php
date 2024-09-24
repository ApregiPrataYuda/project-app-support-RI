<?php

use Carbon\Carbon;

if (!function_exists('format_date_indonesia')) {
    /**
     * Format tanggal dalam bahasa Indonesia.
     *
     * @param  string  $date
     * @return string
     */
    function format_date_indonesia($date)
    {
        $carbonDate = Carbon::parse($date);
        $bulanIndonesia = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $bulan = $bulanIndonesia[$carbonDate->month - 1];
        return $carbonDate->day . ' ' . $bulan . ' ' . $carbonDate->year . ' - ' .
       $carbonDate->format('H:i:s');;
    }
}