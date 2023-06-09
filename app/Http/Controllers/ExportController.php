
<?php
/*
namespace App\Http\Controllers;

use App\Models\User;
use Excel;

class ExportController extends Controller
{
    public function exportToExcel()
    {
        $users = User::all();

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'Name' => $user->name,
                'Email' => $user->email,
            ];
        }

        return Excel::download(function ($excel) use ($data) {
            $excel->setTitle('Users');
            $excel->sheet('Sheet 1', function ($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A1', false, false);
            });
        }, 'users.xlsx');
    }
}
*/
