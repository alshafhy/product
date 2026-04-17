@extends('pos/layout')

@section('pos-content')
<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">قائمة فواتير البيع</h4>
    </div>
    <div class="card-body">
        <!-- Filter Form -->
        <form class="row mb-4 mt-2" method="GET" action="/pos/sales">
            <div class="col-md-3">
                <label class="form-label">من تاريخ</label>
                <input type="date" name="from" class="form-control" value="{{ request('from', date('Y-m-d')) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">إلى تاريخ</label>
                <input type="date" name="to" class="form-control" value="{{ request('to', date('Y-m-d')) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">العميل</label>
                <input type="text" name="customer" class="form-control" placeholder="أبحث بـ أسم العميل..." value="{{ request('customer') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i data-feather="filter"></i> فلترة
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>رقم الفاتورة</th>
                        <th>التاريخ</th>
                        <th>العميل</th>
                        <th>الإجمالي</th>
                        <th>المدفوع</th>
                        <th>المتبقي</th>
                        <th>الحالة</th>
                        <th width="100">تحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices ?? [] as $invoice)
                    <tr>
                        <td>{{ $invoice->invoice_number }}</td>
                        <td>{{ $invoice->invoiced_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $invoice->customer->name ?? 'عميل نقدي' }}</td>
                        <td>{{ $invoice->total }}</td>
                        <td>{{ $invoice->paid }}</td>
                        <td class="text-danger">{{ $invoice->remaining }}</td>
                        <td>
                            <span class="badge {{ $invoice->status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                {{ $invoice->status }}
                            </span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="/pos/sales/{{ $invoice->id }}">
                                        <i data-feather="eye" class="me-50"></i> عرض
                                    </a>
                                    @can('sale_invoice.void')
                                    <a class="dropdown-item text-danger" href="#">
                                        <i data-feather="trash" class="me-50"></i> إلغاء
                                    </a>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">لا يوجد فواتير حاليا</td>
                    </tr>
                    @endforelse
                </tbody>
                @if(isset($invoices) && count($invoices) > 0)
                <tfoot class="bg-light fw-bold">
                    <tr>
                        <td colspan="3" class="text-end">الإجماليات:</td>
                        <td>{{ collect($invoices)->sum('total') }} LE</td>
                        <td>{{ collect($invoices)->sum('paid') }} LE</td>
                        <td class="text-danger">{{ collect($invoices)->sum('remaining') }} LE</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
