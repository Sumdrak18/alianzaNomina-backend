<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::with('cargos', 'jefe')->paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::all();
        $jefes = Empleado::all();
        return view('empleados.create', compact('cargos', 'jefes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'identificacion' => 'required|unique:empleados',
            'pais_nacimiento' => 'required',
            'ciudad_nacimiento' => 'required',
        ]);

        if ($request->cargos && in_array(1, $request->cargos)) {
            $request->merge(['jefe_id' => null]);
        }

        $empleado = Empleado::create($request->all());
        $empleado->cargos()->sync($request->cargos);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $cargos = Cargo::all();
        $jefes = Empleado::all();
        return view('empleados.edit', compact('empleado', 'cargos', 'jefes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        if ($request->cargos && in_array(1, $request->cargos)) {
            $empleado->jefe_id = null;
        }

        if ($request->jefe_id == $empleado->id) {
            return back()->withErrors(['jefe_id' => 'Un empleado no puede ser su propio jefe.']);
        }

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'pais_nacimiento' => 'required',
            'ciudad_nacimiento' => 'required',
        ]);

        $empleado->update($request->all());
        $empleado->cargos()->sync($request->cargos);

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado.');
    }
}
