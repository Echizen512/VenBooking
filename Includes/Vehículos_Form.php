<?php?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>VenBoocking-Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="favicon.png">
        <link href="css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css">
    </head>

    <body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]">

<!-- cargador de pantalla -->
    <div class="screen_loader animate__animated fixed inset-0 z-[60] grid place-content-center bg-[#fafafa] dark:bg-[#060818]">
        <svg width="64" height="64" viewbox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
            <path d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
                <animatetransform attributename="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s" repeatcount="indefinite"></animatetransform>
            </path>
            <path d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z">
                <animatetransform attributename="transform" type="rotate" from="0 67 67" to="360 67 67" dur="8s" repeatcount="indefinite"></animatetransform>
            </path>
        </svg>
    </div>

<!-- desplazarse al botón superior -->
    <div class="fixed bottom-6 right-6 z-50" x-data="scrollToTop">
        <template x-if="showTopButton">
            <button type="button" class="btn btn-outline-primary animate-pulse rounded-full p-2" @click="goToTop">
                <svg width="24" height="24" class="h-4 w-4" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M12 20.75C12.4142 20.75 12.75 20.4142 12.75 20L12.75 10.75L11.25 10.75L11.25 20C11.25 20.4142 11.5858 20.75 12 20.75Z" fill="currentColor"></path>
                    <path d="M6.00002 10.75C5.69667 10.75 5.4232 10.5673 5.30711 10.287C5.19103 10.0068 5.25519 9.68417 5.46969 9.46967L11.4697 3.46967C11.6103 3.32902 11.8011 3.25 12 3.25C12.1989 3.25 12.3897 3.32902 12.5304 3.46967L18.5304 9.46967C18.7449 9.68417 18.809 10.0068 18.6929 10.287C18.5768 10.5673 18.3034 10.75 18 10.75L6.00002 10.75Z" fill="currentColor"></path>
                </svg>
            </button>
        </template>
    </div>

<!--main-->
    <div class="main-container min-h-screen text-black dark:text-white-dark">
    <div x-data="auth">
        <div class="absolute inset-0">
            <img src="assets/images/auth/bg-gradient.png" alt="image" class="h-full w-full object-cover">
        </div>

        <div class="relative flex min-h-screen items-center justify-center bg-[url(../images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
           
<!--Recuadro degradado-->
    <div class="relative w-full max-w-[870px] rounded-md bg-[linear-gradient(45deg,#fff9f9_0%,rgba(255,255,255,0)_25%,rgba(255,255,255,0)_75%,_#fff9f9_100%)] p-2 dark:bg-[linear-gradient(52.22deg,#0E1726_0%,rgba(14,23,38,0)_18.66%,rgba(14,23,38,0)_51.04%,rgba(14,23,38,0)_80.07%,#0E1726_100%)]">
    <div class="relative flex flex-col justify-center rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 px-6 lg:min-h-[758px] py-20">

<!--bonton de modo oscuro-->
    <div class="absolute top-6 end-6">
            <a href="javascript:;" x-show="$store.app.theme === 'light'" class="flex items-center rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60" @click="$store.app.toggleTheme('dark')">
                
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="1.5"></circle>
                    <path d="M12 2V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    <path d="M12 20V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    <path d="M4 12L2 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    <path d="M22 12L20 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    <path opacity="0.5" d="M19.7778 4.22266L17.5558 6.25424" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    <path opacity="0.5" d="M4.22217 4.22266L6.44418 6.25424" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    <path opacity="0.5" d="M6.44434 17.5557L4.22211 19.7779" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    <path opacity="0.5" d="M19.7778 19.7773L17.5558 17.5551" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                </svg></a>
            <a href="javascript:;" x-show="$store.app.theme === 'dark'" class="flex items-center rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60" @click="$store.app.toggleTheme('system')" style="display: none;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.0672 11.8568L20.4253 11.469L21.0672 11.8568ZM12.1432 2.93276L11.7553 2.29085V2.29085L12.1432 2.93276ZM21.25 12C21.25 17.1086 17.1086 21.25 12 21.25V22.75C17.9371 22.75 22.75 17.9371 22.75 12H21.25ZM12 21.25C6.89137 21.25 2.75 17.1086 2.75 12H1.25C1.25 17.9371 6.06294 22.75 12 22.75V21.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75V1.25C6.06294 1.25 1.25 6.06294 1.25 12H2.75ZM15.5 14.25C12.3244 14.25 9.75 11.6756 9.75 8.5H8.25C8.25 12.5041 11.4959 15.75 15.5 15.75V14.25ZM20.4253 11.469C19.4172 13.1373 17.5882 14.25 15.5 14.25V15.75C18.1349 15.75 20.4407 14.3439 21.7092 12.2447L20.4253 11.469ZM9.75 8.5C9.75 6.41182 10.8627 4.5828 12.531 3.57467L11.7553 2.29085C9.65609 3.5593 8.25 5.86509 8.25 8.5H9.75ZM12 2.75C11.9115 2.75 11.8077 2.71008 11.7324 2.63168C11.6686 2.56527 11.6538 2.50244 11.6503 2.47703C11.6461 2.44587 11.6482 2.35557 11.7553 2.29085L12.531 3.57467C13.0342 3.27065 13.196 2.71398 13.1368 2.27627C13.0754 1.82126 12.7166 1.25 12 1.25V2.75ZM21.7092 12.2447C21.6444 12.3518 21.5541 12.3539 21.523 12.3497C21.4976 12.3462 21.4347 12.3314 21.3683 12.2676C21.2899 12.1923 21.25 12.0885 21.25 12H22.75C22.75 11.2834 22.1787 10.9246 21.7237 10.8632C21.286 10.804 20.7293 10.9658 20.4253 11.469L21.7092 12.2447Z" fill="currentColor"></path>
                </svg>
            </a>
            <a href="javascript:;" x-show="$store.app.theme === 'system'" class="flex items-center rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60" @click="$store.app.toggleTheme('light')" style="display: none;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 9C3 6.17157 3 4.75736 3.87868 3.87868C4.75736 3 6.17157 3 9 3H15C17.8284 3 19.2426 3 20.1213 3.87868C21 4.75736 21 6.17157 21 9V14C21 15.8856 21 16.8284 20.4142 17.4142C19.8284 18 18.8856 18 17 18H7C5.11438 18 4.17157 18 3.58579 17.4142C3 16.8284 3 15.8856 3 14V9Z" stroke="currentColor" stroke-width="1.5"></path>
                    <path opacity="0.5" d="M22 21H2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                    <path opacity="0.5" d="M15 15H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                </svg>
            </a>
    </div>

