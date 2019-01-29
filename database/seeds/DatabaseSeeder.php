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
