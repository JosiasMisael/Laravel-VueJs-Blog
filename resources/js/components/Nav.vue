<template>
                    <nav class="custom-wrapper" id="menu">
                    <div class="pure-menu"></div>
                    <ul class="container-flex list-unstyled">
                        <li>
                            <router-link :to="{ name: 'home' }" class="text-uppercase">Inicio</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'about' }" class="text-uppercase">Nosotros</router-link>

                        </li>
                        <li>
                            <router-link :to="{ name: 'archive' }" class="text-uppercase">Archivo</router-link>

                        </li>
                        <li>
                            <router-link :to="{ name: 'contact' }" class="text-uppercase">Contacto</router-link>

                        </li>
                    </ul>
                </nav>

</template>
