<?php

namespace App\CoreFacturalo;

use Illuminate\Support\Facades\Log;

class Template
{
    public function pdf($base_template, $template, $company, $document, $format_pdf)
    {
        if ($template === 'credit' || $template === 'debit') {
            $template = 'note';
        }

        $path_template =  $this->validate_template($base_template, $template, $format_pdf);
        // Log::info($document);
        return self::render($path_template, $company, $document);
    }

    public function preprintedpdf($base_template, $template, $company, $format_pdf)
    {
        if ($template === 'credit' || $template === 'debit') {
            $template = 'note';
        }

        $path_template =  $this->validate_preprinted_template($base_template, $template, $format_pdf);

        return self::preprintedrender($path_template, $company);
    }

    public function xml($template, $company, $document)
    {
        return self::render('xml.' . $template, $company, $document);
    }

    private function render($view, $company, $document)
    {
        view()->addLocation(__DIR__ . '/Templates');

        return view($view, compact('company', 'document'))->render();
    }

    private function preprintedrender($view, $company)
    {
        view()->addLocation(__DIR__ . '/Templates');

        return view($view, compact('company'))->render();
    }

    public function pdfFooter($base_template, $document = null)
    {
        view()->addLocation(__DIR__ . '/Templates');

        return view('pdf.' . $base_template . '.partials.footer', compact('document'))->render();
    }

    public function pdfHeader($base_template, $company, $document = null)
    {
        view()->addLocation(__DIR__ . '/Templates');

        return view('pdf.' . $base_template . '.partials.footer')->render();
    }

    public function pdfFooterExtranet($base_template)
    {
        view()->addLocation(__DIR__ . '/Templates');

        return view('pdf.' . $base_template . '.partials.footer_extranet')->render();
        return view('pdf.' . $base_template . '.partials.header', compact('company', 'document'))->render();
    }

    public function validate_template($base_template, $template, $format_pdf)
    {
        $path_app_template = app_path('CoreFacturalo' . DIRECTORY_SEPARATOR . 'Templates');
        $path_template_default = 'pdf' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR . $template . '_' . $format_pdf;
        $path_template = 'pdf' . DIRECTORY_SEPARATOR . $base_template . DIRECTORY_SEPARATOR . $template . '_' . $format_pdf;




        if (file_exists($path_app_template . DIRECTORY_SEPARATOR . $path_template . '.blade.php')) {
            return str_replace(DIRECTORY_SEPARATOR, '.', $path_template);
        }

        return str_replace(DIRECTORY_SEPARATOR, '.', $path_template_default);
    }

    public function validate_preprinted_template($base_template, $template, $format_pdf)
    {
        $path_app_template = app_path('CoreFacturalo' . DIRECTORY_SEPARATOR . 'Templates');
        $path_template_default = 'preprinted_pdf' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR . $template . '_' . $format_pdf;
        $path_template = 'preprinted_pdf' . DIRECTORY_SEPARATOR . $base_template . DIRECTORY_SEPARATOR . $template . '_' . $format_pdf;



        if (file_exists($path_app_template . DIRECTORY_SEPARATOR . $path_template . '.blade.php')) {
            return str_replace(DIRECTORY_SEPARATOR, '.', $path_template);
        }

        return str_replace(DIRECTORY_SEPARATOR, '.', $path_template_default);
    }


    public function pdfFooterTermCondition($base_template, $document)
    {
        view()->addLocation(__DIR__ . '/Templates');

        return view('pdf.' . $base_template . '.partials.footer_term_condition', compact('document'))->render();
    }


    public function pdfFooterLegend($base_template, $document)
    {
        view()->addLocation(__DIR__ . '/Templates');

        return view('pdf.' . $base_template . '.partials.footer_legend', compact('document'))->render();
    }


    public function pdfFooterNoteSignature($base_template, $document, $company)
    {
        view()->addLocation(__DIR__ . '/Templates');

        return view('pdf.' . $base_template . '.partials.footer_note_signature', compact('document', 'company'))->render();
    }

    public function footerExtranetDashboard($base_template, $company)
    {
        view()->addLocation(__DIR__ . '/Templates');
        $base_template = $this->validate_template_footer($base_template);
        return view('pdf.' . $base_template . '.partials.footer_extranet_dashboard', compact('company'))->render();
    }

    public function validate_template_footer($base_template, $template = 'footer_extranet_dashboard')
    {
        $path_app_template = app_path('CoreFacturalo' . DIRECTORY_SEPARATOR . 'Templates');
        $path_template = 'pdf' . DIRECTORY_SEPARATOR . $base_template . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . $template;
        if (file_exists($path_app_template . DIRECTORY_SEPARATOR . $path_template . '.blade.php')) {
            return $base_template;
        }
        return 'default';
    }
    public function pdfFooterBlank($base_template, $document)
    {
        view()->addLocation(__DIR__ . '/Templates');

        return view('pdf.' . $base_template . '.partials.footer_blank', compact('document'))->render();
    }
}
