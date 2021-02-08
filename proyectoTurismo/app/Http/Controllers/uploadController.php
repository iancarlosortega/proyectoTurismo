<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Imports\ExcelImport;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;
use App\Models\Archivo;
use File;
use DataTables;
use DB;
use PDO;
class uploadController extends Controller
{
    function upload(Request $request)
    {
        $contenido= $request->svg;
        $name = $request->filename;
        $completo ="$name.svg";
        Storage::disk('local')->put("public/graficas/$completo", $contenido);
        return redirect('/admin/graficas2');
        /*
        $file = $request->file;
        $filename = "aux.csv";
        $ruta_temp = url('storage');
        $ruta_temp = $ruta_temp."/".$filename;
        $nombre = gettype($file);
        Storage::disk('local')->put('public/example.txt', $nombre);*/
    }
    
}
