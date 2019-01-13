<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Libraries\ResourceLoader;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{

    /**
     * Resource Loader class
     *
     * @var ResourceLoader
     */
    protected $rl;

    /**
     * Constructor.
     */
    public function __construct(ResourceLoader $rl)
    {
        $this->rl = $rl;
    }

    /**
     * Web page with resources information
     * 
     * @return void
     */
    public function index()
    {
        $resources = Resource::all();
        return view('resources', compact('resources'));
    }

    /**
     * Web page to add new resource
     * 
     * @return void
     */
    public function add()
    {
        return view('new');
    }

    /**
     * API method to get all resources
     * 
     * @return void
     */
    public function getResources()
    {
        $resources = Resource::all();
        return view('resources', compact('resources'));
    }

    /**
     * API method to add job to queue
     *
     * @return mixed
     */
    public function job(ResourceRequest $request)
    {
        $ref = $request->headers->get('referer');
        $prepareJob = $this->rl->dispatchJob($request->get('url'));

        if ($prepareJob === true) {
            if ($ref === null) {
                return response()->json(['success' => true]);
            }

            return redirect()->route('resource.list');
        }

        if ($ref === null) {
            return response()->json(['success' => false, 'message' => $prepareJob], 500);
        }

        return redirect($ref);
    }

    /**
     * API method to download resource
     *
     * @param int $id Resource model ID
     * 
     * @return mixed
     */
    public function download(int $id)
    {
        $resource = Resource::findOrFail($id);

        if ($resource->filename !== null && Storage::exists($resource->filename)) {
            return Storage::download($resource->filename);
        }

        return 'Resource doesn\'t exists!';
    }

}
