<?php

namespace App\DataTables;

use App\Helpers\MyHelper;
use App\Models\Aset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AsetDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('koordinat', function($data) {
                $coord = $data->latitude.','.$data->longitude;
                $link = 'https://maps.google.com?q=' . $coord;
                return '<a href="'. $link .'" target="_blank">'. $coord .'</a>';
            })
            ->filterColumn('koordinat', function($query, $keyword) {
                $query->whereRaw("CONCAT(latitude, ',', longitude) like ?", ["%{$keyword}%"]);
            })
            ->editColumn('kecamatan_id', function($data) {
                return $data->kecamatan->nama;
            })
            ->editColumn('dokumen_aset', function($data) {
                if ($data->dokumen_aset) {
                    return '<a href="'. MyHelper::get_avatar($data->dokumen_aset) .'">Lihat Lampiran</a>';
                }

                return '';
            })
            ->addColumn('action', function($data) {
                $str = "
                    <div class='d-flex justify-content-center'>
                        <a href='" . route('dashboard.aset.edit', $data->id) . "' class='btn btn-sm btn-warning me-1'>
                        <i class='mdi mdi-pencil align-middle font-size-12'></i> Edit
                        </a>
                        ";
                if ($data->port_used == 0) {
                    $str .= "<form action='" . route('dashboard.aset.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                    " . csrf_field() . "
                    " . method_field('DELETE') . "
                    <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                        <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                    </button>
                </form>";
                }
                $str .="
                    </div>
                ";

                return $str;
            })
            ->rawColumns(['action', 'dokumen_aset', 'koordinat']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AsetDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Aset $model)
    {
        return $model->with(['kecamatan'])
                ->when(in_array(Auth::user()->role ,['pengelola']), function($query) {
                    $query->where('user_id', Auth::user()->id);
                })->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('asetdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex', '#')->width("10px"),
            Column::make('created_at')->title('Tgl Dibuat')->hidden(),
            Column::make('nama'),
            Column::make('harga')->title('Harga Umum'),
            Column::make('harga_instansi'),
            Column::make('letak'),
            Column::make('kecamatan_id')->name('kecamatan.nama')->title('Kecamatan'),
            Column::make('asal'),
            Column::make('penemu'),
            Column::make('status'),
            Column::make('kondisi'),
            Column::make('nama_guide'),
            Column::make('dokumen_aset')->title('Dokumentasi'),
            Column::make('koordinat')->sortable(false),
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(140)
                    ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'aset_' . date('YmdHis');
    }
}
