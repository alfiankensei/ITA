<?php

namespace App\Exports;

use App\Models\Page;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class ExportLalin2 implements FromCollection, WithColumnWidths, WithEvents, WithStyles, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;
    protected $params;
    public function __construct($params)
    {
        $params = json_decode($params);
        $this->region = $params->region;
        $this->lokasi = $params->lokasi;
        $this->tanggalawal = $params->tanggalawal;
        $this->tanggalakhir = $params->tanggalakhir;
    }
    public function columnWidths(): array
    {
        return ['A' => 20, 'B' => 20, 'C' => 10, 'D' => 10, 'E' => 10, 'F' => 10, 'G' => 10, 'H' => 10, 'I' => 10, 'J' => 10, 'K' => 10, 'L' => 10];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 16]],
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Sheet $sheet */
                $lokasi = $this->lokasi ? $this->lokasi   : 'JAPEK KM69 000';
                if ($lokasi == '-- Lokasi --') {
                    $lokasi = 'JAPEK KM69 000';
                }
                $tanggalawal =  $this->tanggalawal ? $this->tanggalawal  :  date("Y-m-d");
                $tanggalakhir = $this->tanggalakhir ? $this->tanggalakhir  :  date("Y-m-d");

                $sheet = $event->sheet;
                $sheet->mergeCells('A1:J1');
                $sheet->setCellValue('A1', $lokasi . ' Tanggal ' . $tanggalawal . ' s.d ' . $tanggalakhir);
                $sheet->mergeCells('A2:J2');
                $sheet->setCellValue('A2', '');
                $sheet->mergeCells('A3:A4');
                $sheet->setCellValue('A3', "Tanggal");
                $sheet->mergeCells('B3:B4');
                $sheet->setCellValue('B3', "Jam");

                $sheet->mergeCells('C3:G3');
                $sheet->setCellValue('C3', "Jalur A");
                $sheet->setCellValue('C4', "CAR");
                $sheet->setCellValue('D4', "BUS");
                $sheet->setCellValue('E4', "TRUK");
                $sheet->setCellValue('F4', "TOTAL");
                $sheet->setCellValue('G4', "AVG SPEED");

                $sheet->mergeCells('H3:L3');
                $sheet->setCellValue('H3', "Jalur B");
                $sheet->setCellValue('H4', "CAR");
                $sheet->setCellValue('I4', "BUS");
                $sheet->setCellValue('J4', "TRUK");
                $sheet->setCellValue('K4', "TOTAL");
                $sheet->setCellValue('L4', "AVG SPEED");

                $styleArray = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $cellRange = 'A1:L4'; // All headers
                $sheet->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
            },
        ];
    }

	public function startCell(): string
    {
        return 'A5';
    }

    public function collection()
    {
        $lokasi = $this->lokasi ? $this->lokasi   : 'JAPEK KM69 000';
        if ($lokasi == '-- Lokasi --') {
            $lokasi = 'JAPEK KM69 000';
        }
        $tanggalawal =  $this->tanggalawal ? $this->tanggalawal  :  date("Y-m-d");
        $tanggalakhir = $this->tanggalakhir ? $this->tanggalakhir  :  date("Y-m-d");

        $query =  "SELECT
        date( time ) AS tanggal,
        CASE hour(time) WHEN 0 THEN '00:00 - 01:00' WHEN 1 THEN '01:00 - 02:00' WHEN 2 THEN '02:00 - 03:00' WHEN 3 THEN '03:00 - 04:00' WHEN 4 THEN '04:00 - 05:00' WHEN 5 THEN '05:00 - 06:00' WHEN 6 THEN '06:00 - 07:00' WHEN 7 THEN '07:00 - 08:00' WHEN 8 THEN '08:00 - 09:00' WHEN 9 THEN '09:00 - 10:00' WHEN 10 THEN '10:00 - 11:00' WHEN 11 THEN '11:00 - 12:00' WHEN 12 THEN '12:00 - 13:00' WHEN 13 THEN '13:00 - 14:00' WHEN 14 THEN '14:00 - 15:00' WHEN 15 THEN '15:00 - 16:00' WHEN 16 THEN '16:00 - 17:00' WHEN 17 THEN '17:00 - 18:00' WHEN 18 THEN '18:00 - 19:00' WHEN 19 THEN '19:00 - 20:00' WHEN 20 THEN '20:00 - 21:00' WHEN 21 THEN '21:00 - 22:00' WHEN 22 THEN '22:00 - 23:00' ELSE '23:00 - 00:00' END AS jam, 
        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1	+ car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5) as car_down_all,
        sum( bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1	+ bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5) as bus_down_all,
        sum( truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1	+ truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5) as truck_down_all,
        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1 + car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5 + bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1 + bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5 + truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1 + truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5 ) as all_down,
        FLOOR(sum(speed_up)/(count(*)-1)) as speedavg_down, 
        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5) as car_up_all,
        sum( bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5) as bus_up_all,
        sum( truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5) as truck_up_all,
        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5 + bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5 + truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5 ) as all_up,
        FLOOR(sum(speed_down)/(count(*)-1)) as speedavg_up
        FROM
        CCTV_Traffic_V2 
        WHERE
            date( time ) between '$tanggalawal' and '$tanggalakhir' 
            AND location = '$lokasi' 
        GROUP BY
            location, date(time), hour(time), jam
        ORDER BY date(time) ASC";
        // dd($query);
        $data = collect(DB::select($query));
        return $data;
    }
}

