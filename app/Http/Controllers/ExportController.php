<?php

namespace App\Http\Controllers;

use App\Models\Ferramenta;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    public function exportar()
    {
        $ferramentas = Ferramenta::all();

        $csv = "ID,Nome,Versão,Status,Path,Criado em\n";

        foreach ($ferramentas as $f) {
            $csv .= "{$f->id},\"{$f->nome}\",\"{$f->versao}\",{$f->status},\"{$f->path}\",{$f->created_at}\n";
        }

        $filename = 'ferramentas_' . now()->format('Ymd_His') . '.csv';

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename=$filename");
    }
}
