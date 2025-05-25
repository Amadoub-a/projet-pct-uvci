<?php

namespace App\Services;

use Spatie\Browsershot\Browsershot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class PdfService
{
    public function generatePdfFromHtml(string $html)
    {
        // Créer un nom de fichier unique basé sur la date et un identifiant unique
        $fileName = 'document.pdf';

        // Définir le chemin où le fichier sera sauvegardé
        $pdfPath = storage_path("app/public/{$fileName}");

        Browsershot::html($html)
            ->setOption('no-sandbox', true)
            ->setOption('pageSize', 'A4')
            ->setOption('displayHeaderFooter', true)
            
            ->setOption('footerSpacing', 10)
            ->setOption('headerTemplate', '<span></span>')
            ->showBackground()
            ->save($pdfPath);

        // Retourner le PDF comme une réponse
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename={$fileName}",
        ]);
    }

}
