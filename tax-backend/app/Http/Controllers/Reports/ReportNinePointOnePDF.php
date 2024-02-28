<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ReportNinePointOneExportFile;
use App\Helpers\V1\ReportNinePointOneHelper;
use App\Models\Entity;
use Maatwebsite\Excel\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class ReportNinePointOnePDF extends Controller
{
    public function exportPDF(){
        $pdf = PDF::loadView('reports.pdf.reportninepoint1');
        return $pdf->download('laratutorials.pdf');
    }

    public function exportPDFUsingDate($entity_id,$date){
        try{
            $COMPACT_DATA = [];
            $entity = Entity::findOrFail($entity_id);
            $COMPACT_DATA['entity'] = $entity;
            $sellsTransactionProducts = ReportNinePointOneHelper::transactionProductsViaTransactionTypeWithDate($entity_id,$date,2);
            $purchaseTransactionProducts = ReportNinePointOneHelper::transactionProductsViaTransactionTypeWithDate($entity_id,$date,1);
            $COMPACT_DATA['sellsTransactionProducts'] = $sellsTransactionProducts;
            $COMPACT_DATA['purchaseTransactionProducts'] = $purchaseTransactionProducts;


            //zeroRatedSells  Local
            // $zeroRatedSellsLocal = array_filter($sellsTransactionProducts,fn($product)=>$product->tax_rate == 0 && $product?->transaction?->transaction_category === 'local' );

            $zeroRatedSellsLocal = $sellsTransactionProducts->filter(fn($product,$key)=>$product->tax_rate == 0 && $product?->transaction?->transaction_category === 'local');
            $COMPACT_DATA['zeroRatedSellsLocal'] = $zeroRatedSellsLocal;

            $zeroSellsLocalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($zeroRatedSellsLocal);
            $COMPACT_DATA['zeroSellsLocalTaxesValueSum'] = $zeroSellsLocalTaxesValueSum;
            // end of zero rated sells Local


            //zeroRatedSells  international
            $zeroRatedSellsInternational = $sellsTransactionProducts->filter(fn($product)=>$product->tax_rate == 0 & $product?->transaction?->transaction_category === 'international' );
            $COMPACT_DATA['zeroRatedSellsInternational'] = $zeroRatedSellsInternational;

            $zeroSellsInternationalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($zeroRatedSellsInternational);
            $COMPACT_DATA['zeroSellsInternationalTaxesValueSum'] = $zeroSellsInternationalTaxesValueSum;
            // end of zero rated sells international

            //exempted rated sells
            $exemptedRatedSells  = $sellsTransactionProducts->filter(fn($product)=>$product->tax_rate == -1 );
            $COMPACT_DATA['exemptedRatedSells'] = $exemptedRatedSells;
            $COMPACT_DATA['exemptedRatedSellsTaxesValueSum']  = ReportNinePointOneHelper::transactionProductsTaxableValue($exemptedRatedSells);

            //standared rated sells
            $standardRatedSells  =  $sellsTransactionProducts->filter(fn($product)=>$product->tax_rate == 15 );

            $standardRatedSellsSDSum  = ReportNinePointOneHelper::transactionProductsSDRate($standardRatedSells);
            $standardRatedSellsTaxSum  = ReportNinePointOneHelper::transactionProductsVATRate($standardRatedSells);
            $standardRatedSellsTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($standardRatedSells);
            $COMPACT_DATA['standardRatedSellsSDSum'] = $standardRatedSellsSDSum;
            $COMPACT_DATA['standardRatedSellsTaxSum'] = $standardRatedSellsTaxSum;
            $COMPACT_DATA['standardRatedSellsTaxesValueSum'] = $standardRatedSellsTaxesValueSum;



            //non standard rated sells
            //non standard rated sells
            $nonStandardRatedSells = $sellsTransactionProducts->filter(fn($product)=>$product->tax_rate > 0 && $product->tax_rate < 15 && ($product->tax_rate != 5 ) );
            $nonStandardRatedSellsSDSum  = ReportNinePointOneHelper::transactionProductsSDRate($nonStandardRatedSells);
            $nonStandardRatedSellsTaxSum  = ReportNinePointOneHelper::transactionProductsVATRate($nonStandardRatedSells);
            $nonStandardRatedSellsTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($nonStandardRatedSells);

            $COMPACT_DATA['nonStandardRatedSellsSDSum'] = $nonStandardRatedSellsSDSum;
            $COMPACT_DATA['nonStandardRatedSellsTaxSum'] = $nonStandardRatedSellsTaxSum;
            $COMPACT_DATA['nonStandardRatedSellsTaxesValueSum'] = $nonStandardRatedSellsTaxesValueSum;
            $COMPACT_DATA['nonStandardRatedSells'] = $nonStandardRatedSells;

            //trading based rated sells
            $tradingBasedRatedSells = $sellsTransactionProducts->filter(fn($product)=>$product->tax_rate == 5 );
            $trandingBasedRatedSellsSDSum  = ReportNinePointOneHelper::transactionProductsSDRate($tradingBasedRatedSells);
            $trandingBasedRatedSellsTaxSum  = ReportNinePointOneHelper::transactionProductsVATRate($tradingBasedRatedSells);
            $trandingBasedRatedSellsTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($tradingBasedRatedSells);

            $COMPACT_DATA['tradingBasedRatedSells'] = $tradingBasedRatedSells;
            $COMPACT_DATA['trandingBasedRatedSellsSDSum'] = $trandingBasedRatedSellsSDSum;
            $COMPACT_DATA['trandingBasedRatedSellsTaxSum'] = $trandingBasedRatedSellsTaxSum;
            $COMPACT_DATA['trandingBasedRatedSellsTaxesValueSum'] = $trandingBasedRatedSellsTaxesValueSum;
            // END OF TRANDING BASED RATED SELLS

            //zero purchase section local
            $zeroPurchaseLocal = $purchaseTransactionProducts->filter(fn($product)=>$product->tax_rate == 0  && $product?->transaction?->transaction_category === 'local');
            $COMPACT_DATA['zeroPurchaseLocal'] = $zeroPurchaseLocal;
            $zeroPurchaseLocalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($zeroPurchaseLocal);
            // end of zero purchase section local
            $COMPACT_DATA['zeroPurchaseLocalTaxesValueSum'] = $zeroPurchaseLocalTaxesValueSum;



            //ZERO PURCHASE INTERNATIONAL
            $zeroPurchaseInternational = $purchaseTransactionProducts->filter(fn($product)=>$product->tax_rate == 0  && $product?->transaction?->transaction_category === 'international');
            $zeroPurchaseInternationalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($zeroPurchaseInternational);
            $COMPACT_DATA['zeroPurchaseInternational'] = $zeroPurchaseInternational;
            $COMPACT_DATA['zeroPurchaseInternationalTaxesValueSum'] = $zeroPurchaseInternationalTaxesValueSum;
            // END OF ZERO PURCHASE INTERNATIONAL

            //EXEMPTED PURCHASE LOCAL
            $exemptedPurchaseLocal =  $purchaseTransactionProducts->filter(fn($product)=>$product->tax_rate == -1  && $product?->transaction?->transaction_category === 'local');

            $exemptedPurchaseInternationalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($exemptedPurchaseLocal);
            $COMPACT_DATA['exemptedPurchaseInternationalTaxesValueSum'] = $exemptedPurchaseInternationalTaxesValueSum;
            $COMPACT_DATA['exemptedPurchaseLocal'] = $exemptedPurchaseLocal;
            //END OF EXEMPTED PURCHASE LOCAL

            //EXEMPTED PURCHASE INTERNATIONAL
            $exemptedPurchaseInternational =  $purchaseTransactionProducts->filter(fn($product)=>$product->tax_rate == -1 && $product?->transaction?->transaction_category === 'international');
            $exemptedPurchaseInternationalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($exemptedPurchaseInternational);
            $COMPACT_DATA['exemptedPurchaseInternationalTaxesValueSum'] = $exemptedPurchaseInternationalTaxesValueSum;
            $COMPACT_DATA['exemptedPurchaseInternational'] = $exemptedPurchaseInternational;
            //END OF EXEMPTED PURCHASE INTERNATIONAL


            //STANDARD PURCHASE LOCAL
            $standardPurchaseLocal = $purchaseTransactionProducts->filter(fn($product)=>$product->tax_rate == 15  && $product?->transaction?->transaction_category === 'local' && $product?->transaction?->contact?->bin);

            $standardPurchaseLocalSDSum  = ReportNinePointOneHelper::transactionProductsSDRate($standardPurchaseLocal);
            $standardPurchaseLocalTaxSum = ReportNinePointOneHelper::transactionProductsVATRate($standardPurchaseLocal);
            $standardPurchaseLocalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($standardPurchaseLocal);
            $COMPACT_DATA['standardPurchaseLocal'] = $standardPurchaseLocal;
            $COMPACT_DATA['standardPurchaseLocalSDSum'] = $standardPurchaseLocalSDSum;
            $COMPACT_DATA['standardPurchaseLocalTaxSum'] = $standardPurchaseLocalTaxSum;
            $COMPACT_DATA['standardPurchaseLocalTaxesValueSum'] = $standardPurchaseLocalTaxesValueSum;
            //END OF STANDARD PURCHASE LOCAL

            //STANDARD PURCHASE INTERNATIONAL
            $standardPurchaseInternational = $purchaseTransactionProducts->filter(fn($product)=>$product->tax_rate == 15  && $product?->transaction?->transaction_category === 'international' && $product?->transaction?->contact?->bin);

            $standardPurchaseInternationalSDSum  = ReportNinePointOneHelper::transactionProductsSDRate($standardPurchaseInternational);
            $standardPurchaseInternationalTaxSum = ReportNinePointOneHelper::transactionProductsVATRate($standardPurchaseInternational);
            $standardPurchaseInternationalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($standardPurchaseInternational);
            $COMPACT_DATA['standardPurchaseInternational'] = $standardPurchaseInternational;
            $COMPACT_DATA['standardPurchaseInternationalSDSum'] = $standardPurchaseInternationalSDSum;
            $COMPACT_DATA['standardPurchaseInternationalTaxSum'] = $standardPurchaseInternationalTaxSum;
            $COMPACT_DATA['standardPurchaseInternationalTaxesValueSum'] = $standardPurchaseInternationalTaxesValueSum;
            //STANDARD PURCHASE INTERNAIONAL



            //NONE STANDARD PURCHASE LOCAL
            $nonStandardPurchaseLocal = $purchaseTransactionProducts->filter(fn($product)=>$product->tax_rate > 0 && $product->tax_rate < 15  && $product?->transaction?->transaction_category === 'local' && $product?->transaction?->contact?->bin);

            $nonStandardPurchaseLocalSDSum  = ReportNinePointOneHelper::transactionProductsSDRate($nonStandardPurchaseLocal);
            $nonStandardPurchaseLocalTaxSum = ReportNinePointOneHelper::transactionProductsVATRate($nonStandardPurchaseLocal);
            $nonStandardPurchaseLocalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($nonStandardPurchaseLocal);
            $COMPACT_DATA['nonStandardPurchaseLocal'] = $nonStandardPurchaseLocal;
            $COMPACT_DATA['nonStandardPurchaseLocalSDSum'] = $nonStandardPurchaseLocalSDSum;
            $COMPACT_DATA['nonStandardPurchaseLocalTaxSum'] = $nonStandardPurchaseLocalTaxSum;
            $COMPACT_DATA['nonStandardPurchaseLocalTaxesValueSum'] = $nonStandardPurchaseLocalTaxesValueSum;
            //END OF NON STANDARD PURCHASE LOCAL


            //NON STANDARD PURCHASE INTERNATIONAL
            $nonStandardPurchaseInternational = $purchaseTransactionProducts->filter(fn($product)=>$product->tax_rate > 0 && $product->tax_rate < 15  && $product?->transaction?->transaction_category === 'international' && $product?->transaction?->contact?->bin);

            $nonStandardPurchaseInternationalSDSum  = ReportNinePointOneHelper::transactionProductsSDRate($nonStandardPurchaseInternational);
            $nonStandardPurchaseInternationalTaxSum = ReportNinePointOneHelper::transactionProductsVATRate($nonStandardPurchaseInternational);
            $nonStandardPurchaseInternationalTaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($nonStandardPurchaseInternational);
            $COMPACT_DATA['nonStandardPurchaseInternational'] = $nonStandardPurchaseInternational;
            $COMPACT_DATA['nonStandardPurchaseInternationalSDSum'] = $nonStandardPurchaseInternationalSDSum;
            $COMPACT_DATA['nonStandardPurchaseInternationalTaxSum'] = $nonStandardPurchaseInternationalTaxSum;
            $COMPACT_DATA['nonStandardPurchaseInternationalTaxesValueSum'] = $nonStandardPurchaseInternationalTaxesValueSum;
            //END OF NON STANDARD PURCHASE INTERNATIONAL


            // UN REGISTERED PURCHASE LOCAL FOR NOTE 20
            $unRegisteredPurchaseLocalForNote20 = $purchaseTransactionProducts->filter(fn($product)=>$product->tax_rate < 15 && $product->tax_rate > 0  && $product?->transaction?->transaction_category === 'local' && !$product?->transaction?->contact?->bin);
            $unRegisteredPurchaseLocalForNote20TaxesValueSum  = ReportNinePointOneHelper::transactionProductsTaxableValue($unRegisteredPurchaseLocalForNote20);
            $COMPACT_DATA['unRegisteredPurchaseLocalForNote20'] = $unRegisteredPurchaseLocalForNote20;
            $COMPACT_DATA['unRegisteredPurchaseLocalForNote20TaxesValueSum'] = $unRegisteredPurchaseLocalForNote20TaxesValueSum;
            //END OF UN REGISTERED PURCHASE LOCAL F OR NOTE 20

            //total sells tax value
            $totalSellsTaxableValue = ReportNinePointOneHelper::transactionProductsTaxableValue($sellsTransactionProducts);
            $COMPACT_DATA['totalSellsTaxableValue'] = $totalSellsTaxableValue;

            $totalSellsTaxValue = ReportNinePointOneHelper::transactionProductsVATRate($sellsTransactionProducts);
            $COMPACT_DATA['totalSellsTaxValue'] = $totalSellsTaxValue;


            $totalSellsSDValue = ReportNinePointOneHelper::transactionProductsSDRate($sellsTransactionProducts);
            $COMPACT_DATA['totalSellsSDValue'] = $totalSellsSDValue;
            // end of sells total section

            //total purchases tax section
            $totalPurchaseTaxableValue = ReportNinePointOneHelper::transactionProductsTaxableValue($purchaseTransactionProducts);
            $COMPACT_DATA['totalPurchaseTaxableValue'] = $totalPurchaseTaxableValue;

            $totalPurchaseTaxValue = ReportNinePointOneHelper::transactionProductsVATRate($purchaseTransactionProducts);
            $COMPACT_DATA['totalPurchaseTaxValue'] = $totalPurchaseTaxValue;

            $totalPurchaseSDValue = ReportNinePointOneHelper::transactionProductsSDRate($purchaseTransactionProducts);
            $COMPACT_DATA['totalPurchaseSDValue'] = $totalPurchaseSDValue;
            // end of purchase total section


            $pdf = PDF::loadView('reports.pdf.reportninepoint1',$COMPACT_DATA);
            $fileName = time()."{$date}_reportNinePointOne.pdf";
            file_put_contents(public_path("pdf/{$fileName}"),$pdf->stream($fileName));
            // $headers = [
            //     'Content-Type'=> 'application/pdf',
            //     // 'Content-Type'=> 'application/octet-stream',
            //     'Content-Disposition'=> 'attachment; filename="report91.pdf"'
            // ];
            return response()->download(public_path("pdf/{$fileName}"));
            // return $pdf->download('document.pdf')->withHeaders();

        }catch(Exception $e){
            // return response()->json($e->getLine());
            // return response()->json($e->getCode());

            return $this->error($e->getMessage(),500);
        }
    }
    public function exportPDFUsingDateRange($entity_id,$fromDate,$toDate){
        $sellsTransactionProducts = ReportNinePointOneHelper::transactionProductsViaTransactionTypeWithDateRange($entity_id,$fromDate,$toDate,2);
        $purchaseTransactionProducts = ReportNinePointOneHelper::transactionProductsViaTransactionTypeWithDateRange($entity_id,$fromDate,$toDate,1);
    }
}
