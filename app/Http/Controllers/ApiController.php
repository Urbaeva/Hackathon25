<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function getData(Request $request)
    {
        $url = 'https://www2.daad.de/deutschland/studienangebote/international-programmes/api/solr/en/search.json';

        $params = [
            'degree[]' => 2,
            'cert' => $request->get('cert'),
            'admReq' => $request->get('admReq'),
            'langExamPC' => $request->get('langExamPC'),
            'scholarshipLC' => $request->get('scholarshipLC'),
            'langExamLC' => $request->get('langExamLC'),
            'scholarshipSC' => $request->get('scholarshipSC'),
            'langExamSC' => $request->get('langExamSC'),
            'degree' => $request->get('degree'),
            'fos' => $request->get('fos'),
            'langDeAvailable' => $request->get('langDeAvailable'),
            'langEnAvailable' => $request->get('langEnAvailable'),
            'ins' => $request->get('ins'),
            'fee' => $request->get('fee'),
            'sort' => $request->get('sort'),
            'dur' => $request->get('dur'),
            'q' => $request->get('q'),
            'limit' => $request->get('limit', 10), // Значение по умолчанию 10
            'offset' => $request->get('offset', 0),
            'display' => $request->get('display'),
            'isElearning' => $request->get('isElearning'),
            'isSep' => $request->get('isSep'),
            ];

        $response = Http::get($url, $params);

        if ($response->successful()) {
            $data = $response->json();

            return response()->json([
                'courses_count' => isset($data['courses']) ? count($data['courses']) : 0,
                'data' => $data,
            ]);
        } else {
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }
    }

    public function filterFromDB(Request $request)
    {
        // Получаем курсы из базы с учетом фильтров
        $query = DB::table('courses');

        if ($request->has('gpa')) {
            $query->where('gpa', '>=', $request->get('gpa'));
        }

        if ($request->has('toefl')) {
            $query->where('toefl', '>=', $request->get('toefl'));
        }

        if ($request->has('ielts')) {
            $query->where('ielts', '>=', $request->get('ielts'));
        }

        if ($request->has('gre')) {
            $query->where('gre', $request->get('gre'));
        }

        if ($request->has('gmat')) {
            $query->where('gmat', $request->get('gmat'));
        }

        if ($request->has('combined_degree')) {
            $query->where('combined_degree', $request->get('combined_degree'));
        }

        if ($request->has('join_degree')) {
            $query->where('join_degree', $request->get('join_degree'));
        }

        if ($request->has('deadline')) {
            $query->where('deadline', '<=', $request->get('deadline'));
        }

        if ($request->has('language_level')) {
            $query->where('language_level', 'LIKE', '%' . $request->get('language_level') . '%');
        }

        if ($request->has('type_of_appliance')) {
            $query->where('type_of_appliance', 'LIKE', '%' . $request->get('type_of_appliance') . '%');
        }

        if ($request->has('academic_standardized_tests')) {
            $query->where('academic_standardized_tests', 'LIKE', '%' . $request->get('academic_standardized_tests') . '%');
        }

        if ($request->has('institution_link')) {
            $query->where('institution_link', 'LIKE', '%' . $request->get('institution_link') . '%');
        }

        $dbCourses = $query->get()->pluck('course_id_from_site')->toArray(); // Получаем ID курсов из базы

        // Вызываем getData, чтобы получить курсы с API
        $apiResponse = $this->getData($request);
        $apiData = json_decode($apiResponse->getContent(), true);

        if (!isset($apiData['data']['courses'])) {
            return response()->json(['error' => 'Ошибка получения данных с API'], 500);
        }

        $apiCourses = $apiData['data']['courses'];

        // Фильтруем только те курсы, которые есть в базе
        $matchedCourses = array_filter($apiCourses, function ($course) use ($dbCourses) {
            return in_array($course['id'], $dbCourses);
        });

        return response()->json([
            'courses_count' => count($matchedCourses),
            'courses' => array_values($matchedCourses),
        ]);
    }


}
