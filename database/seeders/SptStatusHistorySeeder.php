<?php

namespace Database\Seeders;

use App\Models\SptStatusHistory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SptStatusHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // spt 1
        SptStatusHistory::create([
            'spt_id' => 1,
            'status' => 1, // created
            'keterangan' => '',
            'created_by' => 2, //user_id
            'updated_by' => 2, //user_id
            'created_at' => Carbon::now()->addDays(1),
            'updated_at' =>  Carbon::now()->addDays(1),
        ]);
        SptStatusHistory::create([
            'spt_id' => 1,
            'status' => 2, // revision
            'keterangan' => 'perlu diperbaiki untuk kerangan pada point 2',
            'created_by' => 4, //user_id
            'updated_by' => 4, //user_id
            'created_at' => Carbon::now()->addDays(3),
            'updated_at' =>  Carbon::now()->addDays(3),
        ]);
        SptStatusHistory::create([
            'spt_id' => 1,
            'status' => 3, // updated
            'keterangan' => 'untuk keterangan 2 sudah di perbaiki',
            'created_by' => 2, //user_id
            'updated_by' => 2, //user_id
            'created_at' => Carbon::now()->addDays(6),
            'updated_at' =>  Carbon::now()->addDays(6),
        ]);
        SptStatusHistory::create([
            'spt_id' => 1,
            'status' => 4, // verified
            'keterangan' => '',
            'created_by' => 4, //user_id
            'updated_by' => 4, //user_id
            'created_at' => Carbon::now()->addDays(8),
            'updated_at' =>  Carbon::now()->addDays(8),
        ]);
        SptStatusHistory::create([
            'spt_id' => 1,
            'status' => 5, // rejected
            'keterangan' => 'perlu menambah anggota baru, agar pekerjaan cepat selesai',
            'created_by' => 6, //user_id
            'updated_by' => 6, //user_id
            'created_at' => Carbon::now()->addDays(10),
            'updated_at' =>  Carbon::now()->addDays(10),
        ]);
        SptStatusHistory::create([
            'spt_id' => 1,
            'status' => 3, // updated
            'keterangan' => 'angkota sudah ditambah 2 orang',
            'created_by' => 2, //user_id
            'updated_by' => 2, //user_id
            'created_at' => Carbon::now()->addDays(12),
            'updated_at' =>  Carbon::now()->addDays(12),
        ]);
        SptStatusHistory::create([
            'spt_id' => 1,
            'status' => 4, // verified
            'keterangan' => '',
            'created_by' => 4, //user_id
            'updated_by' => 4, //user_id
            'created_at' => Carbon::now()->addDays(18),
            'updated_at' =>  Carbon::now()->addDays(18),
        ]);
        SptStatusHistory::create([
            'spt_id' => 1,
            'status' => 6, // approved
            'keterangan' => '',
            'created_by' => 6, //user_id
            'updated_by' => 6, //user_id
            'created_at' => Carbon::now()->addDays(21),
            'updated_at' =>  Carbon::now()->addDays(21),
        ]);

        // spt 2
        SptStatusHistory::create([
            'spt_id' => 2,
            'status' => 3, // created
            'keterangan' => '',
            'created_by' => 3, //user_id
            'updated_by' => 3, //user_id
            'created_at' => Carbon::now()->addDays(2),
            'updated_at' =>  Carbon::now()->addDays(2),
        ]);
        SptStatusHistory::create([
            'spt_id' => 2,
            'status' => 2, // revision
            'keterangan' => 'lampirannya kurang',
            'created_by' => 4, //user_id
            'updated_by' => 4, //user_id
            'created_at' => Carbon::now()->addDays(5),
            'updated_at' =>  Carbon::now()->addDays(5),
        ]);
    }
}
