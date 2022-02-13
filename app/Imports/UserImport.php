<?php

namespace App\Imports;

use App\Models\Owner;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            //  $owner = Owner::where('email', $row['email'])->first();
            $user = User::create([
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'mobile_number' => $row['mobile'],
                'type' => $row['type'],

            ]);

            if ($row['type'] == 1) {
                Owner::create([
                    'user_id' => $user->id,
                    'full_name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $row['email'],
                    'mobile' => $row['mobile'],
                    'emirate_id' => $row['emirate_id'],
                    'community_id' => 1,
                ]);
            } else {
                Tenant::create([
                    'user_id' => $user->id,
                    'full_name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $row['email'],
                    'mobile' => $row['mobile'],
                    'emirate_id' => $row['emirate_id'],
                    'community_id' => 1,
                ]);
            }
        }
    }
}
