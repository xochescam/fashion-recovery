<template>
	<div class="col-12">
	    <h2 class="text-center TituloFR mt-4 mb-5">Datos Fashion Recovery</h2>

        <p>Selecciona los campos para mostrar información: </p>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card p-3 cursor-pointer"
                    :class="{ 'card--active' : isToday }"
                    @click="todayPeriod()">
                    <label for="date_today">
                        <span class="card-check mr-2">
                            <i class="fas fa-dot-circle" v-if="isToday"></i>
                            <i class="fas fa-circle" v-else></i>
                        </span>    
                        Hasta el día de hoy
                    </label>
                    <div class="d-flex ml-4">
                        <select name="date_today_day" id="date_today_day" class="form-control mr-2" disabled>
                            <option value="">{{ date['day'] }}</option>
                        </select>

                        <select name="date_today_month" id="date_today_month" class="form-control mr-2" disabled>
                            <option value="">{{ date['month'] }}</option>
                        </select>

                        <select name="date_today_year" id="date_today_year" class="form-control" disabled>
                            <option value="">{{ date['year'] }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
                <div 
                    class="card cursor-pointer" 
                    :class="{ 'card--active' : !isToday }" 
                    @click="filterPeriod()">
                    <div class="p-3 row">
                        <div class="col-md-6">
                            <label for="date_from_year">
                                <span class="card-check mr-2">
                                    <i class="fas fa-dot-circle" v-if="!isToday"></i>
                                    <i class="fas fa-circle" v-else></i>
                                </span> 
                                Desde
                            </label>
                            <div class="d-flex ml-4">
                                <select name="date_from_day" id="date_from_day" class="form-control mr-2" ref="iniDay" @change="filterPeriod()">
                                    <option 
                                        :value="day"
                                        v-for="day in this.getDays()" 
                                        :key="day">
                                        {{ day }}
                                    </option>                                
                                </select>
                                <select name="date_from_month" id="date_from_month" class="form-control mr-2" ref="iniMonth" @change="filterPeriod()">
                                    <option 
                                        :value="month"
                                        v-for="month in this.getMonths()" 
                                        :key="month">
                                        {{ month }}
                                    </option>
                                </select>
                                <select name="date_from_year" id="date_from_year" class="form-control" ref="iniYear">
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                        </div>
                                    
                        <div class="col-md-6">
                            <label for="date_until">Hasta</label>
                            <div class="d-flex">
                                <select name="date_until_day" id="date_until_day" class="form-control mr-2" ref="endDay" @change="filterPeriod()">
                                    <option 
                                        :value="day"
                                        v-for="day in this.getDays()" 
                                        :key="day">
                                        {{ day }}
                                    </option>
                                </select>

                                <select name="ddate_until_month" id="date_until_month" class="form-control mr-2" ref="endMonth" @change="filterPeriod()">
                                    <option 
                                        :value="month"
                                        v-for="month in this.getMonths()" 
                                        :key="month">
                                        {{ month }}
                                    </option>
                                </select>
                                
                                <select name="date_until_year" id="date_until_year" class="form-control" ref="endYear">
                                    <option value="2020">2020</option>
                                </select>
                            </div>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="form-group col-md-4">
                <label for="filterSelect">Seleccionar parametro</label>
                <select class="form-control" ref="select" id="filterSelect" @change="selectParam()">
                    <option value=""> - Seleccionar -  </option>
                    <option value="1" selected v-if="isToday">General</option>
                    <option value="2">Compras</option>
                    <option value="3">Logística</option>
                    <option value="4">Ventas por departamentos</option>
                    <option value="5">Devoluciones</option>
                    <option value="6">Ventas</option>
                    <option value="7">Reporte maestro</option>
                    <option value="8">Transferencias</option>
                </select>
            </div>

            <div class="w-100 text-center">
                <button type="button" class="btn btn-fr" :disabled="!select" @click="showReport(false)">Mostrar resultados</button>
            </div>
        </div>

        <h5>Resumen 
            {{  selected == 'general' ? 
                selected : 
                'de '+selected.toLowerCase() }}
        </h5>

        <hr class="mb-5">

        <general-component
            :data="data"
            v-if="general"
        >
        </general-component>

        <departments-component
            :data="arrDep ? this.sort(arrDep, 'sells') : []"
            v-if="departments"
        >
        </departments-component>

        <buys-component
            :data="arrBuyers ? this.sort(arrBuyers, 'buys') : []"
            v-if="buys"
        >
        </buys-component>

        <sellers-component
            :data="arrSellers ? this.sort(arrSellers, 'sells') : []"
            v-if="sells"
        >
        </sellers-component>

        <returns-component
            :data="!arrReturns ? [] : arrReturns "
            v-if="returns"
        >
        </returns-component>

        <sells-component
            :data="!arrSells ? [] : arrSells"
            v-if="allsells"
        >
        </sells-component>

         <shipping-component
            :data="!arrShipping ? [] : this.sort(arrShipping, 'count')"
            v-if="shippingData"
        >
        </shipping-component>

        <bank-component
            :data="!arrBank ? [] : arrBank"
            v-if="bankData"
        >
        </bank-component>
	</div>
</template>

<script>
export default {
    props: {
        data: {
            type: [Object, Array],
            required: true
        },
        date: {
            type: [Object, Array],
            required: true
        },
        dep: {
            type: [Object, Array],
            required: true
        },
        sellsall: {
            type: [Object, Array],
            required: true
        },
        buyers: {
            type: [Object, Array],
            required: true
        },
        sellers: {
            type: [Object, Array],
            required: true
        },
        devs: {
            type: [Object, Array],
            required: true
        },
        shippinglist: {
            type: [Object, Array],
            required: true
        },
        banklist: {
            type: [Object, Array],
            required: true
        },
    },
    data() {
        return {
            select: false,
            general: true,
            departments: false,
            sells: false,
            buys: false,
            returns: false,
            allsells: false,
            shippingData: false,
            bankData: false,
            selected: 'general',
            isToday: true,
            arrDep: this.dep,
            arrBuyers: this.buyers,
            arrSellers: this.sellers,
            arrReturns: this.devs,
            arrShipping: this.shippinglist,
            arrBank: this.banklist,
            arrSells: this.sellsall,
            isLoading: false
        };
    },
    methods: {
        departmentsByDate() {
            this.isLoading = true;
            this.arrDep    = [];

            axios
            .post(this.$root.path+'/departments-by-date',this.getData())
            .then(response => {

                if(response.data.message === 'success') {
                    this.arrDep = response.data.data;
                    this.isLoading = false;
                }
            })
            .catch(error => {
                this.isLoading = false;
            }) 
        },
        transByDate() {
            this.isLoading = true;
            this.arrBank = [];

            axios
            .post(this.$root.path+'/trans-by-date',this.getData())
            .then(response => {

                if(response.data.message === 'success') {
                    this.arrBank = response.data.data;
                    this.isLoading = false;
                }
            })
            .catch(error => {
                this.isLoading = false;
            }) 
        },
        sellsByDate() {
            this.isLoading = true;
            this.arrSells = [];

            axios
            .post(this.$root.path+'/sells-by-date',this.getData())
            .then(response => {

                if(response.data.message === 'success') {
                    this.arrSells = response.data.data;
                    this.isLoading = false;
                }
            })
            .catch(error => {
                this.isLoading = false;
            }) 
        },
        buyersByDate() {
            this.isLoading = true;
            this.arrBuyers = [];

            axios
            .post(this.$root.path+'/buyers-by-date',this.getData())
            .then(response => {

                if(response.data.message === 'success') {
                    this.arrBuyers = response.data.data;
                    this.isLoading = false;
                }
            })
            .catch(error => {
                this.isLoading = false;
            }) 
        },
        sellersByDate() {
            this.isLoading  = true;
            this.arrSellers = [];

            axios
            .post(this.$root.path+'/sellers-by-date',this.getData())
            .then(response => {

                if(response.data.message === 'success') {
                    this.arrSellers = response.data.data;
                    this.isLoading = false;
                }
            })
            .catch(error => {
                this.isLoading = false;
            }) 
        },
        returnsByDate() {
            this.isLoading  = true;
            this.arrReturns = [];

            axios
            .post(this.$root.path+'/returns-by-date',this.getData())
            .then(response => {

                if(response.data.message === 'success') {
                    this.arrReturns = response.data.data;
                    this.isLoading = false;
                }
            })
            .catch(error => {
                this.isLoading = false;
            }) 
        },
        shippingByDate() {
            this.isLoading  = true;
            this.arrShipping = [];

            axios
            .post(this.$root.path+'/shipping-by-date',this.getData())
            .then(response => {

                console.log(response.data);

                if(response.data.message === 'success') {
                    this.arrShipping = response.data.data;
                    this.isLoading = false;
                }
            })
            .catch(error => {
                this.isLoading = false;
            }) 
        },
        todayPeriod() {
            this.clearParams();
            this.isToday    = true;
            this.arrDep     = this.dep;
            this.arrBuyers  = this.buyers;
            this.arrSellers = this.sellers;
            this.arrReturns = this.devs;
            this.arrShipping = this.shippinglist;
        },
        filterPeriod() {
            this.isToday = false;
            this.clearParams();
        },
        getData() {
            const iniYear  = this.$refs.iniYear.value;
            const iniMonth = this.$refs.iniMonth.value;
            const iniDay   = this.$refs.iniDay.value;
            const endYear  = this.$refs.endYear.value;
            const endMonth = this.$refs.endMonth.value;
            const endDay   = this.$refs.endDay.value;

            return {
                "ini" : iniYear + '-' + iniMonth + '-' + iniDay,
                "end" : endYear + '-' + endMonth + '-' + endDay,
            };
        },
        selectParam() {
            const options = this.$refs.select.options;
            const index   = options.selectedIndex;
            this.select   = options[index].value;
            
            this.clearParams();
        },
        showReport(option) {
            
            const options = this.$refs.select;
            const index   = options.selectedIndex;
            this.selected = options[index].innerHTML;

            if(option) {

                console.log(option);
                options.selectedIndex = option;
                this.select           = option;
                this.selected         = options[option].text;
                
                this.clearParams();
            }

            if(!this.isToday) {
                this.showFiltered(this.selected);
            }

            this[this.getParam(this.select)] = true;
        },
        showFiltered(item) {

            if(item === 'Ventas por departamentos') {

                this.departmentsByDate();

            } else if (item === 'Compras') {

                this.buyersByDate();

            } else if (item === 'Ventas') {

                this.sellersByDate();

            } else if (item === 'Devoluciones') {

                this.returnsByDate();
            } else if (item === 'Logística') {

                this.shippingByDate();

            } else if (item === 'Reporte maestro') {

                this.sellsByDate();

            } else if (item === 'Transferencias') {

                this.transByDate();
            }


        },
        getParam(id) {
            const params = {
                1 : 'general',
                2 : 'buys',
                3 : 'shippingData',
                4 : 'departments',
                5 : 'returns',
                6 : 'sells',
                7 : 'allsells',
                8 : 'bankData'
            };

            return params[id];
        },
        clearParams() {
            this.departments = false;
            this.general     = false;
            this.sells       = false;
            this.buys        = false;
            this.returns     = false;
            this.allsells     = false;
            this.shippingData = false;
            this.bankData = false;
        },
        sort(obj, key){

            if (typeof obj === 'object') { obj = Object.values(obj) }

            return obj.sort(function (a, b) {
                if (a[key] > b[key]) {
                    return 0;
                }
                if (a[key] < b[key]) {
                    return -1;
                }
                // a must be equal to b
                return 1;
            }).reverse();
        },
        getDays() {
            const days = [];

            for (let index = 1; index < 32; index++) {

                const length = index.toString().length == 1;
                const day    = length ? '0'+index : index;
                days.push(day);   
            }

            return days;
        },
        getMonths() {
            const months = [];

            for (let index = 1; index < 13; index++) {

                const length = index.toString().length == 1;
                const month  = length ? '0'+index : index;
                months.push(month);   
            }

            return months;
        },
    },
    mounted() {

        //this.shippingByDate();
    }
};
</script>