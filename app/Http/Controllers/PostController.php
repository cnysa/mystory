<?php

namespace App\Http\Controllers;

use App\Helpers\Cloudinary;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    const CLOUDINARY_FOLDER = 'deep';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('index', compact('posts'));
    }

    /**
     * Display posts with type is video
     *
     * @return Response
     */
    public function indexVideo()
    {
        $posts = Post::where('type', 'video')->latest()->paginate(10);

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->allowActionByQeoQeoUser();

        $validatedData = $request->validate([
            'type' => 'required'
        ]);

        $media = null;
        $resultCloudinary = null;
        if ($request->file('media-image-upload')) {
            $resultCloudinary = app(Cloudinary::class)->upload($request->file('media-image-upload')->getPathname(), self::CLOUDINARY_FOLDER);
        } elseif ($request->get('media-image-url')) {
            $resultCloudinary = app(Cloudinary::class)->upload($request->get('media-image-url'), self::CLOUDINARY_FOLDER);
        } else {
            $media = $request->get('media-video');
        }

        if ($resultCloudinary) {
            $media = $resultCloudinary['secure_url'];
        }

        $result = Post::create([
            'type' => $request->get('type'),
            'content' => $this->replaceWithBrTag($request->get('content')),
            'media' => $media,
            'created_by' => auth()->user()->id
        ]);

        return response()->json([
            'success' => true,
            'data' => $result
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('detail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->allowActionByQeoQeoUser();

        Post::find($id)->update([
            'content' => $this->replaceWithBrTag($request->get('content')),
            'updated_by' => auth()->user()->id
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->allowActionByQeoQeoUser();

        logger()->info('Deep post #' . $id . ' has been deleted by ' . auth()->user()->id);
        Post::destroy($id);

        return response()->redirectTo('/');
    }

    /**
     * Replace character '==' with tag '<br/>' to make a line break in content
     *
     * @param string $content
     * @return string
     */
    private function replaceWithBrTag($content)
    {
        return str_replace('==', '<br/>', $content);
    }

    /**
     * Allow actions by QeoQeo user
     */
    private function allowActionByQeoQeoUser()
    {
        try {
            $this->authorize('actionByQeoQeoUser', auth()->user());
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
