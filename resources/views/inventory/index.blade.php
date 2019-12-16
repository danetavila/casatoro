@extends('layouts.app')
@section('content')
<div class="row">
     <h2>Disponibilidad de Inventario</h2>
    <div class="col-md-12 table-responsive" >
        <table class="table table-bordered inventory ">
            <tr>
                <td rowspan="7" class="wall rotate">PARED FONDO</td>
                <td colspan="4" class="wall">PARED</td>
            </tr>
            <tr>
                <td @click="selectCurrentProduct(occupied(1))" :class="{occupied:occupied(1)}"><position-component pos="1" :product="occupied(1)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(6))" :class="{occupied:occupied(6)}"><position-component pos="6" :product="occupied(6)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(11))" :class="{occupied:occupied(11)}"><position-component pos="11" :product="occupied(11)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(16))" :class="{occupied:occupied(16)}"><position-component pos="16" :product="occupied(16)"></position-component></td>               
            </tr>
            <tr>
                <td @click="selectCurrentProduct(occupied(2))" :class="{occupied:occupied(2)}"><position-component pos="2" :product="occupied(2)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(7))" :class="{occupied:occupied(7)}"><position-component pos="7" :product="occupied(7)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(12))" :class="{occupied:occupied(12)}"><position-component pos="12" :product="occupied(12)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(17))" :class="{occupied:occupied(17)}"><position-component pos="17" :product="occupied(17)"></position-component></td>
            </tr>
            <tr>
                <td @click="selectCurrentProduct(occupied(3))" :class="{occupied:occupied(3)}"><position-component pos="3" :product="occupied(3)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(8))" :class="{occupied:occupied(8)}"><position-component pos="8" :product="occupied(8)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(13))" :class="{occupied:occupied(13)}"><position-component pos="13" :product="occupied(13)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(18))" :class="{occupied:occupied(18)}"><position-component pos="18" :product="occupied(18)"></position-component></td>
            </tr>
            <tr>
                <td @click="selectCurrentProduct(occupied(4))" :class="{occupied:occupied(4)}"><position-component pos="4" :product="occupied(4)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(9))" :class="{occupied:occupied(9)}"><position-component pos="9" :product="occupied(9)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(14))" :class="{occupied:occupied(14)}"><position-component pos="14" :product="occupied(14)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(19))" :class="{occupied:occupied(19)}"><position-component pos="19" :product="occupied(19)"></position-component></td>
            </tr>
            <tr>
                <td @click="selectCurrentProduct(occupied(5))" :class="{occupied:occupied(5)}"><position-component pos="5" :product="occupied(5)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(10))" :class="{occupied:occupied(10)}"><position-component pos="10" :product="occupied(10)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(15))" :class="{occupied:occupied(15)}"><position-component pos="15" :product="occupied(15)"></position-component></td>
                <td @click="selectCurrentProduct(occupied(20))" :class="{occupied:occupied(20)}"><position-component pos="20" :product="occupied(20)"></position-component></td>
            </tr>
            <tr>
                <td colspan="4" class="wall">PARED</td>
            </tr>
        </table>
    </div>   
    <position-details-component :product="currentProduct" />
</div>
@endsection
@push('scripts')
    <script>
        Vue.component('position-details-component', {
            template: `<div class="col-4 align-self-center" v-if="product">
            <h2 class="text-center">Detalle de la Posición</h2>
                    <div class="invoice" >
                        <span><b>Producto:</b> @{{ product.product.name }}</span>
                        <br>
                        <span><b>Precio:</b> @{{ product.product.price }}</span>
                        <br>
                        <span><b>Posición:</b> @{{ product.position }}</span>
                        <br>
                        <span><b>Fecha Inventario:</b> @{{ product.created_at }}</span>
                    </div>
                </div>`,
            props: ['product'],
            data() {
                return {
                    
                }
            },
            mounted() {
                //
            },
            methods: {
                //
            }
        })

        Vue.component('position-component', {
            template: `<div>
                    <span>@{{ pos }}</span>
                    <span v-if="product">@{{":" + product.product.name }}</span>
                    <span v-else>:Disponible</span>
                </div>`,
            props: ['pos', 'product'],
            data() {
                return {
                    
                }
            },
            mounted() {
                //
            },
            methods: {
                //
            }
        })

        new Vue({
            el: '#app',
            data:{
                inventory: @json($inventory),
                currentProduct: false
            },
            mounted(){
                //console.log(this.inventory[10])
            },
            methods:{
                occupied(position){                    
                    pos = this.inventory.find(pos => {
                        return pos.position == position;
                    });

                    if (pos !== undefined) {
                        return pos;
                    }

                    return false;
                },
                selectCurrentProduct(product) {
                    this.currentProduct = product;
                }
            },
        });
    </script>
@endpush