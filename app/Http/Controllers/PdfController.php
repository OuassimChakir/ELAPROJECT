<?php

namespace App\Http\Controllers;

use App\Models\Expenses\Facture;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;


class PdfController extends Controller
{
    public function pdf($idExpensePayment){
        
        $data =Facture::getFacturePdf($idExpensePayment);
        if(!is_null($data->idStaff ||$data->idProfesseur )){
            $customer = new Buyer([
                'name'          => $data->prenom.' '.$data->nom,
                'custom_fields' => [
                    'Paiement' => $data->designation,
                    'description' => $data->description,
                ],
            ]);
            
        }else{
            $customer = new Buyer([
                'custom_fields' => [
                    'Paiement' => $data->designation,
                    'description' => $data->description,
                ],
            ]);
        }

    
        $item = (new InvoiceItem())->title($data->designation)->pricePerUnit($data->amount);
        
        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item);
        $invoice->sequence($data->idExpensePayment);
        $invoice->name = "BMA Facture";
        $invoice->logo = asset('images/Logo/logo.png');
        $invoice->hasItemUnits = true;
        return $invoice->stream();
    }
}
