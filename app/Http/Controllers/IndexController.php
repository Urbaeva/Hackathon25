<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function getDepartments(int $departmentId)
    {
        $programmes = DB::table('programmes')
            ->where('department_id', $departmentId)
            ->get();

        return response()->json($programmes);
    }

    public function getInstitutions(int $institutionId)
    {
        $programmes = DB::table('programmes')
            ->where('institution_id', $institutionId)
            ->get();

        return response()->json($programmes);
    }

    public function getLanguages(int $languageId)
    {
        $programmes = DB::table('programmes')
            ->where('language_id', $languageId)
            ->get();
        dd($programmes);

        return response()->json($programmes);
    }

    public function getModeOfStudy(int $modeId)
    {
        $programmes = DB::table('programmes')
            ->where('mode_of_study_id', $modeId)
            ->get();

        return response()->json($programmes);
    }

    public function getLocations(int $locationId)
    {
        $programmes = DB::table('programmes')
            ->where('location_id', $locationId)
            ->get();

        return response()->json($programmes);
    }

    public function getTypeOfInstitutions(int $typeId)
    {
        $programmes = DB::table('programmes')
            ->where('type_of_institution_id', $typeId)
            ->get();

        return response()->json($programmes);
    }

    public function getProgrammesByLanguageLevel(int $levelId)
    {
        $programmes = DB::table('programmes')
            ->join('programme_language_levels', 'programmes.id', '=', 'programme_language_levels.programme_id')
            ->where('programme_language_levels.language_level_id', $levelId)
            ->get();

        return response()->json($programmes);
    }

    public function getProgrammesByGpa(float $minGpa)
    {
        $programmes = DB::table('programmes')
            ->join('gpa_requirements', 'programmes.id', '=', 'gpa_requirements.programme_id')
            ->where('gpa_requirements.min_gpa', '>=', $minGpa)
            ->get();

        return response()->json($programmes);
    }

    public function getAllProgrammes()
    {
        $programmes = DB::table('programmes')
            ->select('programmes.*',
                'departments.name as department_name',
                'institutions.name as institution_name',
                'fields_of_study.name as field_name',
                'languages.name as language_name',
                'modes_of_study.mode_name',
                'cities.name as city_name',
                'locations.name as location_name',
                'types_of_institutions.type_name')
            ->leftJoin('departments', 'programmes.department_id', '=', 'departments.id')
            ->leftJoin('institutions', 'programmes.institution_id', '=', 'institutions.id')
            ->leftJoin('fields_of_study', 'programmes.field_of_study_id', '=', 'fields_of_study.id')
            ->leftJoin('languages', 'programmes.language_id', '=', 'languages.id')
            ->leftJoin('modes_of_study', 'programmes.mode_of_study_id', '=', 'modes_of_study.id')
            ->leftJoin('cities', 'programmes.city_id', '=', 'cities.id')
            ->leftJoin('locations', 'programmes.location_id', '=', 'locations.id')
            ->leftJoin('types_of_institutions', 'programmes.type_of_institution_id', '=', 'types_of_institutions.id')
            ->get();

        return response()->json($programmes);
    }


    public function index(Request $request)
    {
        $cities = DB::table('cities')->get();
        $fieldOfStudies = DB::table('fields_of_study')->get();
        $courseLanguages = DB::table('languages')->get();
        $modeOfStudy = DB::table('modes_of_study')->get();
        $departments = DB::table('departments')->get();
        $typesOfInstitutions = DB::table('types_of_institutions')->get();
        $institutions = DB::table('institutions')->get();


        return view('index', compact(
            'cities',
            'fieldOfStudies',
            'courseLanguages',
            'modeOfStudy',
            'departments',
            'typesOfInstitutions',
            'institutions',
        ));
    }

    public function meeting()
    {
        $cities = DB::table('cities')->get();
        $fieldOfStudies = DB::table('fields_of_study')->get();
        $courseLanguages = DB::table('languages')->get();
        $modeOfStudy = DB::table('modes_of_study')->get();
        $departments = DB::table('departments')->get();
        $typesOfInstitutions = DB::table('types_of_institutions')->get();
        $institutions = DB::table('institutions')->get();
        $languages = DB::table('languages')->get();


        return view('meeting', compact(
            'cities',
            'fieldOfStudies',
            'courseLanguages',
            'modeOfStudy',
            'departments',
            'typesOfInstitutions',
            'institutions',
            'languages',
        ));
    }

}
