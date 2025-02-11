<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, string>
     * @phpstan-var array<string, class-string>
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class, 
        'secureheaders' => SecureHeaders::class,
        'authFilter' => \App\Filters\AuthFilter::class,
        'adminFilter' => \App\Filters\AdminFilter::class,
        'dekanFilter' => \App\Filters\DekanFilter::class,
        'kadepFilter' => \App\Filters\KadepFilter::class,
        'dosenFilter' => \App\Filters\DosenFilter::class,
        'mahasiswaFilter' => \App\Filters\MahasiswaFilter::class,
        'mahasiswaDanAdminFilter' => \App\Filters\MahasiswaDanAdminFilter::class,
        'superAdminFilter' => \App\Filters\SuperAdminFilter::class,
        'adminDepartemenFilter' => \App\Filters\AdminDepartemenFilter::class,
        'adminDanSuperAdminFilter' => \App\Filters\AdminDanSuperAdminFilter::class,
        'adminDepartemenDanKadepFilter' => \App\Filters\AdminDepartemenDanKadepFilter::class,
        'mahasiswaDanAdminDepartemenFilter' => \App\Filters\MahasiswaDanAdminDepartemenFilter::class,
        'adminSuperadminAdminDepartemenDanKadepFilter' => \App\Filters\AdminSuperadminAdminDepartemenDanKadepFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, array<string>>
     * @phpstan-var array<string, list<string>>|array<string, array<string, array<string, string>>>
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf', 
            'csrf' => ['except' => ['/izin-penelitian/cetak','/validasi-instrumen/cetak']],
            'authFilter' => [
                'except' => ['/auth/*','surat/*','izin-observasi-penelitian/detail-izin-observasi/*','seminar/detail-seminar/*', 'ujian-skripsi/detail-ujian/*','izin-penelitian/scan-barcode/*', 'izin-observasi-matakuliah/scan-barcode/*','validasi-instrumen/scan-barcode/*']
            ],
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [];
}
