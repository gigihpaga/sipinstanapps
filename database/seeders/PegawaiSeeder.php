<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dataPegawai = [
            ['nama' => 'ARI WIDYATMOKO, SE., CGCAE.', 'nip' => '196509041986031001',],
            ['nama' => 'IMAM FAUZI, ST', 'nip' => '197206161998031011',],
            ['nama' => 'HUFRON, SE', 'nip' => '196704241994031018',],
            ['nama' => 'IKA HARININGSIH HARAHAP, SH', 'nip' => '197106251998032006',],
            ['nama' => 'JOKO WITONO, SE', 'nip' => '196609051994031010',],
            ['nama' => 'ANDY FERIYANTO, SH', 'nip' => '197502272002121007',],
            ['nama' => 'YUNIANI, SE', 'nip' => '197003152002122007',],
            ['nama' => 'YULI PURNOMO, SE', 'nip' => '197607142010011011',],
            ['nama' => 'ANDHI KUSMAWAN, SE', 'nip' => '197803302002121009',],
            ['nama' => 'FATMA ARIANA, ST', 'nip' => '198201282006042016',],
            ['nama' => 'SUPRIYANTINI, S.Sos', 'nip' => '197409282006042016',],
            ['nama' => 'NURUL KOTIMAH, S.Kom', 'nip' => '197212151994032004',],
            ['nama' => 'YUSUF KUNTIOAJI, M.T.', 'nip' => '198607202011011011',],
            ['nama' => 'ARBA\'IN AGUS WIJAYA, SE', 'nip' => '198408162010011020',],
            ['nama' => 'SRI REJEKI, SE', 'nip' => '198203222010012022',],
            ['nama' => 'RINA KUSUMANINGTYAS, S.Psi', 'nip' => '198109292006042033',],
            ['nama' => 'HERMAN SUSILO, SE', 'nip' => '197411032010011003',],
            ['nama' => 'TRIANA MART SANTI, SE', 'nip' => '198403032010012027',],
            ['nama' => 'LAVA SEJAHTERA MEGANTORO, ST', 'nip' => '197905152011011012',],
            ['nama' => 'MUCHAMAD SAHID, ST', 'nip' => '197809132010011012',],
            ['nama' => 'JUJUK WIDYASAPUTRA, S.IP', 'nip' => '197608132003121006',],
            ['nama' => 'LUKY RIANA WINDRADINI, SE', 'nip' => '198106272010012027',],
            ['nama' => 'FAHRIZAL SAPUTRA, SE', 'nip' => '198004012011011008',],
            ['nama' => 'YUANITA INTAN DEWI, SE', 'nip' => '197906062011012007',],
            ['nama' => 'ERLINA WIDYA ASTUTI, SE', 'nip' => '198304082011012011',],
            ['nama' => 'BAMBANG SETYANA, SE', 'nip' => '197505122003121006',],
            ['nama' => 'ULUL YULIANTO, ST', 'nip' => '197504072002121008',],
            ['nama' => 'SUBROTO, S.Sos', 'nip' => '197907112002121006',],
            ['nama' => 'FREDI AFIAWAN, S.H.', 'nip' => '198607252019021001',],
            ['nama' => 'AISYAH NUR HANIFAH, S.T.', 'nip' => '199411122019022006',],
            ['nama' => 'ANDRI WIDIYANTO, S.IP.', 'nip' => '199311222019021003',],
            ['nama' => 'ARLITA DIAN PRATIWI, S.IP.', 'nip' => '199504042019022007',],
            ['nama' => 'DIO AMALI SUKMA, S.M.', 'nip' => '199409162019021002',],
            ['nama' => 'HALIM PRASETYO HUTOMO, S.T.', 'nip' => '199302032019021001',],
            ['nama' => 'MUTIARA DINI SARAHATI, S.H.', 'nip' => '199305182019022003',],
            ['nama' => 'RETNO WIDOWATI, S.T.', 'nip' => '199308212019022006',],
            ['nama' => 'ROSIDAH KURNIAWATI, S.A.', 'nip' => '199006072019022002',],
            ['nama' => 'STEVANUS EKA KRISTIAWAN, S.H.', 'nip' => '198809162019021001',],
            ['nama' => 'YOHANES DESKA HANDIKA CHRISTIANTO, S.E.', 'nip' => '198612172019021004',],
            ['nama' => 'YUSUP SETYADI, S.E.', 'nip' => '199010032020121003',],
            ['nama' => 'JANUAR ERFAN BAIKHUNI, S.Ak.', 'nip' => '199601072020121003',],
            ['nama' => 'RIZA HABIBIE, S.T.', 'nip' => '199703032022031005',],
            ['nama' => 'RICKY HANDOKO, S.E.', 'nip' => '199503262022031003',],
            ['nama' => 'DONNA DESIANA, S.E.', 'nip' => '199012162022032003',],
            ['nama' => 'DANANG EKO PRASTYA, S.IP.', 'nip' => '199407262022031002',],
            ['nama' => 'RISKA MELINDA HUTARI, S.IP.', 'nip' => '199306182022032003',],
            ['nama' => 'SULASIH', 'nip' => '197108231999032005',],
            ['nama' => 'SRI UMIATI', 'nip' => '197202182014072001',],

        ];

        // data jabatan sebanya 21
        // data pangkat_golongan sebanya 9
        // data kelas_perjadin sebanya 3

        foreach ($dataPegawai as $pegawai) {
            $jabatan = fake()->numberBetween(1, 21);
            $pangkatGolongan = fake()->numberBetween(1, 9);
            $kelasPerjadin = fake()->numberBetween(1, 3);
            Pegawai::create(array_merge( // 1
                $pegawai,
                [
                    'jabatan_id' => $jabatan,
                    'pangkat_golongan_id' => $pangkatGolongan,
                    'kelas_perjadin_id' => $kelasPerjadin,
                ],
            ));
        }
    }
}
