<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmailJob;

/**
 * Classe SendEmailCommand
 * Este comando dispara um e-mail utilizando um Job no Laravel.
 */
class SendEmailCommand extends Command
{
    /**
     * O nome e a assinatura do comando.
     * Este será utilizado no terminal para executar o comando.
     */
    protected $signature = 'email:send';

    /**
     * A descrição do comando.
     * Esta descrição aparece na lista de comandos Artisan.
     */
    protected $description = 'Dispara um e-mail agendado por Job';

    /**
     * Construtor do comando.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Lógica principal do comando.
     * Este método dispara um Job que enviará um e-mail.
     */
    public function handle()
    {
        $destinatario = 'destinatario@email.com'; // Substitua pelo e-mail desejado.
        SendEmailJob::dispatch($destinatario);   // Dispara o Job.
        $this->info('E-mail agendado com sucesso!'); // Exibe uma mensagem no terminal.
    }
}
