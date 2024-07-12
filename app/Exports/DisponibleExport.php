<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\withHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
use App\User;

class DisponibleExport implements FromCollection, Responsable, WithHeadings, WithTitle, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    private $fileName = 'Articulo_Disponible.xlsx';

    public function columnWidths(): array
    {
        return [
            'A' => 35,
            'B' => 35,
            'C' => 15,
            'D' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            2    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            //'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            1  => ['font' => ['size' => 16]],
            2  => ['font' => ['size' => 14]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $position_last = count($this->headings()[1]);
                $column = Coordinate::stringFromColumnIndex($position_last);
                $cells = "A1:D1";
                $event->sheet->mergeCells($cells);
                $event->sheet->getDelegate()->getStyle($cells)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle($cells)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle($cells)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            }
        ];
    }

    public function headings(): array
    {
        return [
            ['Disponibilidad de Insumos'],
            [
            'Familia',
            'Articulo',
            'Disponible',
            'Reserva']
        ];
    }

    public function title(): string
    {
        return 'Disponibilidad de Articulos';
    }

    public function collection()
    {
        $user = User::findOrFail(Auth()->user()->id);

        $detalle = DB::table('inv_familias as if')
                   ->join('inv_articulos as ia', 'if.id', 'ia.inv_familia_id')
                   ->leftjoin(DB::raw('(SELECT imd.inv_articulo_id, 
                                              SUM(imd.cantidad_entregada * imd.signo) as disponible,
                                              SUM(case imd.cantidad_entregada when 0 then cantidad_reserva else 0 end) as reserva
                                       FROM inv_movimiento_maestros imm
                                       JOIN inv_movimiento_detalles imd on imm.id = imd.inv_movimiento_maestro_id
                                       WHERE imm.subdependencia_id = '.$user->subdependencia_id.' 
                                       GROUP BY imd.inv_articulo_id) detalle'
                                      ),
                                    function($join){
                                        $join->on('ia.id', 'detalle.inv_articulo_id');
                                    })
                   ->select('if.descripcion as familia_descripcion', 
                            'ia.descripcion as articulo_descripcion',
                            DB::raw('IFNULL(detalle.disponible,0) as disponible'), 
                            DB::raw('IFNULL(detalle.reserva,0) as reserva')
                    )
                   ->get();

        return $detalle;
    }
}
