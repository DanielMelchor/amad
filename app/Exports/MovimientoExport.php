<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\withHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class MovimientoExport implements FromArray, WithTitle, ShouldAutoSize, WithHeadings, Responsable,  WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    protected $titulo;
    protected $headings;
    protected $movimientos;

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
            //2    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            //'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            1  => ['font' => ['size' => 14]],
            //2  => ['font' => ['size' => 14]],
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

    public function __construct($titulo,$headings,$movimientos)
    {
        $this->titulo = $titulo;
        $this->headings = $headings;
        $this->movimientos = $movimientos;
    }

    public function array(): array
    {
        return $this->movimientos;
    }

    public function title(): string
    {
        return $this->titulo;
    }

    public function headings(): array
    {
        return $this->headings;
    }
}
