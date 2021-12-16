# PhonebookIt
Welcome to PhonebookIt, a delightful webapp that let's you create and search your contacts list....and delete people from it if they've wronged you.

**Requirements**
- [Docker Desktop](https://www.docker.com/products/docker-desktop)

## Local Development

### Backend
1. Pull down this repo, cd into the repo, and run `composer install`.
2. Duplicate `.env.example` and name `.env`
3. Hop into your terminal (still in the repo) and run `php artisan key:generate`.
4. The hard part is over, now, run `vendor/bin/bash sail up` to get the docker containers started. This may take a bit for the first time running.
5. Once the docker containers are up, open up another terminal tab/window, cd into the repo, and run `vendor/bin/bash sail php artisan migrate`

### Frontend
1. Open up another terminal tab/window, cd into the repo and let's install some packages 🎉. Run `npm install` and go grab some water or do some jumping jacks.
