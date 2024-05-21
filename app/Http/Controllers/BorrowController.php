<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Office;
use App\Models\Employee;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Excel;
use App\Exports\BorrowedExport;

class BorrowController extends Controller
{

    public function return()
    {
        date_default_timezone_set('Asia/Manila');

        $categories = Category::all();
        $offices = Office::all();
        $employees = Employee::all();

        $page = [
            'name'  =>  'Borrowed', 
            'title' =>  'Borrowed', 
            'crumb' =>  ['Borrowed' => '/borrow/return']
        ];
        
        $borrowedData = Transaction::with(['equipment', 'equipment.category', 'office', 'releaseBy'])
    ->where('status', 'Borrowed')
    ->orWhere('status', 'Late')
    ->orderBy('borrowed_by', 'ASC')
    ->get();

            foreach ($borrowedData as $transaction) {
                $expectedReturnDateTime = $transaction->date_returned ? Carbon::parse($transaction->date_returned) : null;
            
                if ($expectedReturnDateTime && Carbon::now()->greaterThan($expectedReturnDateTime) && $transaction->status !== 'Return') {
                    // Update transaction status to 'Late'
                    $transaction->status = 'Late';
                    $transaction->save();
                } elseif (!$expectedReturnDateTime) {
                    // If expected return date is null, set status back to 'Borrowed'
                    $transaction->status = 'Borrowed';
                    $transaction->save();
                }
            }
            
        return view('equipment.return', compact('page', 'borrowedData', 'categories', 'offices', 'employees'));       
    }

    public function showreturn($id)
{
    $page = [
        'name'  =>  'Return',
        'title' =>  'Return Equipment',
        'crumb' =>  ['Borrowed' => '/borrow/return', 'Return Equipment' => "/borrow/return/{$id}"]
    ];

    $offices = Office::all();
    $employees = Employee::all();

   
    $transaction = Transaction::find($id);

    if ($transaction) {
        return view('equipment.showreturn', compact('transaction', 'page', 'offices', 'employees'));
    }

    
}

    public function updatefile_borrowed(Request $request, string $id){
        
        $transaction = Transaction::findOrFail($id);
    
        $validatedData = $request->validate([
            'upload_file' => 'nullable|file|mimes:jpeg,png,pdf'
        ]);
    
        // file upload
        if ($request->hasFile('upload_file')) {
            $upload_file = $request->file('upload_file');
            
            // Get the original filename
            $fileName = $upload_file->getClientOriginalName();
            
            // Move the uploaded file to the uploads directory with the original filename
            $upload_file->move(public_path('uploads'), $fileName);
    
            // Set file name to the validated data
            $validatedData['upload_file'] = $fileName;
        }
    
        $transaction->update($validatedData);
        
        return redirect()->route('borrow.return', ['id' => $transaction->id])->with('success', 'File updated successfully.');
    
    }

    public function phase(Request $request, string $id)
        {
            $validatedData = $request->validate([
                'returned_date' => 'required|date',
                'returned_by' => 'required|string',
                'received_by' => 'required|string',
            ]);
        
            $validatedData['status'] = 'Return';
            
            $transaction = Transaction::findOrFail($id); 
            $transaction->update($validatedData);
        
            $equipment = Equipment::find($transaction->equipment_id); 
            if ($equipment) {
                $equipment->status = 'Available';
                $equipment->save();
            }
        
            // Return a response indicating success
            return redirect('/borrow/history')->with('success', 'Equipment returned successfully.');
        }

    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }   

    public function downloadBorrowed(Request $request)
{
    $office_filter = $request->input('office_filter');
    $category_filter = $request->input('category_filter');
    $start_date_borrowed = $request->input('start_date_borrowed');
    $end_date_borrowed = $request->input('end_date_borrowed');
    $start_date_return = $request->input('start_date_return');
    $end_date_return = $request->input('end_date_return');

    $endBorrowPlusOneDay = date('Y-m-d', strtotime($end_date_borrowed . ' +1 day'));
    $endReturnPlusOneDay = date('Y-m-d', strtotime($end_date_return . ' +1 day'));

    $query = Transaction::with(['equipment.category', 'office', 'releaseBy'])
        ->where(function ($query) {
            $query->where('status', 'Borrowed')
                  ->orWhere('status', 'Late');
        });

    // Apply filters
    if (!empty($office_filter)) {
        $query->whereHas('office', function ($officeQuery) use ($office_filter) {
            $officeQuery->where('code', $office_filter);
        });
    }

    if (!empty($category_filter)) {
        $query->whereHas('equipment.category', function ($categoryQuery) use ($category_filter) {
            $categoryQuery->where('name', $category_filter);
        });
    }

    if (!empty($start_date_borrowed) && !empty($end_date_borrowed)) {
        $query->whereBetween('date_borrowed', [$start_date_borrowed, $endBorrowPlusOneDay]);
    } elseif (!empty($start_date_borrowed)) {
        $query->where('date_borrowed', '>=', $start_date_borrowed);
    }

    if (!empty($start_date_return) && !empty($end_date_return)) {
        $query->whereBetween('date_returned', [$start_date_return, $endReturnPlusOneDay]);
    } elseif (!empty($start_date_return)) {
        $query->where('date_returned', '>=', $start_date_return);
    }

    // Prepare file name
    $fileName = 'Borrowed_Equipments';

    if (!empty($office_filter)) {
        $fileName .= '_' . $office_filter;
    }
    if (!empty($category_filter)) {
        $fileName .= '_' . $category_filter;
    }
    if (!empty($start_date_borrowed) && !empty($end_date_borrowed)) {
        $fileName .= '_' . $start_date_borrowed . '_to_' . $end_date_borrowed;
    }
    if (!empty($start_date_borrowed) && empty($end_date_borrowed)) {
        $fileName .= '_' . $start_date_borrowed . '_to_present';
    }
    if (!empty($start_date_return) && !empty($end_date_return)) {
        $fileName .= '_' . $start_date_return . '_to_' . $end_date_return;
    }
    if (!empty($start_date_return) && empty($end_date_return)) {
        $fileName .= '_' . $start_date_return . '_to_present';
    }

    $fileName .= '.xlsx';

    $borrowed = $query->get();

    if ($borrowed->isEmpty()) {
        return redirect()->back()->withErrors('No transactions to download.');
    }

    return $this->excel->download(new BorrowedExport($borrowed), $fileName);
}



}