<!--Formulario-->
<div class="mx-auto w-full max-w-[440px]">
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold uppercase !leading-snug text-primary md:text-4xl">Registro de Vehículos</h1>
        <p class="text-base font-bold leading-normal text-white-dark">Ingrese los detalles del vehículo para registrar en el sistema.</p>
    </div>
    <form class="space-y-5 dark:text-white" @submit.prevent="window.location='index.html'">
        <div>
            <label for="id_posada">ID Posada</label>
            <div class="relative text-white-dark">
                <select id="id_posada" class="form-select ps-10 placeholder:text-white-dark">
                    <option selected>Seleccione una posada</option>
                    <option value="1">Posada 1</option>
                    <option value="2">Posada 2</option>
                    <option value="3">Posada 3</option>
                </select>
            </div>
        </div>
        <div>
            <label for="tipo">Tipo</label>
            <div class="relative text-white-dark">
                <select id="tipo" class="form-select ps-10 placeholder:text-white-dark">
                    <option selected>Seleccione el tipo de vehículo</option>
                    <option value="Carro">Carro</option>
                    <option value="Moto">Moto</option>
                    <option value="Lancha">Lancha</option>
                </select>
            </div>
        </div>
        <div>
            <label for="marca">Marca</label>
            <div class="relative text-white-dark">
                <input id="marca" type="text" class="form-input ps-10 placeholder:text-white-dark" placeholder="Ingrese la marca del vehículo">
            </div>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" class="form-input ps-10 placeholder:text-white-dark" rows="3" placeholder="Ingrese una descripción del vehículo"></textarea>
        </div>
        <div>
            <label for="precio">Precio</label>
            <input id="precio" type="number" class="form-input ps-10 placeholder:text-white-dark" placeholder="Ingrese el precio del vehículo">
        </div>
        <div>
            <label for="capacidad">Capacidad</label>
            <input id="capacidad" type="number" class="form-input ps-10 placeholder:text-white-dark" placeholder="Ingrese la capacidad del vehículo">
        </div>
        <div>
            <label for="año">Año</label>
            <input id="año" type="number" class="form-input ps-10 placeholder:text-white-dark" placeholder="Ingrese el año del vehículo">
        </div>
        <div>
            <label for="modelo">Modelo</label>
            <input id="modelo" type="text" class="form-input ps-10 placeholder:text-white-dark" placeholder="Ingrese el modelo del vehículo">
        </div>
        <div>
            <label for="estado">Estado</label>
            <input id="estado" type="text" class="form-input ps-10 placeholder:text-white-dark" placeholder="Ingrese el estado del vehículo">
        </div>
        <div>
            <label for="placa">Placa</label>
            <input id="placa" type="text" class="form-input ps-10 placeholder:text-white-dark" placeholder="Ingrese la placa del vehículo">
        </div>
        <div>
            <label for="image_url">URL de la Imagen</label>
            <input id="image_url" type="text" class="form-input ps-10 placeholder:text-white-dark" placeholder="Ingrese la URL de la imagen del vehículo">
        </div>
        <button type="submit" class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">Registrar Vehículo</button>
    </form>
    <div class="relative my-7 text-center md:mb-9">
        <span class="absolute inset-x-0 top-1/2 h-px w-full -translate-y-1/2 bg-white-light dark:bg-white-dark"></span>
    </div>
    <br>
    <div class="text-center dark:text-white">
        <a href="index.html" class="text-primary">Volver al inicio</a>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!--Script-->
        <script src="assets/js/alpine-collaspe.min.js"></script>
        <script src="assets/js/alpine-persist.min.js"></script>
        <script defer="" src="assets/js/alpine-ui.min.js"></script>
        <script defer="" src="assets/js/alpine-focus.min.js"></script>
        <script defer="" src="assets/js/alpine.min.js"></script>

        <script src="assets/js/custom.js"></script>

        <script>
            // main section
            document.addEventListener('alpine:init', () => {
                Alpine.data('scrollToTop', () => ({
                    showTopButton: false,
                    init() {
                        window.onscroll = () => {
                            this.scrollFunction();
                        };
                    },

                    scrollFunction() {
                        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                            this.showTopButton = true;
                        } else {
                            this.showTopButton = false;
                        }
                    },

                    goToTop() {
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 0;
                    },
                }));
                </script>

    </body>
</html>