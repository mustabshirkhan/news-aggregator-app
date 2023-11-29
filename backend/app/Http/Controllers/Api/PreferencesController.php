<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PreferencesService;
use Ramsey\Collection\Exception\NoSuchElementException;

class PreferencesController extends Controller
{
    //

    public function __construct(private PreferencesService $preferencesService)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignPreferences(Request $request)
    {
        try {
            // Validate the request data as per your requirements
            $validatedData = $request->validate([
                'preferred_authors.*.id' => 'integer|nullable',
                'preferred_authors.*.name' => 'string|nullable',
                'preferred_sources.*.id' => 'integer|nullable',
                'preferred_sources.*.name' => 'string|nullable',
                'preferred_categories.*.id' => 'integer|nullable',
                'preferred_categories.*.name' => 'string|nullable',
            ]);

            // Get the authenticated user
            $user = $request->user();
            // Call the AssignPreferencesService to assign the preferences
            $this->preferencesService->assignPreferences(
                $user->id,
                isset($validatedData['preferred_authors']) ? $validatedData['preferred_authors'] : [],
                isset($validatedData['preferred_sources']) ? $validatedData['preferred_sources'] : [],
                isset($validatedData['preferred_categories']) ? $validatedData['preferred_categories'] : []
            );

            // Return a success response
            return response()->json([
                'message' => 'Preferences assigned successfully'
            ]);
        } catch (NoSuchElementException $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPreferences(Request $request)
    {
        $user = $request->user();
        $preferences = $this->preferencesService->getPreferencesByUserId($user->id);
        return response()->json(['preferences' => $preferences]);
    }
}
