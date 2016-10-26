# QuizSMS

A simple system that will leverage SMS from [Nexmo 📲👌](https://www.nexmo.com/) and create a way for anybody to SMS an answer to a question. Live dashboard shows incoming quiz responses uses [Pusher 🤖♥](https://pusher.com/). Used at [Hackference 2016](http://2016.hackference.co.uk/) to manage the quiz at the conference.

The whole system was hacked together quickly, thanks to the wonderful API's of Nexmo and Pusher, who make it super quick to get something up and running within hours.

## Based on

- [Laravel - v5.2](https://laravel.com)
- [Bootstrap - v4](http://v4-alpha.getbootstrap.com/)
- [FontAwesome - v](https://fontawesome.io)

## Requires

- PHP 5.5.9
- MySQL
- Nexmo Account
- Pusher Account

## Installation

```
git clone https://github.com/JakePrice86/QuizSMS .
composer install
php artisan migrate
```

If you have any problems, make sure you follow [these instructions](https://laravel.com/docs/5.2/installation)

## Setup

in `.env` you should change:

```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
PUSHER_KEY=
PUSHER_SECRET=
APP_ID=
```

To change the answers, find `config/answers.php` and change the array. It should be very self-explanatory.

When creating a number inside Nexmo, you'll want to set a webhook back to your system. This webhook will tell you when somebody has SMS your number, and will parse the body of the message, and check if the answer is right or wrong. The webhook you want to enter in should be `http://YOURWEBSITE.COM/quiz`

## How to use the system

Users should text your number from Nexmo with messages that look like: A 1 or C 13 - Answer then Question. A user can only answer a question once, and their first answer is the one that is recorded. Monitor your live responses at `http://YOURWEBSITE.COM/dashboard`, check who has entered on the Users page, and pick a random correct answer from all of the correct answers!

## License

Copyright (c) 2016 Jake Price
Licensed under the MIT license.