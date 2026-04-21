# Comprehensive Application Testing Plan

This document outlines the systematic testing of all identified application features.

## 1. Authentication & System Access
- [ ] **Login/Logout**: Verify session persistence.
- [ ] **Language Switch**: Verify RTL/LTR support (Arabic vs English).
- [ ] **Dashboard**: Verify stats and widgets load on `http://localhost:8023/home`.

## 2. POS & Sales (CashPOS)
- [ ] **Products**: Create a new product (Store > Products), verify list.
- [ ] **Sales Invoice**: Create a new sale invoice using a product, verify receipt.
- [ ] **Purchase Invoice**: Create a new purchase invoice, verify stock update.
- [ ] **Customers/Suppliers**: Create and update records.

## 3. Treasury & Financials
- [ ] **Receipt Vouchers**: Create a deposit, check balance.
- [ ] **Payment Vouchers**: Create a withdrawal, check balance.
- [ ] **Treasury Reports**: Verify data reflects recent transactions.

## 4. User Management
- [ ] **Users**: Browse user list.
- [ ] **Roles**: Check role permissions.

## 5. Work Orders & Reports
- [ ] **Work Orders**: Investigate `/workOrdersManagement/workOrders`.
- [ ] **Reports**: Verify report generation pages load.

---
**Testing Prompt for AI Agent:**
"Perform a comprehensive end-to-end test of this application. Explore all sidebar menus, create a test product, process a sale, and verify treasury balances. Report any UI glitches or logical errors."
