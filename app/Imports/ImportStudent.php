<?php

namespace App\Imports;
use Session;
use App\tblstudent;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ImportStudent implements ToModel,WithValidation,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new tblstudent([
            //
            
            'senrl'     =>@$row['enrollment_no'],
            'sname'     =>@$row['name'],
            'clgcode'   =>@Session::get('aclgcode'),
            'dob'       =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(@$row['birth_date'])->format('Y-m-d'),
            'class'     =>@$row['class'],
            'rno'       =>@$row['rollno'],
            'division'  =>@$row['division'],
            'email'     =>@$row['email'],
            'mobile'    =>@$row['mobile_no'],
            'address'   =>@$row['adderess'],
            'gender'    =>@$row['gender'],
        ]);
        
        
    }
    public function rules(): array
    {
        // $class=@$row[4];
        return [
            // '*' =>'Required',
            'enrollment_no'=>'unique:tblstudent,senrl|min:15|max:15',
            'email'=>'unique:tblstudent,email|email',
            'name'=>'required',
            'birth_date'=>'required',
            'class'=>'required',
            'rollno'=>'required',
            'mobile_no'=>'unique:tblstudent,mobile|required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'division'=>'required',
            'adderess'=>'required|min:10',
            'gender'=>Rule::in(['male', 'female']),
        ];
    }
}
