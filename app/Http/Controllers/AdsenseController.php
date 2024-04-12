<?php

namespace App\Http\Controllers;

use App\Models\Adsense;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class AdsenseController extends Controller
{
    use UploadTrait;

    public function __construct(private Adsense $adsense)
    {
    }

    public function index()
    {
        return inertia()->render('Adsense/Index', ['adsenses' => $this->adsense->get()]);
    }

    public function create()
    {
        return inertia()->render('Adsense/Create');
    }

    public function store(Request $request)
    {
        $model = $this->adsense->create($request->all());

        $photos = $this->multipleFilesUpload($request->photos, 'adsenses', 'image');

        $model->photos()->createMany($photos);

        return redirect()->route('adsenses.edit', $model);
    }

    public function show(string $id)
    {
        return redirect()->route('adsenses.edit', $id);
    }

    public function edit(string $id)
    {
        $adsense = $this->adsense->findOrFail($id, ['id', 'title', 'description', 'body', 'is_active']);
        return inertia()->render('Adsense/Edit', compact('adsense'));
    }

    public function update(Request $request, string $id)
    {
        $model = $this->adsense->findOrFail($id);

        $model->update($request->except('id'));

        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $adsense = $this->adsense->findOrFail($id);
        $adsense->delete();

        return redirect()->back();
    }
}