// <?php

// namespace App\Exports;

// use App\Models\Page;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class ExportLalin implements FromCollection
// {
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
        // $lokasi = request()->lokasi ? request()->lokasi   : 'JAPEK KM47 200';
        // if ($lokasi == '-- Lokasi --'){
            // $lokasi = 'JAPEK KM47 200';
        // }
        // $tanggalawal =  request()->tanggalawal ? request()->tanggalawal  :  date("Y-m-d");
        // $tanggalakhir =  request()->tanggalakhir ? request()->tanggalakhir  :  date("Y-m-d");
        
        // $query =  "SELECT
                        // location,
                        // date( time ) AS tanggal,
                        // HOUR ( time ) AS jam,
                        // '$tanggalawal' as tanggalawal,
                        // '$tanggalakhir' as tanggalakhir,
                        // sum( car_up ) AS car_up_all,
                        // sum( `bus(s)_up` ) + sum( `bus(l)_up` ) AS bus_up_all,
                        // sum( `truck(s)_up` ) + sum( `truck(m)_up` ) + sum( `truck(l)_up` ) + sum( `truck(xl)_up` ) AS truck_up_all,
                        // sum( car_up ) + sum( `bus(s)_up` ) + sum( `bus(l)_up` ) + sum( `truck(s)_up` ) + sum( `truck(m)_up` ) + sum( `truck(l)_up` ) + sum( `truck(xl)_up` ) AS all_up,
                        // sum( car_down ) AS car_down_all,
                        // sum( `bus(s)_down` ) + sum( `bus(l)_down` ) AS bus_down_all,
                        // sum( `truck(s)_down` ) + sum( `truck(m)_down` ) + sum( `truck(l)_down` ) + sum( `truck(xl)_down` ) AS truck_down_all,
                        // sum( car_down ) + sum( `bus(s)_down` ) + sum( `bus(l)_down` ) + sum( `truck(s)_down` ) + sum( `truck(m)_down` ) + sum( `truck(l)_down` ) + sum( `truck(xl)_down` ) AS all_down 
                    // FROM
                        // CCTV_Traffic 
                    // WHERE
                        // date( time ) between '$tanggalawal' and '$tanggalakhir' 
                        // AND location = '$lokasi' 
                    // GROUP BY
                        // location, date(time), hour(time);";
        
        // // dump($query);
        // $data = collect(DB::select($query));
        // return $data;
    // }
// }
