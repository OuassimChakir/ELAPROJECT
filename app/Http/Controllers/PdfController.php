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
        $invoice->logo = asset('images/Logo/logo_ela.png');
        $invoice->hasItemUnits = true;
        return $invoice->stream();
    }
}
