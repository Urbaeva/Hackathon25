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
        $path = public_path('formatted_data.json');
        if (!file_exists($path)) {
            $this->error('Файл не найден!');
            return;
        }

        $json = file_get_contents($path);
        $programmes = json_decode($json, true);

        if (!$programmes) {
            $this->error('Ошибка в JSON-файле!');
            return;
        }


        foreach ($programmes as $programme) {
            DB::table('courses')->insert([
                'course_id_from_site' => $programme['id'],

                // GPA
                'has_gpa_requirement' => $programme['gpa']['has_grade_requirement'],
                'original_grade' => $programme['gpa']['original_grade'],
                'grade_system' => $programme['gpa']['grade_system'],
                'qualitative_grade' => $programme['gpa']['qualitative_grade'],

                // GRE
                'is_gre_required' => $programme['gre']['is_gre_required'],
                'gre_score_required' => $programme['gre']['gre_score_required'],
                'is_gre_optional' => $programme['gre']['is_gre_optional'],

                // Дедлайны
                'winter_deadline' => $programme['deadlines']['winter'] ?? null,
                'summer_deadline' => $programme['deadlines']['summer'] ?? null,
                'additional_deadlines' => json_encode($programme['deadlines']['additional_info']),

                // Языковые требования
                'ielts' => $programme['language']['ielts'],
                'toefl_ibt' => $programme['language']['toefl_ibt'],
                'toefl_pbt' => $programme['language']['toefl_pbt'],
                'cefr' => $programme['language']['cefr'],

                // Информация о программах
                'is_joint_degree' => $programme['is_joint_degree'],
                'is_combined_degree' => $programme['is_combined_degree'],
            ]);
        }

        $this->info('Импорт завершен!');
    }
}
