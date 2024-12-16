<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# Email Job System

Este projeto Laravel demonstra como configurar e utilizar o envio de e-mails de forma assíncrona usando **Jobs**, **Queues** e o **Laravel Scheduler**.

---

## 🎯 Objetivo

1. Configurar o envio de e-mails no Laravel usando Jobs e filas.
2. Implementar um sistema para disparo automático e agendado de e-mails.
3. Criar uma base para projetos futuros que envolvam processamento assíncrono de tarefas.

---

## 📋 Requisitos

Certifique-se de que você possui os seguintes itens instalados no seu ambiente:

- **PHP** >= 8.0
- **Composer**
- **Laravel** >= 9.x
- Banco de dados compatível (MySQL, SQLite, PostgreSQL, etc.)
- Serviço de envio de e-mails configurado (ex.: Mailtrap, Gmail, etc.)
- Opcional: **Redis** para gerenciamento avançado de filas

---

## 🚀 Passo a Passo

### **1. Clonar o repositório**

```bash
git clone https://github.com/VagnerGiraldinoJr/email-job-system.git
cd email-job-system
```

### **2. Instalar as dependências**

```bash
composer install
```

### **3. Configurar o arquivo .env**

Crie o arquivo `.env` a partir do exemplo fornecido:

```bash
cp .env.example .env
```

Configure as credenciais do serviço de e-mail no arquivo `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_usuario
MAIL_PASSWORD=sua_senha
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=seu_email@dominio.com
MAIL_FROM_NAME="Seu Nome"
```

### **4. Gerar a chave da aplicação**

```bash
php artisan key:generate
```

### **5. Configurar o sistema de filas**

Defina o driver de filas no `.env`:

```env
QUEUE_CONNECTION=database
```

Crie a tabela de filas no banco de dados:

```bash
php artisan queue:table
php artisan migrate
```

### **6. Testar o envio de e-mail**

Execute o comando Artisan para disparar manualmente o envio de um e-mail:

```bash
php artisan email:send
```

### **7. Configurar o Scheduler**

Abra o arquivo `app/Console/Kernel.php` e verifique a configuração do agendamento:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('email:send')->everyMinute();
}
```

Configure o agendador de tarefas no sistema operacional:

**Linux/macOS**

Adicione ao crontab:

```bash
* * * * * cd /caminho/do/projeto && php artisan schedule:run >> /dev/null 2>&1
```

**Windows**

Use o Agendador de Tarefas para executar este comando a cada minuto. Para mais informações, consulte a documentação oficial.

Inicie o processamento das filas:

```bash
php artisan queue:work
```

---

## 📂 Estrutura do Projeto

- **Comando Artisan** (`app/Console/Commands/SendEmailCommand.php`): Gerencia o envio de e-mails via Jobs.
- **Job** (`app/Jobs/SendEmailJob.php`): Processa o envio assíncrono dos e-mails.
- **Scheduler** (`app/Console/Kernel.php`): Agenda a execução automática do comando `email:send`.

---

## 📖 Exemplo de Código

### **Comando Artisan**

```php
protected $signature = 'email:send';

public function handle()
{
    $destinatario = 'destinatario@email.com';
    SendEmailJob::dispatch($destinatario);
    $this->info('E-mail agendado com sucesso!');
}
```

### **Job**

```php
public function handle()
{
    Mail::raw('Este é um e-mail de teste.', function ($message) {
        $message->to($this->destinatario)
                ->subject('Teste de E-mail via Job');
    });
}
```

---

## 🛠️ Contribuindo

Contribuições são sempre bem-vindas! Para contribuir:

1. Faça um fork do repositório.
2. Crie um branch com sua funcionalidade: `git checkout -b nova-funcionalidade`.
3. Realize o commit das alterações: `git commit -m 'Adicionei uma nova funcionalidade'`.
4. Envie para o branch remoto: `git push origin nova-funcionalidade`.
5. Abra um Pull Request.

---

## 📜 Licença

Este projeto está licenciado sob a Licença MIT.
