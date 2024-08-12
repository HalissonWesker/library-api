<?php

namespace App\Listeners;

use App\Events\LoanCreated;
use App\Mail\LoanCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLoanCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(LoanCreated $event)
    {
        $loan = $event->loan;
        $user = $loan->user;

        // Envie o e-mail aqui
        Mail::to($user->email)->send(new LoanCreatedMail($loan));
    }
}
