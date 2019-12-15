<template>
    <form>
        <div class="form-group">
            <label for="Product">Producto</label>
            <select v-model="product" @change="selectChange($event)" id="product_id" name="product_id" class="form-control" >
                <option value="" >Seleccione</option>  
                <option v-for="product in products" :value="product.id" :object="product.name">
                    {{ product.name }}
                </option>                
            </select>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="qty">Cantidad</label>
                    <input v-model="qty" type="number" value="" value="1" min="1" id="qty" name="qty" class="form-control" >
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Agregar</button>
        <a class="btn btn-secondary" href="">Cancelar</a>
    </form>
</template>

<script>
    export default {
        data(){
            return  {
                products: [],
                product: null
            }
        },
        mounted() {
            axios.get("/products/all").then(res => {
                this.products=res.data;
            })
        },
        methods:{
            selectChange(event){
                console.log(event.target.object);
                //EventBus.$emit('change-product',product)
            }
        }
    }
</script>
