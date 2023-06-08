<?php

namespace App\Jobs\Card;


use App\Models\Card;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCardJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The payment information for the job.
     *
     * @var Payment
     */
    protected $payment;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Card::query()->create([
            'client_id'   => $this->payment->client_id,
            'activity_id' => $this->payment->activity_id,
            'service_id'  => $this->payment->service_id,
            'payment_id'  => $this->payment->id,
        ]);
    }
}
