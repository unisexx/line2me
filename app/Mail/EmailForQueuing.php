<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailForQueuing extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.email')
                ->subject('เสนอโปรโมชั่นตลอดปี 2020 กับโปรโมทสติ๊กเกอร์ไลน์ในราคาเพียง 50 บาทต่อเดือนเท่านั้น');
    }
}
