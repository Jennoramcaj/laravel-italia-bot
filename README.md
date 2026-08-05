# 🇮🇹 Laravel Italia Telegram Bot

![WIP](https://img.shields.io/badge/status-work%20in%20progress-orange)
![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat&logo=laravel)
![Nutgram](https://img.shields.io/badge/Nutgram-4.x-7952B3?style=flat&logo=telegram)
![License](https://img.shields.io/badge/license-MIT-blue)

Benvenuto nel repository ufficiale del bot per il gruppo Telegram di [**Laravel Italia**](https://t.me/laravel_ita).

Questo progetto ha lo scopo di fornire utility, moderazione e risorse utili per gli sviluppatori della community italiana di Laravel. Il codice è aperto a tutti: pull request, suggerimenti e issue sono benvenuti!

> ⚠️ **Attenzione: Work in Progress**
>
> Questo progetto è attualmente in **fase attiva di sviluppo**. Le funzionalità potrebbero cambiare rapidamente e alcune parti del codice potrebbero essere soggette a refactoring.

## 🛠 Tecnologia

Il bot è costruito utilizzando tecnologie moderne e robuste:

- **[Laravel](https://laravel.com/)**
- **[Nutgram](https://nutgram.dev/)**

## ✨ Funzionalità (Attuali e Pianificate)

- [x] Benvenuto automatico per i nuovi utenti.
- [x] Moderazione anti-spam di base (admin possono bannare utenti).
- [ ] Comando `/corsi` per link utili ai corsi Laravel.

## 🚀 Installazione e Sviluppo Locale

Se vuoi contribuire o testare il bot in locale, segui questi passaggi.

### Prerequisiti
- PHP 8.2+
- Composer
- Token Telegram

### Setup

1. **Clona il repository**
   ```bash
   git clone https://github.com/tuo-username/laravel-italia-bot.git
   cd laravel-italia-bot
   ```
2. **Setup del progetto**
    ```bash
   composer setup
    ```
3. **Configura il Token Telegram**

    Apri il file `.env` e inserisci il token fornito da @BotFather

    ```bash
   TELEGRAM_TOKEN=il_tuo_token_qui
    ```
4. **Avvia il bot (Polling Mode)**
   
    Per lo sviluppo locale, Nutgram offre una comoda modalità polling che non richiede HTTPS o tunnel (come Ngrok):

    ```bash
    php artisan nutgram:listen
    ```

## 🤝 Come Contribuire

Siamo felici di ricevere contributi dalla community italiana di Laravel! Che si tratti di fix, nuove funzionalità o miglioramenti alla documentazione, ogni aiuto è prezioso.

### Workflow di Sviluppo

1.  **Fai un Fork** del progetto sul tuo account GitHub.
2.  **Clona** il tuo fork localmente.
3.  Crea un **Branch** descrittivo per la tua modifica:
    ```bash
    git checkout -b feature/nome-della-tua-feature
    # oppure
    git checkout -b fix/descrizione-del-fix
    ```
4.  **Sviluppa** la tua funzionalità.
5.  **Formatta il codice**: Prima di inviare le modifiche, esegui `composer test` per assicurarti che il codice rispetti gli standard del progetto:
    ```bash
    composer test
    ```
    Questo comando eseguirà [Laravel Pint](https://laravel.com/docs/pint), [PestPHP](https://pestphp.com/) e [PHPStan](https://phpstan.org/)
6.  Fai **Commit** delle tue modifiche. Cerca di usare messaggi chiari e concisi.
7.  Fai **Push** sul tuo branch:
    ```bash
    git push origin feature/nome-della-tua-feature
    ```
8.  Apri una **Pull Request** verso il branch `main` di questo repository descrivendo le modifiche apportate.

## 🤝🏻 Convenzioni

### Lingua

🇬🇧 Utilizza la lingua **inglese** per
- codice (classi, metodi, variabili, ecc.)
- commenti nel codice
- messaggi di commit
- nomi branch (es. `feature/unban-command`)

🇮🇹 Utilizza la lingua **italiana** per
- messaggi/errori destinati all'utente su Telegram

## 🐛 Segnalazione Bug
Se trovi un bug ma non hai modo di risolverlo personalmente, apri una **Issue** descrivendo il problema, i passaggi per riprodurlo e, se possibile, includendo log o screenshot.

## 📄 Licenza

Questo progetto è open-source e rilasciato sotto licenza **MIT**. Per maggiori dettagli, consulta il file [LICENSE](https://opensource.org/license/MIT).

Essendo un progetto community-driven per Laravel Italia, il codice è libero e utilizzabile da chiunque, nel rispetto dei termini della licenza.

