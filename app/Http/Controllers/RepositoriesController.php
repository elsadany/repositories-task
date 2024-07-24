<?php

namespace App\Http\Controllers;

use App\Exports\RepositoriesExport;
use App\Mail\RepositoriesSearchMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class RepositoriesController extends Controller
{
    protected $languages;
    protected $limits;
    protected $cache_time;

    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->languages = $this->fetchLanguages();
        $this->limits = [10, 50, 100];
        $this->cache_time = 10 * 60;
    }

    public function index()
    {
        $data['languages'] = $this->fetchLanguages();
        $data['limits'] = $this->limits;
        return view('repositories.index', $data);
    }

    function getData(Request $request)
    {
        $cache_key = implode('-', $request->all());
        $parameters = 'q=created:>' . $request->date_from;
        if ($request->language != '') {
            $parameters .= '+' . $request->language;
        }
        $parameters .= '&page=1&per_page=' . $request->limit . '&sort=stars&order=desc';
        $url = 'https://api.github.com/search/repositories?' . $parameters;
        $data['repositories'] = Cache::remember($cache_key, $this->cache_time, function () use ($url) {
            $repositories = Http::get($url)->json();
            $this->sendSearchMail($repositories);
            return $repositories;
        });
        return response()->json(view('repositories._append', $data)->render());

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function fetchLanguages()
    {
        $program_languages_url = 'https://gist.githubusercontent.com/calvinfroedge/defeb8fc6cdc0068e172/raw/7904b2504827f6f4883df0299a2bf51accbe9dab/languages.json';
        $languages = Cache::rememberForever('programming-languages', function () use ($program_languages_url) {
            $response = file_get_contents($program_languages_url);
            $languages = str_replace('"[', '[', $response);
            $languages = str_replace(']"', ']', $languages);
            $languages = json_decode($languages);
            return $languages;
        });
        return $languages;
    }

    function sendSearchMail($repositories)
    {
        $path = $this->exportToFile($repositories);
        try {
            Mail::to(config('app.email'))->send(new RepositoriesSearchMail($path));
        }catch (\Exception $exception){

        }
    }

    function exportToFile($repositories)
    {
        $file_path = 'repositories/' . date('Y-m') . Str::random(19) . time() . '.xlsx';
        Excel::store(new RepositoriesExport($repositories), $file_path, 'public');
        return $file_path;
    }

}
