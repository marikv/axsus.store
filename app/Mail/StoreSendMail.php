<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class StoreSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     * StoreSendMail constructor.
     * @param $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->details['type'] === 'register') {
            return $this
                ->subject('Регистрация на сайте ' . str_replace(['http://', 'https://'], '', env('APP_URL')))
                ->view('emails.autoregister')
                ;
        } elseif ($this->details['type'] === 'order') {
            /* @var $order Order */
            $order = $this->details['order'];
            /* @var $orderProducts array */
            $orderProducts = $this->details['orderProducts'];

            $return = $this
                ->subject(' Вы оформили заказ номер #'. $order->id .' на сайте ' . str_replace(['http://', 'https://'], '', Config::get('app.url')))
                ->view('emails.order')
//                ->with('orderProducts', $orderProducts)
//                ->with('order', $order)
                ;

            if ($this->details['invoicePath']) {
                $return = $return->attach($this->details['invoicePath'], [
                    'as' => 'Счет.pdf',
                    'mime' => 'application/pdf',
                ]);
            }
            if ($this->details['contractPath']) {
                $return = $return->attach($this->details['contractPath'], [
                    'as' => 'Лицензионный_договор_АКСИСПроекты.doc',
                    //'mime' => 'application/pdf',
                ]);
            }
            return $return;
        }

//        return $this
//            ->subject('Mail from ItSolutionStuff.com')
//            ->view('view.name')
//            ->attach('/path/to/file', [
//                'as' => 'name.pdf',
//                'mime' => 'application/pdf',
//            ])
//            ;
    }
}
