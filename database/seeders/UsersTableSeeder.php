<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$8oyJg1CQu4nKERaRwuCvaeyFOYS2osQ9IFI1qWp0eBWxMQ9.dlJI.',
                'remember_token' => 'i4GFXIq7n3Kv3pKJFOQspNCqCXjA43MsTAvNqCZwxnuW2CvzOz7etxumYZb2',
                'created_at' => NULL,
                'updated_at' => '2021-10-08 21:42:28',
                'deleted_at' => NULL,
                'bryghia' => 0.0,
                'udid' => 'd536b142-8ca1-4782-ad6d-a7948f516bf1',
                'purchased' => 0,
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'Oliver',
                'email' => 'montor@me.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$pQ9WQgqEIMAZvlIpPrfotuZFWcMcqHDJarE7Qq9ZZkQu2m81JTN.m',
                'remember_token' => NULL,
                'created_at' => '2021-09-13 04:05:52',
                'updated_at' => '2021-09-29 00:07:16',
                'deleted_at' => '2021-09-29 00:07:16',
                'bryghia' => 30.0,
                'udid' => '609722b1-51e2-43b8-8b75-6c1f9e8118cf',
                'purchased' => 0,
            ),
            2 => 
            array (
                'id' => 6,
                'name' => 'Oliver email',
                'email' => 'hello@olivermontor.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$dgQYHGXytR.7mFe.6otG8uLWUcqXdIzh5w65doN19.n/h5NHHEV8y',
                'remember_token' => NULL,
                'created_at' => '2021-09-13 04:49:23',
                'updated_at' => '2021-09-29 22:43:42',
                'deleted_at' => NULL,
                'bryghia' => 52.06,
                'udid' => '35eed9b1-715d-4132-a039-ba61cc433ff1',
                'purchased' => 1,
            ),
            3 => 
            array (
                'id' => 7,
                'name' => 'Simon',
                'email' => 'Vandekerckhove.simon@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$W53FRyrMD7I.nis1GlGdyeg3je0Dm.O0oxoM9PACv49e16A.6KOa6',
                'remember_token' => NULL,
                'created_at' => '2021-09-14 15:09:29',
                'updated_at' => '2021-09-14 15:13:53',
                'deleted_at' => NULL,
                'bryghia' => 100.0,
                'udid' => '931ad46d-170f-405c-bcfe-7fee2da2e73a',
                'purchased' => 0,
            ),
            4 => 
            array (
                'id' => 8,
                'name' => 'Mauricio',
                'email' => 'Arqmau.real@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$zMd0PJCSa3gTvE1JoLSYHuLnBQjlvM.2d9jbENFnFn7ZKNfBi0SBO',
                'remember_token' => NULL,
                'created_at' => '2021-09-14 15:10:41',
                'updated_at' => '2021-09-14 15:13:29',
                'deleted_at' => NULL,
                'bryghia' => 10.0,
                'udid' => '7505c99b-8a57-43e2-a10a-a02977203c88',
                'purchased' => 0,
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'Fly',
                'email' => 'flyflyerson.jp@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$S1UBwfS8aILaECeAAXHRjOADaFjHxBu53e54YfDnBLPTlRnI61cL2',
                'remember_token' => NULL,
                'created_at' => '2021-09-14 21:13:52',
                'updated_at' => '2021-09-14 21:13:57',
                'deleted_at' => NULL,
                'bryghia' => 0.0,
                'udid' => '15ce8632-1034-4f91-8973-392629715db1',
                'purchased' => 0,
            ),
        ));
        
        
    }
}