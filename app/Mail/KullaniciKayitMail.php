<?php

namespace App\Mail;

use App\Kullanici;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KullaniciKayitMail extends Mailable
{
    use Queueable, SerializesModels;
    public $kullanici;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Kullanici $kullanici)
    {
        $this->kullanici = $kullanici;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(config('app.name'),'- Kullanici Kaydi')
            ->view('mails.kullanici_kayit');
    }
}