<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reflection;

class AdminBahanIbadahController extends AdminReflectionController
{
    protected string $type = Reflection::TYPE_BAHAN_IBADAH;

    protected string $routePrefix = 'admin.bahan-ibadah';

    protected string $label = 'Bahan Ibadah';

    protected string $labelPlural = 'Bahan Ibadah';

    protected string $publicDetailRoute = 'client.bahan-ibadah.detail';
}
