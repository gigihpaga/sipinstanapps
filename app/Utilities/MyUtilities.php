<?php


namespace App\Utilities;

use Carbon\Carbon;
use Nette\Utils\Strings;
use PhpParser\Node\Stmt\TryCatch;

class MyUtilities
{
    /**
     * Integer to Romawi
     * 
     * >- example: integerToRoman(21); return "XXI"
     * @param  int $angka
     * @return string
     */
    public static function integerToRoman($angka = 1)
    {
        // Convert the integer into an integer (just to make sure)
        $angka = intval($angka);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array(
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1
        );

        foreach ($lookup as $roman => $value) {
            // Determine the number of matches
            $matches = intval($angka / $value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman, $matches);

            // Set the integer to be the remainder of the integer and the value
            $angka = $angka % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }

    /**
     * Romawi to Integer
     * 
     * >- example: romanToInteger("XVI"); return 16
     * @param  string  $stringRoman
     * @return int
     */
    public static function romanToInteger($stringRoman = "I")
    {
        $romans = array(
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1,
        );

        $result = 0;

        foreach ($romans as $key => $value) {
            while (strpos($stringRoman, $key) === 0) {
                $result += $value;
                $stringRoman = substr($stringRoman, strlen($key));
            }
        }
        return $result;
    }

    private static function penyebut($angka = 0)
    {
        $angka = abs($angka);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($angka < 12) {
            $temp = " " . $huruf[$angka];
        } else if ($angka < 20) {
            $temp = self::penyebut($angka - 10) . " belas";
        } else if ($angka < 100) {
            $temp = self::penyebut($angka / 10) . " puluh" . self::penyebut($angka % 10);
        } else if ($angka < 200) {
            $temp = " seratus" . self::penyebut($angka - 100);
        } else if ($angka < 1000) {
            $temp = self::penyebut($angka / 100) . " ratus" . self::penyebut($angka % 100);
        } else if ($angka < 2000) {
            $temp = " seribu" . self::penyebut($angka - 1000);
        } else if ($angka < 1000000) {
            $temp = self::penyebut($angka / 1000) . " ribu" . self::penyebut($angka % 1000);
        } else if ($angka < 1000000000) {
            $temp = self::penyebut($angka / 1000000) . " juta" . self::penyebut($angka % 1000000);
        } else if ($angka < 1000000000000) {
            $temp = self::penyebut($angka / 1000000000) . " milyar" . self::penyebut(fmod($angka, 1000000000));
        } else if ($angka < 1000000000000000) {
            $temp = self::penyebut($angka / 1000000000000) . " trilyun" . self::penyebut(fmod($angka, 1000000000000));
        }
        return $temp;
    }


    /**
     * Number to Terbilang
     * 
     * >- example: terbilang(164); return "Seratus Enam Puluh Empat"
     * 
     * @param  int  $angka
     * @return string
     */
    public static function terbilang($angka = 0)
    {
        if (is_numeric($angka) && $angka < 0) {
            $hasil = "minus " . trim(self::penyebut($angka));
        } else if (is_numeric($angka)) {
            $hasil = trim(self::penyebut($angka));
        } else {
            $hasil = trim(self::penyebut(0));
        }
        return ucwords($hasil);
    }

    /**
     * Format date MySQL to Indonesia
     *
     * >- example: dateMySqlToIndo('2024-10-23'); return "23-10-2024"
     * 
     * parse (yyyy-mm-dd) to (dd-mm-yyyy)
     * @param  string  $dateMySql
     * @return string Date Indonesia 31-12-1000
     */
    public static function dateMySqlToIndo($dateMySql = '1000-12-31')
    {
        try {
            return Carbon::createFromFormat('Y-m-d', $dateMySql ?? '1000-12-31')->format('d-m-Y');
        } catch (\Throwable $th) {
            return Carbon::createFromFormat('Y-m-d',  '1000-12-31')->format('d-m-Y');
        }
    }

    /**
     * Format date Indonesia to MySQL 
     *
     * >- example: dateIndoToMySql('23-10-2024'); return "2024-10-23"
     * 
     * parse (dd-mm-yyyy) to (yyyy-mm-dd)
     * @param  string  $dateIndo
     * @return string Date MySQL 1000-12-31
     */
    public static function dateIndoToMySql($dateIndo = '31-12-1000')
    {
        try {
            return Carbon::createFromFormat('d-m-Y', $dateIndo ?? '31-12-1000')->format('Y-m-d');
        } catch (\Throwable $th) {
            return Carbon::createFromFormat('d-m-Y',  '31-12-1000')->format('Y-m-d');
        }
    }
}
