<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class EventsController
 */
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|Collection
     */
    public function index()
    {
        return response()->json(
            \Auth::user()->events()->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validateEvent($request);

        try {
            return response()->json(
                \Auth::user()->events()->create(
                    $request->all([
                        'title',
                        'description',
                        'starts_at',
                        'ends_at',
                    ]))
            );
        } catch (\Throwable $exception) {
            return \Route::respondWithRoute('api.404');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json(
                \Auth::user()->events()->findOrFail($id)
            );
        } catch (\Throwable $exception) {
            return \Route::respondWithRoute('api.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validateEvent($request);

        try {
            return response()->json(
                \Auth::user()->events()->findOrFail($id)->update(
                    $request->all([
                        'title',
                        'description',
                        'starts_at',
                        'ends_at',
                    ]))
            );
        } catch (\Throwable $exception) {
            return \Route::respondWithRoute('api.404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return response()->json(
                \Auth::user()->events()->findOrFail($id)->delete()
            );
        } catch (\Throwable $exception) {
            return \Route::respondWithRoute('api.404');
        }
    }

    /**
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateEvent(Request $request)
    {
        $this->validate($request, [
            'title'       => 'required|max:100',
            'description' => 'max:255',
            'starts_at'   => 'date',
            'ends_at'     => 'date|after:start_date',
        ]);
    }
}
