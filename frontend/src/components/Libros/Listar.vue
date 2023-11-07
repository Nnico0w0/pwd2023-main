<script lang="ts">
import Boton from "../Boton.vue";

export default {
    data() {
        return {
            libros: [],
        };
    },
    created() {
        this.getLibros();
    },
    methods: {
        async getLibros() {
            await axios.get("http/localhost:8000/apiv1/libros").then(response => {
                this.libros = response.data;
            });
        }
    },
    components: { Boton }
}
</script>

<template>
    <div>
        <h1>Libros</h1>
        <router-link to="/crear">
            <div class="search">
                <input type="text" placeholder="Buscar libro" v-model="search">

            </div>
            <Boton texto="Nuevo" class="primary"></Boton>
        </router-link>
    </div>
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>TITULO</td>
                <td>AUTOR</td>
                <td>EDITORIAL</td>
                <td>AÑO</td>
                <td>CANTIDAD DE PAGINAS</td>
                <td>GENERO</td>
                <td>CATEGORIA</td>
                <td>ESTADO</td>
                <td>ACCIONES</td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="libros in libro" :key=libro.id>
                <td>{{ libros.id }}</td>
                <td>{{ libros.titulo }}</td>
                <td>{{ libros.autor }}</td>
                <td>{{ libros.editorial }}</td>
                <td>{{ libros.año }}</td>
                <td>{{ libros.cantidad_paginas }}</td>
                <td>{{ libros.genero }}</td>
                <td>{{ libros.categoria }}</td>
                <td>{{ libros.estado }}</td>
                <td>
                    <button @click="editarLibro(libros.id)">Editar</button>
                    <button @click="eliminarLibro(libros.id)">Eliminar</button>
                </td>
            </tr>


        </tbody>
    </table>
</template>
