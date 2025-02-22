<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportJsonData extends Command
{
    protected $signature = 'import:json';
    protected $description = 'Импорт данных из JSON в базу данных';

    public function handle()
    {
        $path = storage_path('app/public/programmes.json');
        if (!file_exists($path)) {
            $this->error('Файл не найден!');
            return;
        }

        $json = file_get_contents($path);
        $data = json_decode($json, true);

        if (!$data) {
            $this->error('Ошибка в JSON-файле!');
            return;
        }

        foreach ($data as $item) {
            // Проверка и вставка языка
            $languageID = null;
            if (!empty($item['analyzed'])) {
                $languageName = implode(', ', $item['languages']); // API отдает массив, преобразуем в строку
                $languageID = DB::table('languages')->where('name', $languageName)->value('id');
                if (!$languageID) {
                    $languageID = DB::table('languages')->insertGetId(['name' => $languageName]);
                }
            }

            $typeOfInstitutionID = null;
            if (!empty($item['type_of_institution'])) {
                $typeOfInstitutionID = DB::table('type_of_institutions')->where('name', $item['type_of_institution'])->value('id');
                if (!$typeOfInstitutionID) {
                    $typeOfInstitutionID = DB::table('type_of_institutions')->insertGetId(['name' => $item['type_of_institution']]);
                }
            }

            $cityID = null;
            if (!empty($item['city'])) {
                $cityID = DB::table('cities')->where('name', $item['city'])->value('id');
                if (!$cityID) {
                    $cityID = DB::table('cities')->insertGetId(['name' => $item['city']]);
                }
            }

            $departmentID = null;
            if (!empty($item['name'])) {
                $departmentID = DB::table('departments')->where('name', $item['name'])->value('id');
                if (!$departmentID) {
                    $departmentID = DB::table('departments')->insertGetId(['name' => $item['name']]);
                }
            }

            $locationID = null;
            if (!empty($item['location'])) {
                $locationID = DB::table('locations')->where('name', $item['location'])->value('id');
                if (!$locationID) {
                    $locationID = DB::table('locations')->insertGetId(['name' => $item['location']]);
                }
            }

            $modeOfStudyID = null;
            if (!empty($item['mode_of_study'])) {
                $modeOfStudyID = DB::table('mode_of_study')->where('name', $item['mode_of_study'])->value('id');
                if (!$modeOfStudyID) {
                    $modeOfStudyID = DB::table('mode_of_study')->insertGetId(['name' => $item['mode_of_study']]);
                }
            }

            if (!empty($item['institution'])) {
                DB::table('institution')->updateOrInsert(
                    ['name' => $item['institution'], 'type_of_institution_id' => $typeOfInstitutionID, 'city_id' => $cityID],
                    ['name' => $item['institution']]
                );
            }
            // Вставка данных в таблицу programmes
            DB::table('programmes')->updateOrInsert(
                ['title' => $item['title'], 'short_title' => $item['short_title'], 'department_id' => $departmentID],
                [
                    'description' => $item['description'],
//                    'fields_of_study_id' => $typeOfStudyID,
                    'language_id' => $languageID,
                    'mode_of_study_id' => $modeOfStudyID,
                    'duration' => $item['duration'],
                    'tuition_fee' => $item['tuition_fee'],
                    'start_date' => $item['start_date'],
                    'application_deadline' => $item['application_deadline'],
                    'location_id' => $locationID,
                    'combined_degree' => $item['combined_degree'],
                    'joint_degree' => $item['joint_degree'],
                    'institution_page_link' => $item['institution_page_link'],
                ]
            );
        }

        $this->info('Импорт завершен!');
    }
}
