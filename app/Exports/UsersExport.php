<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    public function headings(): array
    {
        return[
            'id',
            'name',
            'phone',
            'email',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // dd($this->request);
        $users = $this->request;
        $output[] = [
            $users->id,
            $users->name,
            $users->phone,
            $users->email
        ];
        // dd($output);
        // dd($users);

        return collect($output);
    }
}
