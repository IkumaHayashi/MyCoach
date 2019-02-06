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
    }

}


class TrainingsTableSeeder extends Seeder {

    public function run()
    {

        $TABLE_NAME = 'trainings';

        DB::table($TABLE_NAME)->delete();
        $sql = "ALTER TABLE ".$TABLE_NAME." AUTO_INCREMENT = 1;";
        DB::unprepared($sql);

        DB::table($TABLE_NAME)->insert([
            [
                'title' => 'ストローク５本打ち',
                'duration_minutes' => 20,
                'recomended_person_number' => 8,
                'video_url' => 'https://www.youtube.com/watch?v=3KFp4gqt9wI',
                'user_id' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()

            ],
            [
                'title' => 'サイドボレー',
                'duration_minutes' => 20,
                'recomended_person_number' => 8,
                'video_url' => 'https://www.youtube.com/watch?v=kk8fV9h26SA',
                'user_id' => 2,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()

            ]
        ]);


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
            [ 'name' => 'ストローク' ]
            ,[ 'name' => 'ボレー' ]
            ,[ 'name' => 'サービス' ]
            ,[ 'name' => 'レシーブ' ]
            ,[ 'name' => 'スマッシュ' ]
            ,[ 'name' => 'フォーメーション' ]
            ,[ 'name' => 'シングルス' ]
            ,[ 'name' => 'ウォーミングアップ' ]
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
