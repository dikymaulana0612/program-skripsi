<?php

namespace App\DataTables;

use App\Models\JadwalAset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class JadwalAssetDataTable extends DataTable
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
            ->editColumn('asset', function($data) {
                return $data->asset->nama;
            })
            ->editColumn('created_at', function($data) {
                return Carbon::parse($data->expired_at)->format('d M Y');
            })
            ->addColumn('action', function($data) {
                if (Auth::user()->role == 'pengelola') {
                    return "
                        <div class='d-flex justify-content-center'>
                            <a href='" . route('dashboard.jadwal_aset.edit', $data->id) . "' class='btn btn-sm btn-warning me-1'>
                            <i class='mdi mdi-pencil align-middle font-size-12'></i> Edit
                            </a>
                            <form action='" . route('dashboard.jadwal_aset.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                                " . csrf_field() . "
                                " . method_field('DELETE') . "
                                <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                    <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                                </button>
                            </form>
                        </div>
                    ";
                }
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\JadwalAsetDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JadwalAset $model)
    {
        return $model->with('asset')
                ->when(Auth::user()->role == 'pengelola', function($query) {
                    $query->whereRelation('asset', 'user_id', Auth::user()->id);
                })->where('tgl_jam', '>=', date('Y-m-d'))->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('ontdatatable-table')
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
            Column::make('asset')->name('asset.nama')->title('Nama Aset'),
            Column::make('tgl_jam'),
            Column::make('max_pengunjung'),
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
        return 'Ont_' . date('YmdHis');
    }
}
