<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PeopleImport;

class DashboardController extends Controller
{
    public function index()
    {
        $filtered_people = [];
        $workbook = Excel::toCollection(new PeopleImport, 'tech-task.xlsx');

        foreach ($workbook as $sheet) {
            foreach ($sheet as $row) {
                $people = $this->parsePersonName(trim($row->first()));

                foreach ($people as $person) {
                    array_push($filtered_people, $person);
                }
            }
        }

        return view('welcome', [
            'people' => $filtered_people,
        ]);
    }

    public function parsePersonName($name)
    {
        $titles = ['Mr', 'Mrs', 'Ms', 'Miss', 'Mister', 'Dr', 'Prof'];

        $people = [];
        $name_parts = preg_split('/\s+(and|&)\s+/i', $name);

        foreach ($name_parts as $part) {
            $name_parts = explode(' ', $part);
            $name1 = null;
            $person = [
                'title' => null,
                'first_name' => null,
                'initial' => null,
                'last_name' => null,
            ];

            if (in_array($name_parts[0], $titles)) {
                $person['title'] = array_shift($name_parts);
            }

            if (!empty($name_parts)) {
                if (preg_match('/^[A-Z]\.?$/', $name_parts[0])) {
                    $person['initial'] = rtrim(array_shift($name_parts), '.');
                } else {
                    $name1 = array_shift($name_parts);
                }
            }

            if (!empty($name_parts)) {
                $person['first_name'] = $name1;
                $person['last_name'] = implode(' ', $name_parts);
            } else {
                $person['last_name'] = $name1;
            }

            $people[] = $person;
        }

        if (count($people) > 1) {
            foreach ($people[0] as $key => $value) {
                if ($value === null && isset($people[1][$key])) {
                    $people[0][$key] = $people[1][$key];
                }
            }
        }
        return $people;
    }
}

