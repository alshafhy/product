{{-- Dashboard Stats — BUG 4 FIX --}}
<div class="stats-card-grid">

  <div class="stat-card">
    <div class="stat-card-icon" style="background:#e8f4fd;">
      <i class="bi bi-currency-dollar text-primary"></i>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value">{{ number_format($today_sales_total ?? 0, 2) }}</div>
      <div class="stat-card-label">مبيعات اليوم</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:#e8fdf0;">
      <i class="bi bi-graph-up-arrow text-success"></i>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value">{{ number_format($today_profit ?? 0, 2) }}</div>
      <div class="stat-card-label">أرباح اليوم</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:#fff8e1;">
      <i class="bi bi-receipt text-warning"></i>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value">{{ $today_sales_count ?? 0 }}</div>
      <div class="stat-card-label">فواتير اليوم</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:#e8f4fd;">
      <i class="bi bi-safe2 text-info"></i>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value">{{ number_format($treasury_balance ?? 0, 2) }}</div>
      <div class="stat-card-label">رصيد الخزينة</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" 
         style="background: {{ ($low_stock_count ?? 0) > 0 ? '#fdecea' : '#e8f4fd' }};">
      <i class="bi bi-box-seam {{ ($low_stock_count ?? 0) > 0 ? 'text-danger' : 'text-primary' }}"></i>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value {{ ($low_stock_count ?? 0) > 0 ? 'text-danger' : '' }}">
        {{ $low_stock_count ?? 0 }}
      </div>
      <div class="stat-card-label">منتجات تحت الحد</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon"
         style="background: {{ ($overdue_installments_count ?? 0) > 0 ? '#fdecea' : '#e8f4fd' }};">
      <i class="bi bi-calendar-x {{ ($overdue_installments_count ?? 0) > 0 ? 'text-danger' : 'text-primary' }}"></i>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value {{ ($overdue_installments_count ?? 0) > 0 ? 'text-danger' : '' }}">
        {{ $overdue_installments_count ?? 0 }}
      </div>
      <div class="stat-card-label">أقساط متأخرة</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:#f3e8fd;">
      <i class="bi bi-people text-purple" style="color:#6c63ff;"></i>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value">{{ $total_customers ?? 0 }}</div>
      <div class="stat-card-label">إجمالي العملاء</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-card-icon" style="background:#e8fdf0;">
      <i class="bi bi-tags text-success"></i>
    </div>
    <div class="stat-card-body">
      <div class="stat-card-value">{{ $total_products ?? 0 }}</div>
      <div class="stat-card-label">إجمالي المنتجات</div>
    </div>
  </div>

</div>

<style>
.stats-card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 1.5rem;
  padding: 1rem;
}

.stat-card {
  background: white;
  border-radius: 12px;
  padding: 1.25rem;
  display: flex;
  align-items: center;
  box-shadow: 0 2px 12px rgba(0,0,0,0.04);
  transition: transform 0.2s;
}

.stat-card:hover {
  transform: translateY(-4px);
}

.stat-card-icon {
  width: 48px;
  height: 48px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  margin-left: 1rem;
  flex-shrink: 0;
}

[dir="ltr"] .stat-card-icon {
  margin-left: 0;
  margin-right: 1rem;
}

.stat-card-body {
  flex-grow: 1;
}

.stat-card-value {
  font-size: 1.35rem;
  font-weight: 700;
  color: #2b3a4a;
  line-height: 1.2;
}

.stat-card-label {
  font-size: 0.875rem;
  color: #6c757d;
  margin-top: 0.25rem;
}
</style>
