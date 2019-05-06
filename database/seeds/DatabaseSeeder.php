<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(TrainingsTableSeeder::class);
        $this->call(Tag_TrainingTableSeeder::class);
        $this->call(ProceduresTableSeeder::class);
    }

}

class TagsTableSeeder extends Seeder {

    public function run()
    {

        $TABLE_NAME = 'tags';

        DB::table($TABLE_NAME)->delete();
        $sql = "ALTER TABLE ".$TABLE_NAME." AUTO_INCREMENT = 1;";
        DB::unprepared($sql);

        DB::table($TABLE_NAME)->insert([
            [ 'name' => 'ストローク',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime() ]
            ,[ 'name' => 'ボレー',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime() ]
            ,[ 'name' => 'サービス',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime() ]
            ,[ 'name' => 'レシーブ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime() ]
            ,[ 'name' => 'スマッシュ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime() ]
            ,[ 'name' => 'フォーメーション',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime() ]
            ,[ 'name' => 'シングルス',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime() ]
            ,[ 'name' => 'ウォーミングアップ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime() ]
        ]);


    }

}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $TABLE_NAME = 'users';

        DB::table($TABLE_NAME)->delete();
        $sql = "ALTER TABLE ".$TABLE_NAME." AUTO_INCREMENT = 1;";
        DB::unprepared($sql);

        DB::table($TABLE_NAME)->insert([
            [
                'name' => 'テスト タロウ',
                'email' => 'test01@test.com',
                'password' => Hash::make('test01'),
                'remember_token' => str_random(10)
            ],
            [
                'name' => 'テスト ハナコ',
                'email' => 'test02@test.com',
                'password' => Hash::make('test02'),
                'remember_token' => str_random(10)
            ]
        ]);


    }

}

class Tag_TrainingTableSeeder extends Seeder {

    public function run()
    {
        $TABLE_NAME = 'tag_training';

        DB::table($TABLE_NAME)->delete();
        $sql = "ALTER TABLE ".$TABLE_NAME." AUTO_INCREMENT = 1;";
        DB::unprepared($sql);

        $stroke_training_id = DB::table('trainings')->where('title', 'ストローク５本打ち')->value('id');
        $stroke_tag_id = DB::table('tags')->where('name', 'ストローク')->value('id');

        $volley_training_id = DB::table('trainings')->where('title', 'サイドボレー')->value('id');
        $volley_tag_id = DB::table('tags')->where('name', 'ボレー')->value('id');

        DB::table($TABLE_NAME)->insert([
            [
                'tag_id' => $stroke_tag_id,
                'training_id' => $stroke_training_id,
            ],
            [
                'tag_id' => $volley_tag_id,
                'training_id' => $volley_training_id,
            ]
        ]);


    }

}

class TrainingsTableSeeder extends Seeder {

    public function run()
    {

        $TABLE_NAME = 'trainings';

        DB::table($TABLE_NAME)->delete();
        $sql = "ALTER TABLE ".$TABLE_NAME." AUTO_INCREMENT = 1;";
        DB::unprepared($sql);

        $user_test01 = DB::table('users')->where('email', 'test01@test.com')->value('id');
        $user_test02 = DB::table('users')->where('email', 'test02@test.com')->value('id');

        DB::table($TABLE_NAME)->insert([
            [
                'title' => 'ストローク５本打ち',
                'duration_minutes' => 20,
                'recomended_person_number' => 8,
                'video_url' => 'https://www.youtube.com/watch?v=3KFp4gqt9wI',
                'user_id' => $user_test01,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()

            ],
            [
                'title' => 'サイドボレー',
                'duration_minutes' => 20,
                'recomended_person_number' => 8,
                'video_url' => 'https://www.youtube.com/watch?v=kk8fV9h26SA',
                'user_id' => $user_test02,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()

            ]
        ]);


    }

}

class ProceduresTableSeeder extends Seeder {
    public function run()
    {

        $TABLE_NAME = 'procedures';

        DB::table($TABLE_NAME)->delete();
        $sql = "ALTER TABLE ".$TABLE_NAME." AUTO_INCREMENT = 1;";
        DB::unprepared($sql);

        $stroke_training_id = DB::table('trainings')->where('title', 'ストローク５本打ち')->value('id');
        DB::table($TABLE_NAME)->insert([
            [
                'training_id' => $stroke_training_id,
                'description' => 'テスト1',
                'procedure_data' => '{"lines":
                    [
                        { "id": "line_1", "x1": 10, "y1": 10, "x2": 100, "y2": 100}
                        ,{ "id": "line_2","x1": 10, "y1": 20, "x2": 100, "y2": 200}
                    ],
                    "balls":
                    [
                        { "id": "ball_1", "x": 30, "y": 30}
                        ,{ "id": "ball_2", "x": 60, "y": 60}
                    ]
                }',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'training_id' => $stroke_training_id,
                'description' => 'テスト2',
                'procedure_data' => '{"lines":
                    [
                        { "id": "line_1", "x1": 10, "y1": 10, "x2": 100, "y2": 100}
                        ,{ "id": "line_2","x1": 10, "y1": 20, "x2": 100, "y2": 200}
                    ],
                    "balls":
                    [
                    ]
                }',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
        ]);
    }
}
