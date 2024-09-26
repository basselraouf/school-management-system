<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repositories\Student\FeeInvoicesRepositoryInterface;
use Illuminate\Http\Request;


class FeeInvoicesController extends Controller
{
    protected $FeeInvoices;

    public function __construct(FeeInvoicesRepositoryInterface $Fees_Invoices)
    {
        $this->FeeInvoices = $Fees_Invoices;
    }

    public function index()
    {
        $data = $this->FeeInvoices->index();
        return view('pages.feeInvoices.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->FeeInvoices->store($request);
    }

    public function show(string $id)
    {
        return $this->FeeInvoices->show($id);
    }

    public function edit(string $id)
    {
        return $this->FeeInvoices->edit($id);
    }

    public function update(Request $request)
    {
        return $this->FeeInvoices->update($request);
    }

    public function destroy(string $id)
    {
        $this->FeeInvoices->destroy( $id);
    }
}
