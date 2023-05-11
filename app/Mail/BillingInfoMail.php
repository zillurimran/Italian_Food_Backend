<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillingInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name, $email, $phone, $address, $package_type, $package_price, $sms_quantity;
    public function __construct($name, $email, $phone, $address, $package_type, $package_price, $sms_quantity)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->package_type = $package_type;
        $this->package_price = $package_price;
        $this->sms_quantity = $sms_quantity;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Payment Successfull')->view('mails.billing_info');
    }
}
