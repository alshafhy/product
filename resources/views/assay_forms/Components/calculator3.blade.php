
<div class="card border-secondary" id="calculator3">
    <div class="card-header">
        <h4 class="card-title">حفرية رصيف / ترابية</h4>
    </div>
    <div class="card-body">
        <table class="table table-hover table-sm">
            <thead>
            <tr>
                <th colspan="4">حفرية رصيف</th>
                <th colspan="4">حفرية ترابية</th>
            </tr>
            <tr class="table-dark">
                <td>#</td>
                <td>اعادة رصيف</td>
                <td>الاجمالي</td>
                <td>الكمية المنفذة</td>
                <td>&nbsp;</td>
                <td>#</td>
                <td>اعادة رصيف</td>
                <td>الاجمالي</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td rowspan="3"><input class="form-control form-control-sm" @change="cale" v-model="fossil_1"></td>
                <td rowspan="3">@{{total_1}}</td>
                <td>@{{amount_1}}</td>

                <td>&nbsp;</td>
                <td>1</td>
                <td rowspan="3"><input class="form-control form-control-sm" @change="cale" v-model="fossil_dirt_1"></td>
                <td rowspan="3">@{{total_dirt_1}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>0</td>

                <td>&nbsp;</td>
                <ttd>2</ttd>
            </tr>
            <tr>
                <td>3</td>
                <td>0</td>

                <td>&nbsp;</td>
                <ttd>3</ttd>
            </tr>
            <tr>
                <td>4</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_2"></td>
                <td>@{{total_2}}</td>
                <td>@{{amount_2}}</td>

                <td>&nbsp;</td>
                <td>4</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_dirt_2"></td>
                <td>@{{total_dirt_2}}</td>
            </tr>
            <tr>
                <td>5</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_3"></td>
                <td>@{{total_3}}</td>
                <td>@{{amount_3}}</td>

                <td>&nbsp;</td>
                <td>5</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_dirt_3"></td>
                <td>@{{total_dirt_3}}</td>
            </tr>
            <tr>
                <td>6</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_4"></td>
                <td>@{{total_4}}</td>
                <td>@{{amount_4}}</td>

                <td>&nbsp;</td>
                <td>6</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_dirt_4"></td>
                <td>@{{total_dirt_4}}</td>
            </tr>
            <tr>
                <td>7</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_5"></td>
                <td>@{{total_5}}</td>
                <td>@{{amount_5}}</td>

                <td>&nbsp;</td>
                <td>7</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_dirt_5"></td>
                <td>@{{total_dirt_5}}</td>
            </tr>
            <tr>
                <td>8</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_6"></td>
                <td>@{{total_6}}</td>
                <td>@{{amount_6}}</td>

                <td>&nbsp;</td>
                <td>8</td>
                <td><input class="form-control form-control-sm" @change="cale" v-model="fossil_dirt_6"></td>
                <td>@{{total_dirt_6}}</td>
            </tr>
            <tr>
                <td>الاجمالي</td>
                <td>@{{ (parseFloat(fossil_1) + parseFloat(fossil_2) + parseFloat(fossil_3) + parseFloat(fossil_4) + parseFloat(fossil_5) + parseFloat(fossil_6)).toFixed(1) }}</td>
                <td>@{{ (parseFloat(total_1) + parseFloat(total_2) + parseFloat(total_3) + parseFloat(total_4) + parseFloat(total_5) + parseFloat(total_6)).toFixed(1) }}</td>
                <td>@{{ (parseFloat(amount_1) + parseFloat(amount_2) + parseFloat(amount_3) + parseFloat(amount_4) + parseFloat(amount_5) + parseFloat(amount_6)).toFixed(1) }}</td>



                <td>&nbsp;</td>
                <td></td>
                <td>@{{ (parseFloat(fossil_dirt_1) + parseFloat(fossil_dirt_2) + parseFloat(fossil_dirt_3) + parseFloat(fossil_dirt_4) + parseFloat(fossil_dirt_5) + parseFloat(fossil_dirt_6)).toFixed(1) }}</td>
                <td>@{{ (parseFloat(total_dirt_3) + parseFloat(total_dirt_4) + parseFloat(total_dirt_5) + parseFloat(total_dirt_6)).toFixed(1) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    Vue.createApp({
        methods: {
            cale(){
                this.total_dirt_1 = (this.fossil_1 + this.fossil_dirt_1).toFixed(1);
                this.total_1 = (this.fossil_1* 54).toFixed(1);
                this.amount_1 = (this.fossil_1 * 0.4).toFixed(1);

                this.total_2 = ((parseFloat(this.fossil_2) + parseFloat(this.fossil_3) + parseFloat(this.fossil_4) + parseFloat(this.fossil_5) + parseFloat(this.fossil_6))*58).toFixed(1);
                this.amount_2 = (this.fossil_2 *  0.5).toFixed(1);

                this.total_3 = (this.fossil_3 * 0.1 * 0.65 * 114).toFixed(1);
                this.amount_3 = (this.fossil_3 *  0.6).toFixed(1);

                this.total_4 = (this.fossil_4 * 0.2 * 0.65 * 114).toFixed(1);
                this.amount_4 = (this.fossil_4 * 0.7).toFixed(1);

                this.total_5 = (this.fossil_5 * 0.3 * 0.65 * 114).toFixed(1);
                this.amount_5 = (this.fossil_5 * 0.8).toFixed(1);

                this.total_6 = (this.fossil_6 * 0.4 * 0.65 * 114).toFixed(1);
                this.amount_6 = (this.fossil_6 * 0.9).toFixed(1);

                this.total_dirt_1 = (this.fossil_1 + this.fossil_dirt_1).toFixed(1);

                this.total_dirt_2 = (
                    parseFloat(this.fossil_2) + parseFloat(this.fossil_3) + parseFloat(this.fossil_4) + parseFloat(this.fossil_5) + parseFloat(this.fossil_6) +
                    parseFloat(this.fossil_dirt_2) + parseFloat(this.fossil_dirt_3) + parseFloat(this.fossil_dirt_4) + parseFloat(this.fossil_dirt_5) + parseFloat(this.fossil_dirt_6)
                ).toFixed(1);

                this.total_dirt_3 = ((this.fossil_3 + this.fossil_dirt_3) * 0.1 * 0.65).toFixed(1);

                this.total_dirt_4 = ((this.fossil_4 + this.fossil_dirt_4) * 0.2 * 0.65).toFixed(1);

                this.total_dirt_5 = ((this.fossil_5 + this.fossil_dirt_5) * 0.3 * 0.65).toFixed(1);

                this.total_dirt_6 = ((this.fossil_6 + this.fossil_dirt_6) * 0.4 * 0.65).toFixed(1);

            }
        },
        data() {
            return {
                fossil_dirt_1:0,
                fossil_1:0,
                total_dirt_1: 0,
                total_1: 0,
                amount_1:0,

                fossil_dirt_2:0,
                fossil_2:0,
                total_dirt_2: 0,
                total_2: 0,
                amount_2:0,

                fossil_dirt_3:0,
                fossil_3:0,
                total_3: 0,
                total_dirt_3: 0,
                amount_3:0,

                fossil_dirt_4:0,
                fossil_4:0,
                total_dirt_4: 0,
                total_4: 0,
                amount_4:0,

                fossil_5:0,
                fossil_dirt_5:0,
                total_5: 0,
                total_dirt_5: 0,
                amount_5:0,

                fossil_dirt_6:0,
                fossil_6:0,
                total_dirt_6: 0,
                total_6: 0,
                amount_6:0,

            }
        }
    }).mount('#calculator3');
</script>
