<?php

namespace App\Repositories\Preferences;
use App\Models\Preference;
interface PreferenceRepository
{
    public function findByUserId(int $userId): ?Preference;
    public function save(Preference $preference): Preference;
    public function getUserPreferences($userId);

}
