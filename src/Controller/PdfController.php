<?php

namespace App\Controller;

use App\Entity\Loan;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends Controller
{
    /**
 * @Route("/pdf/loan/export{id}", name="pdf_loan_export", methods={"GET"})
 */
    public function indexExport(Loan $loan)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('pdf/loan_pdf.html.twig', [
            'loan' => $loan
        ]);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream('demande_de_prêt.pdf', [
            "Attachment" => true
        ]);
    }

    /**
     * @Route("/pdf/loan/impr{id}", name="pdf_loan_impr", methods={"GET"})
     */
    public function indexImpr(Loan $loan)
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        $html = $this->renderView('pdf/loan_pdf.html.twig', [
            'loan' => $loan
        ]);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream('demande_de_prêt.pdf', [
            "Attachment" => false
        ]);
    }
}
