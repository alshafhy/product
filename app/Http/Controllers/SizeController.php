<?php

namespace App\Http\Controllers;

use App\DataTables\SizeDataTable;
use App\Http\Requests\CreateSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SizeController extends AppBaseController
{
    public function index(SizeDataTable $sizeDataTable)
    {
        return $sizeDataTable->render('sizes.index');
    }

    public function create()
    {
        return view('sizes.create');
    }

    public function store(CreateSizeRequest $request)
    {
        $input = $request->all();

        Size::create($input);

        Flash::success('Size saved successfully.');

        return redirect(route('sizes.index'));
    }

    public function show($id)
    {
        $size = Size::find($id);

        if (empty($size)) {
            Flash::error('Size not found');
            return redirect(route('sizes.index'));
        }

        return view('sizes.show')->with('size', $size);
    }

    public function edit($id)
    {
        $size = Size::find($id);

        if (empty($size)) {
            Flash::error('Size not found');
            return redirect(route('sizes.index'));
        }

        return view('sizes.edit')->with('size', $size);
    }

    public function update($id, UpdateSizeRequest $request)
    {
        $size = Size::find($id);

        if (empty($size)) {
            Flash::error('Size not found');
            return redirect(route('sizes.index'));
        }

        $size->fill($request->all());
        $size->save();

        Flash::success('Size updated successfully.');

        return redirect(route('sizes.index'));
    }

    public function destroy($id)
    {
        $size = Size::find($id);

        if (empty($size)) {
            Flash::error('Size not found');
            return redirect(route('sizes.index'));
        }

        $size->delete();

        Flash::success('Size deleted successfully.');

        return redirect(route('sizes.index'));
    }
}
