<?php

namespace App\DataTables;

use App\Helpers\MyHelper;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BookingDataTable extends DataTable
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
            ->editColumn('nama', function($data) {
                return $data->user->name;
            })
            ->editColumn('status_pengunjung', function($data) {
                return $data->user->status_pengunjung;
            })
            ->editColumn('asset', function($data) {
                $str = '';
                if ($data->asset->dokumen_aset) {
                    $str = '<a href="'. url(Storage::url($data->asset->dokumen_aset)) .'"><img src="'. url(Storage::url($data->asset->dokumen_aset)) .'" width="100px"></a><br>';
                }

                $str .= $data->asset->nama;
                return $str;
            })
            ->editColumn('nama_guide', function($data) {
                return $data->asset->nama_guide;
            })
            ->editColumn('tgl_jam', function($data) {
                return $data->jadwal_aset->tgl_jam_fixed;
            })
            ->editColumn('komplen', function($data) {
                $str = $data->komplen;
                if (Auth::user()->role == 'pengunjung') {
                    $komplen_route = route('dashboard.booking.komplen', $data->id);
                    $str .= "<br><a href='". $komplen_route ."' class='btn btn-sm btn-primary'>Berikan Komplen</a>";
                }
                return $str;
            })
            ->editColumn('status', function($data) {
                return MyHelper::getStatus($data);
            })
            ->editColumn('created_at', function($data) {
                return Carbon::parse($data->expired_at)->format('d M Y');
            })
            ->addColumn('action', function($data) {
                return "
                    <div class='d-flex justify-content-center'>
                        <a href='" . route('dashboard.booking.bukti_bayar', $data->id) . "' class='btn btn-sm btn-primary me-1'>
                        <i class='mdi mdi-file align-middle font-size-12'></i> Bukti Bayar
                        </a>
                        <a href='" . route('dashboard.booking.show', $data->id) . "' class='btn btn-sm btn-info me-1'>
                        <i class='mdi mdi-pencil align-middle font-size-12'></i> Detail
                        </a>
                        <form action='" . route('dashboard.booking.destroy', $data->id) . "' method='post' style='display: inline-block;'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='button' class='btn btn-sm btn-danger buttonDeletion'>
                                <i class='mdi mdi-trash-can align-middle font-size-12'></i> Hapus
                            </button>
                        </form>
                    </div>
                ";
            })
            ->rawColumns(['action', 'asset', 'komplen', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BookingDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Booking $model)
    {
        return $model->with(['user', 'asset', 'jadwal_aset'])
                    ->when(Auth::user()->role == 'pengunjung', function($query) {
                        $query->where('user_id', Auth::user()->id);
                    })->when(Auth::user()->role == 'pengelola', function($query) {
                        $query->whereRelation('asset', 'user_id', Auth::user()->id);
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
                    ->setTableId('bookingdatatable-table')
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
            Column::make('nama')->name('user.name')->title('Nama Pengunjung'),
            Column::make('status_pengunjung')->name('user.status_pengunjung'),
            Column::make('no_tiket'),
            Column::make('jml_orang'),
            Column::make('asset')->name('asset.nama')->title('Nama Aset'),
            Column::make('nama_guide')->name('asset.nama_guide')->title('Nama Guide'),
            Column::make('tgl_jam')->name('jadwal_aset.tgl_jam')->title('Tgl & Jam'),
            Column::make('status'),
            Column::make('komplen'),
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
        return 'Booking_' . date('YmdHis');
    }
}
