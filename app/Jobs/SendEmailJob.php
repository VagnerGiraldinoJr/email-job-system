<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

/**
 * Classe SendEmailJob
 * Este Job gerencia o envio de e-mails.
 */
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $destinatario;

    /**
     * Construtor do Job.
     *
     * @param string $destinatario E-mail do destinatário.
     */
    public function __construct($destinatario)
    {
        $this->destinatario = $destinatario;
    }

    /**
     * Lógica principal do Job.
     * Envia o e-mail utilizando o sistema do Laravel.
     */
    public function handle()
    {
        // Enviar o e-mail.
        Mail::raw('Este é um e-mail de teste enviado via Job no Laravel.', function ($message) {
            $message->to($this->destinatario)
                ->subject('Teste de E-mail via Job');
        });
    }
}
