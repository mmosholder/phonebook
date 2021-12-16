# PhonebookIt
Welcome to PhonebookIt, a delightful webapp that let's you create and search your contacts list....and delete people from it if they've wronged you.

**Requirements**
- [Docker Desktop](https://www.docker.com/products/docker-desktop)

## Local Development

### Backend
1. Pull down this repo, cd into the repo, and run `composer install`.
2. Open the repo in your code editor and duplicate `.env.example` and name `.env`
3. If you don't already have an entry for `127.0.0.1   localhost` in your hosts file, go ahead and add it now. Don't be ashamed to google how to do this, I have to look it up almost every time.
4. Hop into your terminal (still in the repo) and run `php artisan key:generate`.
5. The hard part is over, now, run `vendor/bin/bash sail up` to get the docker containers started. This may take a bit when running for the first time.
6. Once the docker containers are up, open up another terminal tab/window, cd into the repo, and run `vendor/bin/bash sail php artisan migrate`

### Frontend
1. Open up another terminal tab/window, cd into the repo and let's install some packages 🎉. Run `npm install` and get excited.
2. Now, time to set up the watcher by running `npm run watch`. This will recompile any changes to the front end assets.
3. Visit <a href="http://localhost:3002" target="_blank">http://localhost:3002</a> and see the magic

Now you are seeing the zero state of the app. Feel free to add a contact or seed as many as you want.

Seeding can be done from a terminal window by running `vendor/bin/bash sail php artisan seed:contacts {your_amount}`. Please don't go wild, I didn't put in any pagination.

## Enjoy!
