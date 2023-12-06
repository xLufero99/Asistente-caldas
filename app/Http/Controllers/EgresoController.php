<?php

namespace App\Http\Controllers;

use App\Egreso;
use Illuminate\Http\Request;

/**
 * Class EgresoController
 * @package App\Http\Controllers
 */
class EgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egresos = Egreso::paginate();

        return view('egreso.index', compact('egresos'))
            ->with('i', (request()->input('page', 1) - 1) * $egresos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $egreso = new Egreso();
        return view('egreso.create', compact('egreso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Egreso::$rules);

        $egreso = Egreso::create($request->all());

        return redirect()->route('egresos.index')
            ->with('success', 'Egreso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $egreso = Egreso::find($id);

        return view('egreso.show', compact('egreso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $egreso = Egreso::find($id);

        return view('egreso.edit', compact('egreso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Egreso $egreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Egreso $egreso)
    {
        request()->validate(Egreso::$rules);

        $egreso->update($request->all());

        return redirect()->route('egresos.index')
            ->with('success', 'Egreso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $egreso = Egreso::find($id)->delete();

        return redirect()->route('egresos.index')
            ->with('success', 'Egreso deleted successfully');
    }
}
