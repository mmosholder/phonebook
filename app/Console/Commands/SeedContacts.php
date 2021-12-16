<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contact;
use Faker\Factory;

class SeedContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:contacts {quantity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Allows for seeding of contacts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $quantity = $this->argument('quantity');

        $faker = Factory::create();
        
        for ($i = 0; $i < $quantity; $i++) {
            Contact::create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'phone_number' => $faker->e164PhoneNumber(),
                'formatted_phone_number' => $faker->tollFreePhoneNumber()
            ]);

            echo ' . ';
        }
    }
}
