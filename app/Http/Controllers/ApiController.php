<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{

    public function getFilteredData(Request $request)
    {
        $url = 'https://www2.daad.de/deutschland/studienangebote/international-programmes/api/solr/en/search.json';

        // Параметры для API (убрали limit и offset)
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
            'display' => $request->get('display'),
            'isElearning' => $request->get('isElearning'),
            'isSep' => $request->get('isSep'),
        ];

        $response = Http::get($url, $params);
        if (!$response->successful()) {
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }
        $apiData = $response->json();
        if (!isset($apiData['courses'])) {
            return response()->json(['error' => 'Invalid API response format'], 500);
        }

        $query = DB::table('courses');

        if ($request->has('grade_system')) {
            $query->where('has_gpa_requirement', true)
                ->where('grade_system', $request->get('grade_system'));
        }

        if ($request->has('gre_score_required')) {
            $query->where('is_gre_required', true)
                ->where('gre_score_required', '<=', $request->get('gre'));
        }

        if ($request->has('winter_deadline')) {
            $query->where('winter_deadline', '>=', $request->get('winter_deadline'));
        }
        if ($request->has('summer_deadline')) {
            $query->where('summer_deadline', '>=', $request->get('summer_deadline'));
        }

        if ($request->has('ielts')) {
            $query->where('ielts', '<=', $request->get('ielts'));
        }
        if ($request->has('toefl_ibt')) {
            $query->where('toefl_ibt', '<=', $request->get('toefl_ibt'));
        }
        if ($request->has('toefl_pbt')) {
            $query->where('toefl_pbt', '<=', $request->get('toefl_pbt'));
        }
        if ($request->has('cefr')) {
            $query->where('cefr', $request->get('cefr'));
        }

        if ($request->has('is_joint_degree')) {
            $query->where('is_joint_degree', $request->get('is_joint_degree'));
        }
        if ($request->has('is_combined_degree')) {
            $query->where('is_combined_degree', $request->get('is_combined_degree'));
        }

        $dbCoursesData = $query->get();
        $dbCourseIds = $dbCoursesData->pluck('course_id_from_site')->toArray();

        $matchedCourses = array_filter($apiData['courses'], function ($course) use ($dbCourseIds) {
            return in_array($course['id'], $dbCourseIds);
        });

        $mergedCourses = [];
        foreach ($matchedCourses as $course) {
            $dbRecord = $dbCoursesData->firstWhere('course_id_from_site', $course['id']);
            if ($dbRecord) {
                $dbRecord = (array)$dbRecord;
                $mergedCourses[] = array_merge($dbRecord, $course);
            } else {
                $mergedCourses[] = $course;
            }
        }

        $page = $request->get('page', 1);
        $perPage = $request->get('per_page', 10);
        $total = count($mergedCourses);
        $offset = ($page - 1) * $perPage;
        $paginatedCourses = array_slice($mergedCourses, $offset, $perPage);

        return response()->json([
            'courses_count' => count($paginatedCourses),
            'courses' => $paginatedCourses,
            'total' => $total,
            'current_page' => $page,
            'per_page' => $perPage,
            'total_pages' => ceil($total / $perPage),
        ]);
    }

    public function getFilteredData1(Request $request)
    {
        $url = 'https://www2.daad.de/deutschland/studienangebote/international-programmes/api/solr/en/search.json';

        // Получаем параметры пагинации
        $page = $request->get('page', 1);
        $perPage = $request->get('per_page', 10);
        $offset = ($page - 1) * $perPage;

        // Параметры для API с учетом пагинации
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
            'limit' => $request->get('limit'),
            'offset' => $request->get('offset'),
            'display' => $request->get('display'),
            'isElearning' => $request->get('isElearning'),
            'isSep' => $request->get('isSep'),
        ];

        // Получаем данные из API
        $response = Http::get($url, $params);
        if (!$response->successful()) {
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }
        $apiData = $response->json();
        if (!isset($apiData['courses'])) {
            return response()->json(['error' => 'Invalid API response format'], 500);
        }

        // Строим запрос к БД с фильтрами
        $query = DB::table('courses');

        // Фильтры по GPA
        if ($request->has('grade_system')) {
            $query->where('has_gpa_requirement', true);
            if ($request->has('grade_system')) {
                $query->where('grade_system', $request->get('grade_system'));
            }
        }

        // Фильтры по GRE
        if ($request->has('gre_score_required')) {
            $query->where('is_gre_required', true)
                ->where('gre_score_required', '<=', $request->get('gre'));
        }

        // Фильтры по дедлайнам
        if ($request->has('winter_deadline')) {
            $query->where('winter_deadline', '>=', $request->get('winter_deadline'));
        }
        if ($request->has('summer_deadline')) {
            $query->where('summer_deadline', '>=', $request->get('summer_deadline'));
        }

        // Фильтры по языковым требованиям
        if ($request->has('ielts')) {
            $query->where('ielts', '<=', $request->get('ielts'));
        }
        if ($request->has('toefl_ibt')) {
            $query->where('toefl_ibt', '<=', $request->get('toefl_ibt'));
        }
        if ($request->has('toefl_pbt')) {
            $query->where('toefl_pbt', '<=', $request->get('toefl_pbt'));
        }
        if ($request->has('cefr')) {
            $query->where('cefr', $request->get('cefr'));
        }

        // Фильтры по типу программы
        if ($request->has('is_joint_degree')) {
            $query->where('is_joint_degree', $request->get('is_joint_degree'));
        }
        if ($request->has('is_combined_degree')) {
            $query->where('is_combined_degree', $request->get('is_combined_degree'));
        }

        // Получаем данные из БД (все поля)
        $dbCoursesData = $query->get();
        // Массив с ID курсов из БД для фильтрации API курсов
        $dbCourseIds = $dbCoursesData->pluck('course_id_from_site')->toArray();

        // Фильтруем курсы из API по наличию их ID в БД
        $matchedCourses = array_filter($apiData['courses'], function ($course) use ($dbCourseIds) {
            return in_array($course['id'], $dbCourseIds);
        });

        // Объединяем данные API с данными из БД по дополнительным полям
        $mergedCourses = [];
        foreach ($matchedCourses as $course) {
            // Ищем запись из БД по course_id_from_site
            $dbRecord = $dbCoursesData->firstWhere('course_id_from_site', $course['id']);
            if ($dbRecord) {
                // Преобразуем объект в массив, если необходимо
                $dbRecord = (array)$dbRecord;
                // Объединяем данные: приоритет у API (если совпадают ключи)
                $mergedCourses[] = array_merge($dbRecord, $course);
            } else {
                $mergedCourses[] = $course;
            }
        }

        // Итоговое количество найденных курсов (после объединения)
        $totalCount = count($mergedCourses);
        $totalPages = ceil($totalCount / $perPage);

        // Формируем метаданные пагинации
        $pagination = [
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $totalCount,
            'total_pages' => $totalPages,
        ];

        // Если необходимо, можно также выполнить "array_slice" для выдачи только текущей страницы:
        $pagedCourses = array_slice($mergedCourses, ($page - 1) * $perPage, $perPage);

        return response()->json([
            'pagination' => $pagination,
            'courses_count' => $totalCount,
            'courses' => array_values($pagedCourses),
            'total' => $apiData['numResults'],
        ]);
    }


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
        $d = DB::table('courses')->where('id', 1)->first();
        $query = DB::table('courses');

        if ($request->has('gpa')) {
            $query->where('gpa', '>=', $request->get('gpa'));
        }
        dd($query->get());

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
