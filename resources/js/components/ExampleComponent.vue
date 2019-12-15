<template>
    <div>
        <div class="col-md-8 offset-md-2">
            <div class="invoice">
                <div class="orden text-center">
                    <div id="number">Factura #</div>
                    <div class="text-center">Productos</div>
                    <div>
                        <table id="products" class="table table-striped" >
                            <thead>
                                <tr>
                                    <td>Nombre</td>
                                    <td>Cantidad</td>
                                    <td>Precio</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{name}}</td>
                                    <td>{{qty}}</td>
                                    <td>500</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">Total $1500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="formaspago" class="col-md-12">
                        <table id="tableformas" class="table text-right" >
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div id="cambio" class="col-md-12">
                        <table id="tablecambio" class="table text-right" >
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <button type="button" id="generar" class="btn btn-success text-center">Generar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                name : 'ss',
                qty : 1
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
