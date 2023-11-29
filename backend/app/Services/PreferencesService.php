<?php

namespace App\Services;

use App\Models\Preference;
use App\Repositories\Preferences\EloquentPreferenceRepository as PreferenceRepository;
use App\ValueObjects\Preferences\PreferredAuthor;
use App\ValueObjects\Preferences\PreferredCategories;
use App\ValueObjects\Preferences\PreferredSource;

class PreferencesService
{
    public function __construct(private PreferenceRepository $preferenceRepository)
    {

    }

    public function assignPreferences(int $userId, array $preferredAuthors = [], array $preferredSources = [], array $preferredCategories = []): Preference
    {
        $preference = $this->preferenceRepository->findByUserId($userId);

        if (!$preference) {
            $preference = new Preference(['user_id' => $userId]);
        }

        $preference->preferred_authors = $this->mapPreferredAuthors($preferredAuthors);
        $preference->preferred_sources = $this->mapPreferredSources($preferredSources);
        $preference->preferred_categories = $this->mapPreferredCategories($preferredCategories);

        return $this->preferenceRepository->save($preference);
    }

    private function mapPreferredAuthors(array $authors): array
    {
        return array_map(function ($author) {
            $preferredAuthor = new PreferredAuthor($author['id'], $author['name']);
            return [
                'id'=>$preferredAuthor->getId(),
                'name'=>$preferredAuthor->getName()
            ];
        }, $authors);
    }

    private function mapPreferredSources(array $sources): array
    {
        return array_map(function ($source) {
            $prefferedSource =  new PreferredSource($source['id'], $source['name']);
            return [
                'id'=>$prefferedSource->getId(),
                'name'=>$prefferedSource->getName()
            ];
        }, $sources);
    }
    private function mapPreferredCategories(array $categories): array
    {
        return array_map(function ($category) {
            $prefferedCategory =  new PreferredCategories($category['id'], $category['name']);
            return [
                'id'=>$prefferedCategory->getId(),
                'name'=>$prefferedCategory->getName()
            ];
        }, $categories);
    }

    public function getPreferencesByUserId(int $userId)
    {
        return $this->preferenceRepository->findByUserId($userId);
    }
}
