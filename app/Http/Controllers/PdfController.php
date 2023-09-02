<?php

namespace App\Http\Controllers;

use App\Models\Expenses\Facture;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Seller;

class PdfController extends Controller
{
    public function pdf($idExpensePayment){
        $Facture = new Facture();
        $data = $Facture->getFacturePdf($idExpensePayment);
        if(!is_null($data->idStaff)){
            $customer = new Buyer([
                'name'          => $data->prenom.' '.$data->nom,
                'phone'         => $data->numTel,
                'custom_fields' => [
                    'CNIE' => $data->cnie,
                ],
            ]);
        }else{
            $customer = new Buyer([
                'custom_fields' => [
                    'Payement' => $data->designation,
                    'description' => $data->description,
                ],
            ]);
        }

    
        $item = (new InvoiceItem())->title($data->designation)->pricePerUnit($data->amount);
        
        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item);
        $invoice->sequence($data->idExpensePayment);
        $invoice->name = "ELA Facture";
        $invoice->logo = asset('images/logo/logo_ela.png');
        $invoice->hasItemUnits = true;
        return $invoice->stream();
    }
}
