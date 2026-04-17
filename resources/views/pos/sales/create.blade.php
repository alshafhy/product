@extends('pos/layout')

@section('pos-content')
<div class="row sales-create-screen" id="pos-app">
    <!-- Left: Cart & Summary -->
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header border-bottom">
                <h4 class="card-title"><i data-feather="shopping-cart"></i> سلة البيع</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive" style="min-height: 400px;">
                    <table class="table table-hover mb-0" id="cart-table">
                        <thead class="bg-light">
                            <tr>
                                <th>المنتج</th>
                                <th>الوحدة</th>
                                <th width="100">الكمية</th>
                                <th width="120">السعر</th>
                                <th width="120">الإجمالي</th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cart items injected here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">العميل</label>
                            <select class="form-select" id="customer-select">
                                <option value="">عميل نقدي</option>
                                <!-- Customers loaded here -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <h4 class="mb-1 text-muted">الإجمالي: <span id="display-subtotal">0.00</span></h4>
                        <h3 class="fw-bold text-primary">المطلوب: <span id="display-total">0.00</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Search & Actions -->
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">بحث بـ (أسم المنتج / باركود)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i data-feather="search"></i></span>
                        <input type="text" id="product-search" class="form-control" placeholder="أبحث هنا..." autocomplete="off">
                    </div>
                    <div id="search-results" class="list-group mt-2 position-absolute w-100 shadow-lg d-none" style="z-index: 1000; left: 0; right: 0;"></div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">الخصم</label>
                    <div class="input-group">
                        <input type="number" id="discount-value" class="form-control" value="0">
                        <select id="discount-type" class="form-select" style="max-width: 80px;">
                            <option value="fixed">LE</option>
                            <option value="percentage">%</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">المدفوع</label>
                    <input type="number" id="paid-amount" class="form-control form-control-lg text-primary fw-bold" value="0">
                </div>

                <div class="mb-3 text-center">
                    <h5 class="text-secondary">المتبقي: <span id="display-remaining">0.00</span></h5>
                </div>

                <button class="btn btn-primary w-100 btn-lg mb-2" id="btn-save-invoice">
                    <i data-feather="save" class="me-1"></i> حفظ الفاتورة (F10)
                </button>
                <button class="btn btn-outline-danger w-100" id="btn-clear-cart">
                    <i data-feather="trash-2" class="me-1"></i> مسح السلة
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Invoice Success -->
<div class="modal fade" id="modal-receipt" tabindex="-1" hidden>
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center" id="receipt-preview">
                <!-- Receipt content here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-primary w-100" onclick="window.print()">طباعة</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-script')
<script>
$(document).ready(function() {
    let cart = [];
    let customers = [];

    // 1. Search Logic
    $('#product-search').on('input', function() {
        let query = $(this).val();
        if (query.length < 2) {
            $('#search-results').addClass('d-none');
            return;
        }

        $.get('/api/pos/products', { search: query }, function(response) {
            let products = response.data;
            let html = '';
            products.forEach(p => {
                html += `
                    <button type="button" class="list-group-item list-group-item-action btn-add-product" 
                        data-product='${JSON::encode(p)}'>
                        <div class="d-flex justify-content-between">
                            <span>${p.name}</span>
                            <span class="badge bg-primary">${p.sell_price} LE</span>
                        </div>
                        <small class="text-muted ms-auto">${p.code_id}</small>
                    </button>`;
            });
            $('#search-results').html(html).removeClass('d-none');
        });
    });

    $(document).on('click', '.btn-add-product', function() {
        let product = $(this).data('product');
        addToCart(product);
        $('#search-results').addClass('d-none');
        $('#product-search').val('').focus();
    });

    // 2. Cart Logic
    function addToCart(product) {
        let exists = cart.find(i => i.id === product.id);
        if (exists) {
            exists.qty++;
        } else {
            cart.push({
                id: product.id,
                name: product.name,
                qty: 1,
                price: product.sell_price,
                unit: product.unit1,
                factor: 1
            });
        }
        renderCart();
    }

    function renderCart() {
        let html = '';
        let subtotal = 0;

        cart.forEach((item, index) => {
            let rowTotal = item.qty * item.price;
            subtotal += rowTotal;
            html += `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.unit}</td>
                    <td><input type="number" class="form-control form-control-sm update-qty" data-index="${index}" value="${item.qty}"></td>
                    <td>${item.price}</td>
                    <td>${rowTotal.toFixed(2)}</td>
                    <td><i data-feather="x-circle" class="text-danger cursor-pointer remove-item" data-index="${index}"></i></td>
                </tr>`;
        });

        $('#cart-table tbody').html(html);
        feather.replace();
        calculateSummary(subtotal);
    }

    function calculateSummary(subtotal) {
        let discVal = parseFloat($('#discount-value').val()) || 0;
        let discType = $('#discount-type').val();
        let discount = 0;

        if (discType === 'percentage') {
            discount = subtotal * (discVal / 100);
        } else {
            discount = discVal;
        }

        let total = subtotal - discount;
        let paid = parseFloat($('#paid-amount').val()) || 0;
        let remaining = total - paid;

        $('#display-subtotal').text(subtotal.toFixed(2));
        $('#display-total').text(total.toFixed(2));
        $('#display-remaining').text(remaining.toFixed(2));
    }

    // 3. Events
    $(document).on('input', '#discount-value, #discount-type, #paid-amount', () => {
        let subtotal = parseFloat($('#display-subtotal').text());
        calculateSummary(subtotal);
    });

    $(document).on('change', '.update-qty', function() {
        let index = $(this).data('index');
        cart[index].qty = parseFloat($(this).val());
        renderCart();
    });

    $(document).on('click', '.remove-item', function() {
        let index = $(this).data('index');
        cart.splice(index, 1);
        renderCart();
    });

    $('#btn-clear-cart').click(() => {
        cart = [];
        renderCart();
    });

    // 4. Save Invoice
    $('#btn-save-invoice').click(function() {
        if (cart.length === 0) {
            toastr.error('السلة فارغة!');
            return;
        }

        let data = {
            customer_id: $('#customer-select').val(),
            discount: $('#discount-value').val(),
            discount_type: $('#discount-type').val(),
            paid: $('#paid-amount').val(),
            payment_type: $('#paid-amount').val() >= parseFloat($('#display-total').text()) ? 'cash' : 'credit',
            invoiced_at: new Date().toISOString(),
            items: cart.map(i => ({
                product_id: i.id,
                quantity: i.qty,
                unit_name: i.unit,
                sell_price: i.price,
                price_type: 'unit1'
            }))
        };

        $.ajax({
            url: '/api/pos/sale-invoices',
            method: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                toastr.success('تم حفظ الفاتورة بنجاح');
                cart = [];
                renderCart();
                // Show modal with receipt
                $('#receipt-preview').html('<h3>فاتورة رقم: ' + response.data.invoice_number + '</h3>');
                // $('#modal-receipt').modal('show');
            },
            error: function(err) {
                toastr.error('خطأ في الحفظ!');
                console.error(err);
            }
        });
    });
});
</script>
@endpush
