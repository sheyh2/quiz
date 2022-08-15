<?php

namespace App\Http\Controllers\Web\Science;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Science;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as ValidatorFacades;
use RuntimeException;

class FileController extends Controller
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
                'file' => 'required',
            ],
            [
                'file.required' => 'Файл не выбрано',
            ]
        );
    }

    public function index(Request $request, string $slug)
    {
        try {
            $science = (new Science())->getBySlug($slug);

            return view('science.file.index', compact('science'));
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function create(Request $request, string $slug)
    {
        try {
            $science = (new Science())->getBySlug($slug);

            return view('science.file.create', compact('science'));
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function store(Request $request, string $slug)
    {
        try {
            $validator = $this->validator($request);

            if ($validator->fails()) {
                throw new RuntimeException($validator->errors()->first());
            }

            $science = (new Science())->getBySlug($slug);
            $uploadFile = $request->file('file');
            dd($uploadFile, $request->all());
            DB::transaction(function () use ($science, $uploadFile) {
                /** @var File $file */
                $file = File::query()->create([
                    'fileable_id'   => $science->getId(),
                    'fileable_type' => get_class($science),
                    'name'          => uniqid(),
                    'path'          => 'assets/files',
                    'ext'           => $uploadFile->getClientOriginalExtension()
                ]);

                $uploadFile->move(
                    $file->getPublicPath(),
                    $file->getName() . '.' . $file->getExt()
                );
            });

            DB::commit();

            return redirect()->route('science.file.index', ['slug' => $slug])
                ->with('success', 'Успешно добавлен');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->route('science.file.create', ['slug' => $slug])
                ->withErrors($exception->getMessage());
        }
    }
}
