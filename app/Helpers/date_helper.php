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

    function format_date_indonesia_old($date = 'now', $format = 'indonesia')
{
    // Jika 'now' dikirim atau tidak ada parameter, gunakan tanggal saat ini
    $carbonDate = ($date === 'now') ? Carbon::now() : Carbon::parse($date);
    
    // Nama bulan dalam bahasa Indonesia
    $bulanIndonesia = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    if ($format === 'indonesia') {
        // Format tanggal default dalam bahasa Indonesia: 'dd Bulan yyyy'
        $bulan = $bulanIndonesia[$carbonDate->month - 1];
        return $carbonDate->day . ' ' . $bulan . ' ' . $carbonDate->year;
    } else {
        // Gunakan format yang diberikan, misalnya 'd-m-Y'
        return $carbonDate->format($format);
    }
}
}