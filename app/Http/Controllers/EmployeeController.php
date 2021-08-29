<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('layout.app');
    }

    public function employees(Request $request)
    {
        $path = storage_path() . "/employee.json";
        $data = json_decode(file_get_contents($path));

        $filter = [];
        if (isset($request) && $request->sort)
        {
            $filter  = $request->all();
            $data = $this->bubble_sort($data, $request->sort);
        }

        return view('employees', compact('data', 'filter'));
    }

    public function create()
    {
        return view('employee_add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
            'experience' => 'required|numeric',
            'salary' => 'required|numeric'
        ]);

        $path = storage_path() . "/employee.json";

        $data = json_decode(file_get_contents($path));
        $lastId = array_slice($data, -1, 1);

        if ($lastId == null)
        {
            $lastId = 1;
        }
        else
        {
            $lastId = $lastId[0]->id + 1;
        }

        // dd($lastId[0]->id);

        $data[] = array(
            "id" => $lastId,
            "name" => $request->name,
            "email" => $request->email,
            "years_of_exp" => $request->experience,
            "age" => $request->age,
            "salary" => $request->salary
        );

        file_put_contents($path, json_encode($data));

        return redirect()->back()->with('success', 'Employee added successfully!');
    }

    public function edit($id)
    {
        $path   = storage_path() . "/employee.json";
        $array  = json_decode(file_get_contents($path));
        $data   = '';

        foreach ($array as $key => $item)
        {
            if ($item->id == $id)
            {
                $data = array(
                    "id" => $item->id,
                    "name" => $item->name,
                    "email" => $item->email,
                    "years_of_exp" => $item->years_of_exp,
                    "age" => $item->age,
                    "salary" => $item->salary
                );
            }
        }

        return view('employee_edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $path   = storage_path() . "/employee.json";
        $array  = json_decode(file_get_contents($path));

        foreach ($array as $key => $item)
        {
            if ($item->id == $id)
            {
                $item->id           = $request->id;
                $item->name         = $request->name;
                $item->email        = $request->email;
                $item->years_of_exp = $request->experience;
                $item->age          = $request->age;
                $item->salary       = $request->salary;
            }
        }

        $newJsonString = json_encode($array);
        file_put_contents($path, json_encode($array));

        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

    public function delete($id)
    {
        $path   = storage_path() . "/employee.json";
        $array  = json_decode(file_get_contents($path), true);

        foreach ($array as $key => $item)
        {
            if ($item['id'] == $id)
            {
                unset($array[$key]);
            }
        }

        $newJsonString = json_encode($array);
        file_put_contents($path, json_encode($array));

        return redirect()->back()->with('success', 'Employee deleted successfully!');
    }

    public function bubble_sort($arr, $sortType) {
        $size = count($arr)-1;

        if ($sortType == 'age')
        {
            for ($i=0; $i<$size; $i++) {
                for ($j=0; $j<$size-$i; $j++) {
                    $k = $j+1;

                    if ($arr[$k]->age < $arr[$j]->age) {
                        list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                    }
                }
            }
        }
        else
        {
            for ($i=0; $i<$size; $i++) {
                for ($j=0; $j<$size-$i; $j++) {
                    $k = $j+1;

                    if ($arr[$k]->years_of_exp < $arr[$j]->years_of_exp) {
                        list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                    }
                }
            }
        }


        return $arr;
    }

    public function search(Request $request){

        $path = storage_path() . "/employee.json";
        $arary = json_decode(file_get_contents($path));
        $n = sizeof($arary);

        $data = [];

        for($i=0; $i<$n; $i++){
            if ($arary[$i]->age == $request->search || $arary[$i]->years_of_exp == $request->search){
                $data[] = $arary[$i];
            }
        }

        //dd($data);
        return view('employees', compact('data'));
    }
}
