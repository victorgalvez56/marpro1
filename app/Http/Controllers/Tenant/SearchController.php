<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;

use App\Models\Tenant\Catalogs\DocumentType;

class SearchController extends Controller
{
    public function index()
    {
        return view('tenant.search.index');
    }

    public function tables()
    {
        $document_types = DocumentType::whereIn('id', ['01', '03', '07', '08'])->get();

        return compact('document_types');
    }
}
