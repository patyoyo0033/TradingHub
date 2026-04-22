<?php

namespace App\Services;

use App\Models\Knowledge;
use Illuminate\Support\Facades\Storage;

class KnowledgeService
{
    /**
     * Store a new knowledge entry.
     */
    public function storeKnowledge(array $data, int $userId, $imageFile = null): Knowledge
    {
        $data['user_id'] = $userId;

        // Handle tags string to array
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = array_filter(array_map('trim', explode(',', $data['tags'])));
        } else {
            $data['tags'] = [];
        }

        if ($imageFile) {
            $data['image_path'] = $imageFile->store('knowledges', 'public');
        }

        return Knowledge::create($data);
    }

    /**
     * Update an existing knowledge entry.
     */
    public function updateKnowledge(Knowledge $knowledge, array $data, $imageFile = null): Knowledge
    {
        // Handle tags string to array
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = array_filter(array_map('trim', explode(',', $data['tags'])));
        } else {
            $data['tags'] = [];
        }

        if ($imageFile) {
            if ($knowledge->image_path) {
                Storage::disk('public')->delete($knowledge->image_path);
            }
            $data['image_path'] = $imageFile->store('knowledges', 'public');
        }

        $knowledge->update($data);

        return $knowledge;
    }

    /**
     * Delete a knowledge entry and its associated image.
     */
    public function deleteKnowledge(Knowledge $knowledge): void
    {
        if ($knowledge->image_path) {
            Storage::disk('public')->delete($knowledge->image_path);
        }

        $knowledge->delete();
    }
}
