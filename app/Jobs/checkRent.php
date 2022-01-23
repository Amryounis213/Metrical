<?php

namespace App\Jobs;

use App\Models\Property;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class checkRent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $rent = Rent::where('to', '<=', Carbon::now()->format('Y-m-d H:i'))->where('status', 'active')->get();

        foreach ($rent as $rent) {
            $rent->update([
                'status' => 'finished'
            ]);

            $property = Property::where('id', $rent->property_id)->first();
            $property->update([
                'tenant_id' => null,
            ]);
        }
    }
}
