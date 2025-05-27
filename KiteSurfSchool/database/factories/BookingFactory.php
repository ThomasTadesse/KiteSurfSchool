<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Lespakket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bookingDateTime = $this->faker->dateTimeBetween('-6 months', '+1 month');
        
        $statusOptions = ['in behandeling', 'bevestigd', 'geannuleerd'];
        $status = $this->faker->randomElement($statusOptions);
        
        $paymentStatusOptions = ['pending', 'paid', 'refunded'];
        $paymentStatus = $this->faker->randomElement($paymentStatusOptions);
        
        return [
            'user_id' => User::factory(),
            'lespakket_id' => Lespakket::factory(),
            'datum' => $bookingDateTime,
            'status' => $status,
            'payment_status' => $paymentStatus,
            'notes' => $this->faker->optional(0.7)->sentence(),
            'created_at' => $bookingDateTime,
            'updated_at' => $bookingDateTime,
        ];
    }
    
    /**
     * Indicate that the booking is confirmed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function confirmed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'bevestigd',
            ];
        });
    }
    
    /**
     * Indicate that the booking is pending.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'in behandeling',
            ];
        });
    }
    
    /**
     * Indicate that the booking is cancelled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cancelled()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'geannuleerd',
            ];
        });
    }
    
    /**
     * Indicate that the payment is paid.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function paid()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_status' => 'paid',
            ];
        });
    }
    
    /**
     * Indicate that the payment is refunded.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function refunded()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_status' => 'refunded',
            ];
        });
    }
}
