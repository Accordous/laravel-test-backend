<?php

namespace App\Observers;
use App\Jobs\SendEmailJob;
use App\Contrato;

class ContratoObserver
{
    /**
     * Handle the contrato "created" event.
     *
     * @param  \App\Contrato  $contrato
     * @return void
     */
    public function created(Contrato $contrato)
    {
        SendEmailJob::dispatch($contrato);
    }

    /**
     * Handle the contrato "updated" event.
     *
     * @param  \App\Contrato  $contrato
     * @return void
     */
    public function updated(Contrato $contrato)
    {
        //
    }

    /**
     * Handle the contrato "deleted" event.
     *
     * @param  \App\Contrato  $contrato
     * @return void
     */
    public function deleted(Contrato $contrato)
    {
        //
    }

    /**
     * Handle the contrato "restored" event.
     *
     * @param  \App\Contrato  $contrato
     * @return void
     */
    public function restored(Contrato $contrato)
    {
        //
    }

    /**
     * Handle the contrato "force deleted" event.
     *
     * @param  \App\Contrato  $contrato
     * @return void
     */
    public function forceDeleted(Contrato $contrato)
    {
        //
    }
}
