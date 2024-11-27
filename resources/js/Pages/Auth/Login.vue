<script setup>
import { ref, onMounted } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const isAnimationComplete = ref(false);
const showPassword = ref(false);
const focusedInput = ref(null);

// Generate particle positions
const particles = ref([]);
const generateParticles = () => {
    particles.value = Array.from({ length: 20 }, (_, i) => ({
        id: i,
        x: Math.random() * 100,
        y: Math.random() * 100,
        size: Math.random() * 30 + 10,
        delay: Math.random() * 3,
    }));
};

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

onMounted(() => {
    generateParticles();

    // Trigger animation after component mount
    setTimeout(() => {
        isAnimationComplete.value = true;
    }, 100);
});
</script>

<style scoped>
/* Animasi Kustom */
@keyframes float {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes shake {
    0%,
    100% {
        transform: translateX(0);
    }
    10%,
    30%,
    50%,
    70%,
    90% {
        transform: translateX(-5px);
    }
    20%,
    40%,
    60%,
    80% {
        transform: translateX(5px);
    }
}

.animate-float {
    animation: float 4s infinite ease-in-out;
}

.animate-fade-in {
    animation: fadeIn 1s ease-out forwards;
    opacity: 0;
}

.animate-fade-in-delay {
    animation: fadeIn 1s ease-out 0.5s forwards;
    opacity: 0;
}

.animate-slide-in {
    animation: slideIn 1s ease-out forwards;
    opacity: 0;
}

.animate-slide-in-delay {
    animation: slideIn 1s ease-out 0.3s forwards;
    opacity: 0;
}

.animate-slide-in-delay-2 {
    animation: slideIn 1s ease-out 0.6s forwards;
    opacity: 0;
}

.animate-slide-in-delay-3 {
    animation: slideIn 1s ease-out 0.9s forwards;
    opacity: 0;
}

.animate-slide-in-delay-4 {
    animation: slideIn 1s ease-out 1.2s forwards;
    opacity: 0;
}

.animate-shake {
    animation: shake 0.5s;
}
</style>

<template>
    <div class="min-h-screen flex overflow-hidden">
        <!-- Sisi Kiri: Area Gambar dengan Animasi -->
        <div
            class="w-1/2 bg-cover bg-center relative overflow-hidden"
            :style="{ backgroundImage: `url('/images/Background.png')` }"
        >
            <!-- Animasi Partikel Latar Belakang -->
            <div
                v-for="particle in particles"
                :key="particle.id"
                class="absolute rounded-full bg-white bg-opacity-20 animate-float"
                :style="{
                    left: `${particle.x}%`,
                    top: `${particle.y}%`,
                    width: `${particle.size}px`,
                    height: `${particle.size}px`,
                    animationDelay: `${particle.delay}s`,
                }"
            ></div>

            <!-- Overlay Konten dengan Animasi -->
            <div
                class="absolute inset-0 flex items-center justify-center bg-opacity-50 bg-black"
            >
                <div
                    class="text-white text-center transform transition-all duration-1000 ease-in-out"
                    :class="{
                        'translate-x-0 opacity-100': isAnimationComplete,
                        '-translate-x-10 opacity-0': !isAnimationComplete,
                    }"
                >
                    <h1 class="text-4xl font-bold mb-4 animate-fade-in">
                        Finance Management System
                    </h1>
                    <p class="text-xl animate-fade-in-delay">
                        Kelola Keuangan Anda dengan Mudah
                    </p>
                </div>
            </div>
        </div>

        <!-- Sisi Kanan: Form Login dengan Animasi -->
        <div class="w-1/2 flex items-center justify-center bg-gray-100 p-8">
            <div
                class="w-full max-w-md transform transition-all duration-1000 ease-in-out"
                :class="{
                    'translate-x-0 opacity-100': isAnimationComplete,
                    'translate-x-10 opacity-0': !isAnimationComplete,
                }"
            >
                <h2
                    class="text-2xl font-bold mb-6 text-center animate-slide-in"
                >
                    Login to Your Account
                </h2>

                <!-- Tombol Login Sosial Media dalam Dua Baris -->
                <div class="mb-4 space-y-3 animate-slide-in-delay">
                    <div class="flex space-x-3">
                        <button
                            @click="loginWithGoogle"
                            class="flex-1 flex items-center justify-center bg-white border border-gray-300 rounded-lg shadow-md px-2 py-2 text-gray-900 hover:bg-gray-100 transition-colors"
                        >
                            <svg
                                class="w-5 h-5 mr-2"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 48 48"
                            >
                                <path
                                    fill="#4285F4"
                                    d="M45.12 24.5c0-1.56-.14-3.06-.4-4.5H24v8.51h11.84c-.51 2.75-2.06 5.08-4.39 6.64v5.52h7.11c4.16-3.83 6.56-9.47 6.56-16.17z"
                                />
                                <path
                                    fill="#34A853"
                                    d="M24 46c5.94 0 10.92-1.97 14.56-5.33l-7.11-5.52c-1.97 1.32-4.49 2.1-7.45 2.1-5.73 0-10.58-3.87-12.32-9.07H4.34v5.7C7.96 41.07 15.4 46 24 46z"
                                />
                                <path
                                    fill="#FBBC05"
                                    d="M11.68 28.18c-1.11-3.3-1.11-6.88 0-10.18V12.3H4.34A23.952 23.952 0 0 0 0 24c0 3.86.93 7.5 2.59 10.7l7.09-5.52z"
                                />
                                <path
                                    fill="#EA4335"
                                    d="M24 9.75c3.23 0 6.13 1.11 8.41 3.29l6.31-6.31C34.91 3.21 29.72 1 24 1 15.4 1 7.96 5.93 4.34 14.3l7.34 5.7C13.42 13.62 18.27 9.75 24 9.75z"
                                />
                            </svg>
                            Google
                        </button>

                        <button
                            @click="loginWithFacebook"
                            class="flex-1 flex items-center justify-center bg-white border border-gray-300 rounded-lg shadow-md px-2 py-2 text-gray-900 hover:bg-gray-100 transition-colors"
                        >
                            <svg
                                class="w-5 h-5 mr-2"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 48 48"
                            >
                                <path
                                    fill="#3F51B5"
                                    d="M24 4C12.954 4 4 12.954 4 24s8.954 20 20 20 20-8.954 20-20S35.046 4 24 4z"
                                />
                                <path
                                    fill="#FFF"
                                    d="M29.707 19.5h-4.207v-4c0-1.104.896-2 2-2h2V9h-4a6 6 0 0 0-6 6v4.5h-4v6h4V39h7v-13.5h4.293l1-6z"
                                />
                            </svg>
                            Facebook
                        </button>
                    </div>

                    <div class="flex space-x-3">
                        <button
                            @click="loginWithGithub"
                            class="flex-1 flex items-center justify-center bg-white border border-gray-300 rounded-lg shadow-md px-2 py-2 text-gray-900 hover:bg-gray-100 transition-colors"
                        >
                            <svg
                                class="w-6 h-6 text-gray-800 dark:text-white"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    fill="#000"
                                    d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            GitHub
                        </button>

                        
                        <button
                            @click="loginWithLinkedIn"
                            class="flex-1 flex items-center justify-center bg-white border border-gray-300 rounded-lg shadow-md px-2 py-2 text-gray-900 hover:bg-gray-100 transition-colors"
                        >
                            <svg
                                class="w-5 h-5 mr-2"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 48 48"
                            >
                                <path
                                    fill="#0077B5"
                                    d="M42,37c0,2.762-2.238,5-5,5H11c-2.762,0-5-2.238-5-5V11c0-2.762,2.238-5,5-5h26c2.762,0,5,2.238,5,5V37z"
                                />
                                <path
                                    fill="#FFF"
                                    d="M12 19h5v17h-5zm2.485-2h.035c1.752 0 2.836-1.163 2.836-2.61C17.321 13.95 16.268 13 14.534 13c-1.736 0-2.836 1.009-2.836 2.614C11.698 17.437 12.734 18.5 14.485 18.5zM36 36h-5v-9.1c0-2.398-1.215-4.084-3.342-4.084-1.736 0-2.706 1.182-3.158 2.325-.162.395-.2.94-.2 1.494V36h-5V19h5v2.645h.07c.816-1.406 2.542-2.81 5.241-2.81 3.558 0 6.362 2.344 6.362 7.393V36z"
                                />
                            </svg>
                            LinkedIn
                        </button>
                    </div>
                </div>

                <!-- Pembatas -->
                <div class="relative my-4 animate-slide-in-delay-2">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-gray-100 px-3 text-gray-500">Or</span>
                    </div>
                </div>

                <!-- Form Login Biasa -->
                <form @submit.prevent="submit" class="space-y-4">
                    <div class="animate-slide-in-delay-3">
                        <label
                            class="block text-gray-700 text-sm font-bold mb-2"
                            for="email"
                        >
                            Email
                        </label>
                        <input
                            v-model="form.email"
                            type="email"
                            id="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline transition-all duration-300 ease-in-out"
                            :class="{
                                'border-red-500': form.errors.email,
                                'hover:border-indigo-500 focus:border-indigo-600':
                                    !form.errors.email,
                            }"
                            required
                        />
                        <p
                            v-if="form.errors.email"
                            class="text-red-500 text-xs italic animate-shake"
                        >
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <div class="animate-slide-in-delay-4">
                        <label
                            class="block text-gray-700 text-sm font-bold mb-2"
                            for="password"
                        >
                            Password
                        </label>
                        <div class="relative">
                            <input
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline transition-all duration-300 ease-in-out"
                                :class="{
                                    'border-red-500': form.errors.password,
                                    'hover:border-indigo-500 focus:border-indigo-600':
                                        !form.errors.password,
                                }"
                                required
                            />
                            <button
                                type="button"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-indigo-600 transition-colors"
                                @click="showPassword = !showPassword"
                            >
                                <i
                                    class="fas"
                                    :class="
                                        showPassword ? 'fa-eye-slash' : 'fa-eye'
                                    "
                                ></i>
                            </button>
                        </div>
                        <p
                            v-if="form.errors.password"
                            class="text-red-500 text-xs italic animate-shake"
                        >
                            {{ form.errors.password }}
                        </p>
                    </div>

                    <div
                        class="flex items-center justify-between mb-4 animate-slide-in-delay-5"
                    >
                        <label class="inline-flex items-center">
                            <input
                                v-model="form.remember"
                                type="checkbox"
                                class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                            />
                            <span class="ml-2 text-gray-700">Remember Me</span>
                        </label>

                        <Link
                            :href="route('password.request')"
                            class="inline-block align-baseline font-bold text-sm text-indigo-500 hover:text-indigo-800 transition-colors"
                        >
                            Forgot Password?
                        </Link>
                    </div>

                    <div class="animate-slide-in-delay-6">
                        <button
                            type="submit"
                            class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-indigo-700 transition-colors duration-300 transform hover:scale-105"
                            :disabled="form.processing"
                        >
                            {{ form.processing ? "Memproses..." : "Login" }}
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4 animate-fade-in-delay">
                    <p class="text-gray-600">
                        Don't have an account?
                        <Link
                            :href="route('register')"
                            class="text-indigo-500 hover:text-indigo-700 font-bold transition-colors"
                        >
                            Sign up
                        </Link>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
