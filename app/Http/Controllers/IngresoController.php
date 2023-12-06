<?php

namespace App\Http\Controllers;

use App\Ingreso;
use Illuminate\Http\Request;

/**
 * Class IngresoController
 * @package App\Http\Controllers
 */
class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingresos = Ingreso::paginate();

        return view('ingreso.index', compact('ingresos'))
            ->with('i', (request()->input('page', 1) - 1) * $ingresos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingreso = new Ingreso();
        return view('ingreso.create', compact('ingreso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Ingreso::$rules);

        $ingreso = Ingreso::create($request->all());

        return redirect()->route('ingresos.index')
            ->with('success', 'Ingreso created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingreso = Ingreso::find($id);

        return view('ingreso.show', compact('ingreso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingreso = Ingreso::find($id);

        return view('ingreso.edit', compact('ingreso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ingreso $ingreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        request()->validate(Ingreso::$rules);

        $ingreso->update($request->all());

        return redirect()->route('ingresos.index')
            ->with('success', 'Ingreso updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ingreso = Ingreso::find($id)->delete();

        return redirect()->route('ingresos.index')
            ->with('success', 'Ingreso deleted successfully');
    }
}
