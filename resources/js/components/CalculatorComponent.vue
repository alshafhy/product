
    <div class="card border-secondary">
        <div class="card-header">
            <h4 class="card-title">حاسبة الحفريات شارع فرعي</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th colspan="5">الحفريات الاسفلتية / ض م / ش فرعي</th>
                    <th>اعادة الاسفلت</th>
                </tr>
                <tr class="table-dark">
                    <td>عدد الكيبلات</td>
                    <td>عرض الاسفلت</td>
                    <td>النسبة المئوية</td>
                    <td>الكمية المنفذة</td>
                    <td>الاجمالي</td>
                    <td>م2</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>@{{pres_1}}</td>
                    <td></td>
                    <td rowspan="3"><input class="form-control form-control-sm" @change="cale_1" v-model="fossil_1"></td>
                    <td rowspan="3">@{{total_1}}</td>
                    <td>@{{amount_1}}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>@{{pres_1}}</td>
                    <td></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>@{{pres_1}}</td>
                    <td></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>@{{pres_2}}</td>
                    <td></td>
                    <td><input class="form-control form-control-sm" @change="cale_2" v-model="fossil_2"></td>
                    <td>@{{total_2}}</td>
                    <td>@{{amount_2}}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>@{{pres_3}}</td>
                    <td>0.39</td>
                    <td><input class="form-control form-control-sm" @change="cale_3" v-model="fossil_3"></td>
                    <td>@{{total_3}}</td>
                    <td>@{{amount_3}}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>@{{pres_4}}</td>
                    <td>0.455</td>
                    <td><input class="form-control form-control-sm" @change="cale_4" v-model="fossil_4"></td>
                    <td>@{{total_4}}</td>
                    <td>@{{amount_4}}</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>@{{ pres_5 }}</td>
                    <td>0.52</td>
                    <td><input class="form-control form-control-sm" @change="cale_5" v-model="fossil_5"></td>
                    <td>@{{total_5}}</td>
                    <td>@{{amount_5}}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>@{{ pres_6 }}</td>
                    <td>0.585</td>
                    <td><input class="form-control form-control-sm" @change="cale_6" v-model="fossil_6"></td>
                    <td>@{{total_6}}</td>
                    <td>@{{amount_6}}</td>
                </tr>
                <tr>
                    <td>الاجمالي</td>
                    <td></td>
                    <td></td>
                    <td>@{{ fossil_1 + fossil_2 + fossil_3 + fossil_4 + fossil_5 + fossil_6 }}</td>
                    <td>@{{ total_3 + total_4 + total_5 + total_6 }}</td>
                    <td>@{{ amount_1 + amount_2 + amount_3 + amount_4 + amount_5 + amount_6 }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
<script>
    export default {
        methods: {
            cale_1(n) {
                this.total_1 = this.fossil_1;
                this.amount_1 = this.fossil_1 * (this.pres_1 + 0.3);
            },
            cale_2(n) {
                this.total_2 = this.fossil_2 + this.fossil_3 + this.fossil_4 + this.fossil_5 + this.fossil_6;
                this.amount_2 = this.fossil_2 * (this.pres_2 + 0.2);
            },
            cale_3(n) {
                this.total_3 = this.fossil_3 * 0.1 * 0.65;
                this.amount_3 = this.fossil_3 * (this.pres_3 + 0.2);
            },
            cale_4(n) {
                this.total_4 = this.fossil_4 * 0.2 * 0.65;
                this.amount_4 = this.fossil_4 * (this.pres_4 + 0.2);
            },
            cale_5(n) {
                this.total_5 = this.fossil_5 * 0.3 * 0.65;
                this.amount_5 = this.fossil_5 * (this.pres_5 + 0.2);
            },
            cale_6(n) {
                this.total_6 = this.fossil_6 * 0.4 * 0.65;
                this.amount_6 = this.fossil_6 * (this.pres_6 + 0.2);
            },
        },
        data() {
            return {
                pres_1:0.4,
                fossil_1:0,
                total_1: 0,
                amount_1:0,

                pres_2:0.5,
                fossil_2:0,
                total_2: 0,
                amount_2:0,

                pres_3:0.6,
                fossil_3:0,
                total_3: 0,
                amount_3:0,

                pres_4:0.7,
                fossil_4:0,
                total_4: 0,
                amount_4:0,

                pres_5:0.8,
                fossil_5:0,
                total_5: 0,
                amount_5:0,

                pres_6:0.9,
                fossil_6:0,
                total_6: 0,
                amount_6:0,

            }
        }
    }
</script>
