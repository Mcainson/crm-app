<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Company::paginate(10), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
    
        $validated = $request->validated();
        $fileName = Str::slug($request->name, '_')  . '_logo.' . $request->logo->extension();
        $validated['logo'] = $fileName;
        $company = Company::create($validated);
        Storage::putFileAs('public', $request->logo, $fileName);
        return response()->json(['data' => $company], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return response()->json(['data' => $company], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validated = $request->validated();

        $company->name = $request->name;
        $company->website = $request->website;       
        $company->email = $request->email;
        
        if ($request->logo) {
            if (Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $fileName = time() . '.' . $request->logo->extension();
            Storage::putFileAs('public', $request->logo, $fileName);
            $company->logo = $fileName;
        }
        $company->save();
        return response()->json(['data' => $company], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company->delete()) {
            if (Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
        }
        return response()->json(['data' => $company], 200);
    }
}
