<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeRequest;
use App\Repositories\Student\FeesRepositoryInterface;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    protected $Fees;

    public function __construct(FeesRepositoryInterface $Fees)
    {
        $this->Fees = $Fees;
    }
    public function index()
    {
        $data = $this->Fees->getAllGrades();
        return view('pages.fees.index', compact('data'));
    }

    public function create()
    {
        $data = $this->Fees->getAllGrades();
        return view('pages.fees.add-fees', compact('data'));
    }

    public function store(StoreFeeRequest $request)
    {
        $this->Fees->storeNewFee($request->validated());

        return redirect()->route('fees.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = $this->Fees->getSpecificFee($id);
        return view('pages.fees.edit-fees', compact('data'));
    }

    public function update(StoreFeeRequest $request, string $id)
    {
        $this->Fees->updateNewFee($request->validated(), $id);
        return redirect()->route('fees.index');
    }

    public function destroy(string $id)
    {
        $this->Fees->destroyFee($id);
        return redirect()->back();
    }
}
