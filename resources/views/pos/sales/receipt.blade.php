@php
    $configData = Helper::applClasses();
@endphp
<div class="print-receipt" style="width: 80mm; font-family: 'Arial', sans-serif; font-size: 12px; line-height: 1.4; color: #000; direction: rtl;">
    <div style="text-align: center; margin-bottom: 10px;">
        <h2 style="margin: 0;">{{ $shop_name ?? 'CashPOS' }}</h2>
        <p style="margin: 0;">{{ $shop_phone ?? '01xxxxxxxx' }}</p>
        <p style="margin: 0; font-size: 10px;">التاريخ: {{ now()->format('Y-m-d H:i') }}</p>
        <hr style="border-top: 1px dashed #000; margin: 10px 0;">
        <h4 style="margin: 0;">فاتورة بيع #{{ $invoice->invoice_number }}</h4>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
        <thead>
            <tr style="border-bottom: 1px solid #000;">
                <th style="text-align: right; padding: 5px 0;">الصنف</th>
                <th style="text-align: center;">الكمية</th>
                <th style="text-align: left;">الإجمالي</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td style="padding: 5px 0;">{{ $item->product_name }}</td>
                <td style="text-align: center;">{{ (float)$item->quantity }}</td>
                <td style="text-align: left;">{{ number_format($item->line_total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr style="border-top: 1px dashed #000; margin: 10px 0;">

    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <span>الإجمالي الفرعي:</span>
        <span>{{ number_format($invoice->subtotal, 2) }} LE</span>
    </div>
    @if($invoice->discount > 0)
    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <span>الخصم:</span>
        <span>-{{ number_format($invoice->discount, 2) }} LE</span>
    </div>
    @endif
    <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 14px; margin-bottom: 10px;">
        <span>الإجمالي النهائي:</span>
        <span>{{ number_format($invoice->total, 2) }} LE</span>
    </div>

    <hr style="border-top: 1px dashed #000; margin: 10px 0;">

    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
        <span>المدفوع:</span>
        <span>{{ number_format($invoice->paid, 2) }} LE</span>
    </div>
    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
        <span>المتبقي:</span>
        <span>{{ number_format($invoice->remaining, 2) }} LE</span>
    </div>

    <div style="text-align: center; margin-top: 20px; font-size: 10px;">
        <p>شكراً لزيارتكم</p>
        <p>CashPOS - Powered by Antigravity</p>
    </div>
</div>

<style>
@media print {
    body * { visibility: hidden; }
    .print-receipt, .print-receipt * { visibility: visible; }
    .print-receipt { position: absolute; left: 0; top: 0; }
}
</style>
