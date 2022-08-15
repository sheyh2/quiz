<?php

namespace App\Http\Controllers\Web\Science;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Science;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as ValidatorFacades;
use RuntimeException;

class ScienceController extends Controller
{
    // Validator

    /**
     * @param Request $request
     * @return Validator
     */
    protected function validator(Request $request): Validator
    {
        return ValidatorFacades::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Поля названии не введен',
            ]
        );
    }

    // Main

    public function index()
    {
        $sciences = Science::all();

        return view('science.index', compact('sciences'));
    }

    public function create(Request $request)
    {
        return view('science.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validator = $this->validator($request);

            if ($validator->fails()) {
                throw new RuntimeException($validator->errors()->first());
            }

            $data = $validator->validate();

            Science::query()->create([
                'name' => $data['name']
            ]);

            return redirect()->route('science.index')
                ->with('success', 'Успешно');
        } catch (Exception $exception) {
            return redirect()->route('science.create')
                ->withErrors($exception->getMessage(), 'error');
        }
    }
}
