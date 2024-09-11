<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangePassword;

class SendChangePassEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $detalles;
    /**
     * Create a new job instance.
     */
    public function __construct($detalles)
    {
        //
        $this->detalles = $detalles;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //

        $mail = new ChangePassword(
            $this->detalles['id_usuario'],
            $this->detalles['nombre'],
            $this->detalles['token'],
        );
        Mail::to($this->detalles['email'])->send($mail);
    }
}
