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
        $pdfPath = storage_path("app/public/rapport.pdf");

        Browsershot::html($html)
            ->setOption('no-sandbox', true)
            ->setOption('pageSize', 'A4')
            ->setOption('displayHeaderFooter', true)
            ->setOption('footerTemplate', '
                <div style="text-align: center; font-size: 12px; color: #333; width: 100%; margin-top:2rem;">
                    Document généré le ' . Carbon::now()->format("d/m/Y à H:i") . ' 
                    | Page <span class="pageNumber"></span> sur <span class="totalPages"></span>
                </div>
            ') 
            ->setOption('footerSpacing', 10) 
            ->setOption('headerTemplate', '<span></span>') 
            ->showBackground()
            ->save($pdfPath);

        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=rapport.pdf",
        ]);
    }
}
