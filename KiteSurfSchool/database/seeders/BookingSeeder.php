<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Lespakket;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('nl_NL');
        
        // First verify if tables exist and their exact names
        $this->command->info('Checking database tables...');
        
        // Get all user IDs to create valid relationships
        $userIds = User::pluck('id')->toArray();
        
        // Use the Lespakket model which has the table name specified
        $lespakketIds = Lespakket::pluck('id')->toArray();
        
        // Check if we have users and lespakketten to work with
        if (empty($userIds) || empty($lespakketIds)) {
            $this->command->info('Please make sure users and lespakketten are seeded first.');
            return;
        }
        
        $this->command->info('Found ' . count($userIds) . ' users and ' . count($lespakketIds) . ' lespakketten.');
        
        // Create 50 bookings with random data
        for ($i = 0; $i < 50; $i++) {
            try {
                // Generate a date between now and 3 months in the future
                $bookingDate = $faker->dateTimeBetween('now', '+3 months');
                
                // Randomly decide status based on date
                $bookingDateTime = Carbon::parse($bookingDate);
                $now = Carbon::now();
                
                // Past bookings are more likely to be confirmed or canceled
                if ($bookingDateTime->isPast()) {
                    $status = $faker->randomElement([
                        'bevestigd', 'bevestigd', 'bevestigd', 'geannuleerd'
                    ]);
                    $paymentStatus = $faker->randomElement([
                        'paid', 'paid', 'paid', 'refunded'
                    ]);
                } 
                // Future bookings are more likely to be pending
                else {
                    $status = $faker->randomElement([
                        'in behandeling', 'in behandeling', 'bevestigd', 'geannuleerd'
                    ]);
                    $paymentStatus = $faker->randomElement([
                        'pending', 'pending', 'paid'
                    ]);
                }
                
                // Create the booking with error handling
                DB::table('bookings')->insert([
                    'user_id' => $faker->randomElement($userIds),
                    'lespakket_id' => $faker->randomElement($lespakketIds),
                    'invoice_number' => 'INV-' . $faker->unique()->numerify('######'),
                    'datum' => $bookingDate,
                    'status' => $status,
                    'payment_status' => $paymentStatus,
                    'notes' => $faker->optional(0.3)->sentence(),
                    'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-6 months', 'now'),
                ]);
                
            } catch (\Exception $e) {
                $this->command->error('Error creating booking: ' . $e->getMessage());
                // Continue with the next iteration
                continue;
            }
        }
        
        $this->command->info('Bookings created successfully.');
    }
}
