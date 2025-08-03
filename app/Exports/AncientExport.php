<?php

namespace App\Exports;

use App\Models\AncientData;
use Illuminate\Http\Response;

class AncientExport
{
    protected $status;

    public function __construct($status = 'all')
    {
        $this->status = $status;
    }

    public function collection()
    {
        $query = AncientData::query();
        
        if ($this->status !== 'all') {
            $query->where('status_seleksi', $this->status);
        }
        
        return $query->orderBy('timestamp', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Timestamp',
            'Nama Lengkap',
            'NIM',
            'Angkatan',
            'Email',
            'ID Line',
            'Instagram',
            'Lokasi Pilihan',
            'Status Seleksi',
            'Catatan Admin',
            'Updated At'
        ];
    }

    public function map($data): array
    {
        static $no = 1;
        
        return [
            $no++,
            $data->timestamp ? $data->timestamp->format('d/m/Y H:i') : '',
            $data->nama_lengkap,
            $data->nim,
            $data->angkatan,
            $data->email,
            $data->id_line,
            $data->instagram,
            $data->lokasi_pilihan,
            ucfirst($data->status_seleksi),
            $data->catatan_admin ?? '-',
            $data->updated_at ? $data->updated_at->format('d/m/Y H:i') : '-'
        ];
    }

    public function export()
    {
        $data = $this->collection();
        
        // Create CSV content
        $output = fopen('php://temp', 'r+');
        
        // Add BOM for UTF-8 (helps with Excel opening CSV properly)
        fwrite($output, "\xEF\xBB\xBF");
        
        // Add headers
        fputcsv($output, $this->headings());
        
        // Add data
        foreach ($data as $item) {
            fputcsv($output, $this->map($item));
        }
        
        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);
        
        return $csv;
    }
    
    public function download()
    {
        $csv = $this->export();
        $filename = 'ancient_data_' . ($this->status !== 'all' ? $this->status . '_' : '') . date('Y-m-d_H-i-s') . '.csv';
        
        return response($csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Length' => strlen($csv),
        ]);
    }

    // Method untuk compatibility dengan Laravel Excel jika nanti diinstall
    public function downloadExcel()
    {
        return $this->download();
    }
}