<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class LanguageController extends Controller
{
    /**
     * Get all languages
     *
     * @group Managing Languages
     */
    public function index(): AnonymousResourceCollection
    {
        return LanguageResource::collection(Language::paginate());
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language): LanguageResource
    {
        return new LanguageResource($language);
    }
}
