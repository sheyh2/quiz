<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Science;
use App\Models\Test;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator as ValidatorFacades;

class TestController extends Controller
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
                'science_id' => 'required',
                'question'   => 'required',
            ],
            [
                'science_id.required' => 'Предмет не выбрано',
                'question.required'   => 'Вопрос не введен'
            ]
        );
    }

    // Main

    public function index()
    {
        $sciences = Science::all();

        return view('science.test.index', compact('sciences'));
    }

    public function create()
    {
        $sciences = Science::all();
        $tests = Test::all();

        return view('science.test.create', compact('sciences', 'tests'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            //

            return redirect()->route('science.test.create')
                ->with('success', 'Успешно добавлен');
        } catch (Exception $exception) {
            return redirect()->route('science.test.create')
                ->withErrors($exception->getMessage(), 'error');
        }
    }

    public function question(Request $request)
    {
        $key = base64_encode(\request()->userAgent());
        $tests = Cache::get($key);

        if (is_null($tests)) {
            $tests = Test::query()
                ->where('science_id', '=', $request->query('science_id'))
                ->inRandomOrder()
                ->get();

//            Cache::put($key, $tests, now()->addHour());
        }

//        Cookie::queue('test', 'val', 1);
//        dd(Cookie::get('test'));
//        Cookie::unqueue('test');

        $cookie = \cookie('test', 'val', 1);


        return view('science.test.index', [
            'tests' => $tests
        ]);
    }
}
