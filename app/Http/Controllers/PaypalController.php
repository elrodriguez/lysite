<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\EPaymentsLog;

class PaypalController extends Controller
{
    public function payment(Request $request)
    {
        if($request->currency == "soles"){
            //código de Mercado Pago MercadoPago
            dd("Implementar MercadoPago");
        }else{
        $amount = $request->amount;
        $full_name = $request->full_name;
        $provider = new PayPalClient;
        $provider = \PayPal::setProvider();
        $currency = env('PAYPAL_CURRENCY');
        //$provider->setCurrency('PEN'); //si desea pagar en soles debe habilitarse esto en un if PEN no soporta PAYPAL

        // Desde Aquí se debe registrar y poner en pendiente en la tabla de donations_logs
        $payment = new EPaymentsLog();  // creamos y dejamos en PE pendiente hasta que se confirme el pago
        $payment->payment_origin = "paypal";
        $payment->currency = "USD";
        $payment->gross_amount = $amount;
        $payment->commission = ($amount*0.054)+0.3;
        $payment->net_amount = $amount - (($amount*0.054)+0.3);
        $payment->status_order = "PE"; //PENDIENTE
        $payment->name = $full_name;
        $payment->save();

        $paypalToken = $provider->getAccessToken();

        $data = array(
          "intent" => "CAPTURE",
          "application_context" => [
            "return_url" => route('paypal_success', $payment->id),
            "cancel_url" => route('paypal_cancel', $payment->id),
        ],
          "purchase_units" => array(
              array(
                  "amount" => array(
                      "currency_code" => $currency,
                      "value" => $amount
                  )
              )
          )
      );

        $response = $provider->createOrder($data);

        //dd($response);

        if(isset($response['id']) && $response['id'] != null){
          foreach($response['links'] as $link){
            if($link['rel'] === 'approve'){
              return redirect()->away($link['href']);
            }
          }
        }else{
          return $redirect()->route('paypal_cancel');
        }


        }

    }

    public function success($payment_id, Request $request){
      $provider = new PayPalClient;
      $provider = \PayPal::setProvider();
      $paypalToken = $provider->getAccessToken();

      $response = $provider->capturePaymentOrder($request->token);
      $email = $response['payer']['email_address'];
      $countryCode = $response['payer']['address']['country_code'];

      if(isset($response['status']) && $response['status'] == "COMPLETED"){
        $payment = EPaymentsLog::find($payment_id);
        $payment->status_order = "SU"; //Successful transacción exitosa
        $payment->email = $email;
        $payment->country_origin = $countryCode;
        $payment->save();
        return redirect()->route('web_gracias_por_donar', ['donador' => $payment->name]);
      }else{
        $payment = EPaymentsLog::find($payment_id);
        $payment->status_order = "CA"; //Cancelado transacción no llevada a cabo
        $payment->save();
        return redirect()->route('cms_principal');
      }
    }

    public function cancel($payment_id){
        $payment = EPaymentsLog::find($payment_id);
        $payment->status_order = "CA"; //Cancelado transacción no llevada a cabo
        $payment->save();
        return redirect()->route('cms_principal');
    }
}
