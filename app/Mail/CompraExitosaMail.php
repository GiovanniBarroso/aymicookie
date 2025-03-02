<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompraExitosaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function build()
    {
        return $this->subject('🎉 ¡Gracias por tu compra en Ay Mi Cookie!')
            ->view('emails.success_buy')
            ->with([
                'order' => $this->order
            ]);
    }

}
