<?php

namespace App\Http\Controllers;

use App\DataTables\ColorDataTable;
use App\Http\Requests\CreateColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Models\Color;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ColorController extends AppBaseController
{
    public function index(ColorDataTable $colorDataTable)
    {
        return $colorDataTable->render('colors.index');
    }

    public function create()
    {
        return view('colors.create');
    }

    public function store(CreateColorRequest $request)
    {
        $input = $request->all();

        Color::create($input);

        Flash::success('Color saved successfully.');

        return redirect(route('colors.index'));
    }

    public function show($id)
    {
        $color = Color::find($id);

        if (empty($color)) {
            Flash::error('Color not found');
            return redirect(route('colors.index'));
        }

        return view('colors.show')->with('color', $color);
    }

    public function edit($id)
    {
        $color = Color::find($id);

        if (empty($color)) {
            Flash::error('Color not found');
            return redirect(route('colors.index'));
        }

        return view('colors.edit')->with('color', $color);
    }

    public function update($id, UpdateColorRequest $request)
    {
        $color = Color::find($id);

        if (empty($color)) {
            Flash::error('Color not found');
            return redirect(route('colors.index'));
        }

        $color->fill($request->all());
        $color->save();

        Flash::success('Color updated successfully.');

        return redirect(route('colors.index'));
    }

    public function destroy($id)
    {
        $color = Color::find($id);

        if (empty($color)) {
            Flash::error('Color not found');
            return redirect(route('colors.index'));
        }

        $color->delete();

        Flash::success('Color deleted successfully.');

        return redirect(route('colors.index'));
    }
}
