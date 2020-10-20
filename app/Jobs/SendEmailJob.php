<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Contrato;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $contrato;

    public function __construct(Contrato $contrato)
    {
        $this->contrato = $contrato;
    }


    public function handle()
    {
          // Send email 
          Mail::to($this->contrato->email_contrat)
          ->send(new WelcomeEmail('dev neto'));
    }
}
