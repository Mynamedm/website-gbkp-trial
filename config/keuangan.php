<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PIN Berita Kategori Keuangan
    |--------------------------------------------------------------------------
    |
    | Berita pada kategori "keuangan" di halaman Kegiatan Gereja dilindungi
    | PIN. Ganti nilai ini lewat environment variable KEUANGAN_PIN.
    |
    */

    'pin' => env('KEUANGAN_PIN', '123456'),

    /*
    |--------------------------------------------------------------------------
    | WhatsApp Admin
    |--------------------------------------------------------------------------
    |
    | Nomor WhatsApp personal admin untuk tautan "Lupa PIN". Gunakan format
    | internasional tanpa tanda plus, spasi, atau tanda hubung.
    |
    */

    'whatsapp' => env('ADMIN_WHATSAPP', '6281234567890'),

    'whatsapp_message' => 'Halo admin, saya lupa PIN berita keuangan GBKP Bandar Lampung. Mohon bantuannya.',

];
