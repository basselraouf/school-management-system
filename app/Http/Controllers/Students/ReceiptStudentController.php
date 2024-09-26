<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repositories\Student\ReceiptStudentsRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{
    protected $Receipt;

    public function __construct(ReceiptStudentsRepositoryInterface $Receipt)
    {
        $this->Receipt = $Receipt;
    }

    public function index()
    {
        $receipt_students = $this->Receipt->index();

        return view('pages.receipt.index-receipt',compact('receipt_students'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->Receipt->store($request);
        return redirect()->route('receipts.index');
    }

    public function show(string $id)
    {
        $student = $this->Receipt->show($id);
        return view('pages.receipt.add-receipt',compact('student'));
    }

    public function edit(string $id)
    {
        $receipt_student = $this->Receipt->edit($id);
        return view('pages.receipt.edit-receipt',compact('receipt_student'));
    }

    public function update(Request $request, string $id)
    {
        $this->Receipt->update($request);
        return redirect()->route('receipts.index');
    }

    public function destroy($id)
    {
        $this->Receipt->destroy($id);
        // dd($id);
        return redirect()->back();
    }
}
