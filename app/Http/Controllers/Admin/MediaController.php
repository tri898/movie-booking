<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Plank\Mediable\Exceptions\MediaUploadException;
use Plank\Mediable\Facades\ImageManipulator;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\Media;

class MediaController extends Controller
{
    const MEDIA_DIRECTORY = 'media';

    /**
     * Render view index.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $medias = Media::with('variants')->whereIsOriginal()
            ->latest()
            ->inDirectory('public', static::MEDIA_DIRECTORY, true)->paginate(20);

        return view('admin.media.index')->with([
            'medias' => $medias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fileName' => 'required|min:1|max:100|',
            'media' => 'required|mimes:jpg,jpeg,png,gif,svg,webp,txt,csv,pdf,mp4|max:5120',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }
        $this->processMedia($request->file('media'), $request->get('fileName'));

        return redirect()->route('cms.media.index')->with([
            'message' => 'Upload media successfully.',
        ]);
    }

    /**
     * Upload multiple media file.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request)
    {
        $mediaFiles = !is_array($request->file('media'))
            ? [$request->file('media')] : $request->file('media');
        $processedMedia = [];
        foreach ($mediaFiles as $mediaFile) {
            $processedMedia[] = $this->processMedia($mediaFile);
        }

        return response()->json(implode(',', $processedMedia));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $medias = Media::find($id)
            ->getAllVariantsAndSelf();
        foreach ($medias as $media) {
            $media->delete();
        }

        return redirect()->route('cms.media.index')->with([
            'message' => "Delete media " . ($medias['original'])->basename . " successfully.",
        ]);
    }

    /**
     * Process media file.
     *
     * @param $mediaFile
     * @param string|null $fileName
     * @return int|string|null
     */
    public function processMedia($mediaFile, string $fileName = null): int|string|null
    {
        try {
            $directory = static::MEDIA_DIRECTORY . "/" . date('m') . "-" . date('Y');
            $media = MediaUploader::fromSource($mediaFile)
                ->toDirectory($directory);
            if ($fileName) {
                $media->useFilename($fileName);
            }
            $mediaUploaded = $media->upload();
            if ($mediaUploaded->aggregate_type == Media::TYPE_IMAGE) {
                ImageManipulator::createImageVariant($mediaUploaded,
                    'thumbnail', true);
            }
            return $mediaUploaded->id;
        } catch (MediaUploadException $e) {
            return null;
        }
    }

    /**
     * Render media as response.
     *
     * @param $id
     * @return Response
     */
    public function render($id): Response
    {
        $media = Media::find($id);
        if (
            is_null($media) ||
            !$media->isPubliclyAccessible() ||
            !$media->fileExists()
        ) {
            abort(404);
        }
        $response = new Response($media->contents(), 200);
        $response->header("Content-Type", $media->mime_type);

        return $response;
    }
}
