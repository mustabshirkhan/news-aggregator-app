<?php

namespace App\Repositories\Preferences;

use App\Models\Preference;
use App\Models\User;
class EloquentPreferenceRepository implements PreferenceRepository
{

    public function findByUserId(int $userId): ?Preference
    {

        return Preference::where('user_id', $userId)->first();
        // TODO: Implement findByUserId() method.
    }

    public function save(Preference $preference): Preference
    {
        $preference->save();
        return $preference;
        // TODO: Implement save() method.
    }

    public function getUserPreferences($userId)
    {
        // Retrieve the user preferences from the database based on the $userId
        return User::find($userId)->preferences;
    }
}
