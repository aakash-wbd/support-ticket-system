# Support Ticket System

This project was developed as an assessment (coding test) for **NetCoden**.

## Features

-   **Admin & User Roles**: Two types of users (ADMIN and USER).
-   **Ticket Management**: USER's can open support tickets. ADMIN's can respond and close the tickets.
-   **Email Notifications**: Both users and admins receive email notifications for ticket updates.
-   **Mailtrap Integration**: Used Mailtrap for email testing in the development environment.
-   **Queue System**: Email notifications are handled via Laravel's Queue to improve performance.

## Essential command

Migrate & seeder

```bash
  php artisan migrate --seed
```

Queue work

```bash
  php artisan queue:work
```

## Mailtrap Config

```bash
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=*****44
MAIL_PASSWORD=*****8d
```
