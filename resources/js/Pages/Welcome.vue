<script setup>
import { ref, computed, onMounted } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import { 
    BarChart, 
    Wallet, 
    LineChart, 
    Shield, 
    CreditCard, 
    Trophy,
    Users, 
    ArrowRight, 
    Bot, 
    Activity, 
    ShieldCheck, 
    Calculator,
    Check 
} from "lucide-vue-next";

// Props
const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

// Page and Auth
const page = usePage();
const isLoggedIn = computed(() => !!page.props.auth?.user);

// Navigation and Scroll
const hoveredItem = ref(null);
const activeSection = ref("home");
const navItems = [
    { href: "#home", label: "Home" },
    { href: "#products", label: "Product" },
    { href: "#services", label: "Features" },
    { href: "#pricing", label: "Pricing" },
    { href: "#about", label: "About" },
];

// Scroll handling
const handleScroll = () => {
    const sections = ["home", "products", "services", "pricing", "about"];
    const scrollPosition = window.scrollY;

    sections.forEach((section) => {
        const element = document.getElementById(section);
        if (element) {
            const { offsetTop, offsetHeight } = element;
            if (
                scrollPosition >= offsetTop - 100 &&
                scrollPosition < offsetTop + offsetHeight - 100
            ) {
                activeSection.value = section;
                // Update URL without page reload
                window.history.replaceState(null, null, `#${section}`);
            }
        }
    });
};

// Smooth scroll function
const scrollToSection = (href) => {
    const targetId = href.replace("#", "");
    const element = document.getElementById(targetId);
    if (element) {
        window.scrollTo({
            top: element.offsetTop - 80, // Adjust for navbar height
            behavior: "smooth",
        });
    }
};

// Initialize scroll listener
onMounted(() => {
    window.addEventListener("scroll", handleScroll);
    // Initial scroll to hash if present
    if (window.location.hash) {
        setTimeout(() => {
            scrollToSection(window.location.hash);
        }, 100);
    }
});

const selectedPlan = ref(null);
const isAnimating = ref(false);

// Fungsi untuk menangani klik
const handleCardClick = (planId) => {
    if (isAnimating.value) return;

    isAnimating.value = true;
    selectedPlan.value = planId;

    // Reset animasi setelah selesai
    setTimeout(() => {
        isAnimating.value = false;
    }, 400);
};

// Pricing Data
const plans = [
    {
        id: "basic",
        name: "Basic",
        price: "29",
        isPopular: false,
        features: [
            "Basic Financial Reports",
            "Up to 100 Transactions/month",
            "Email Support",
            "Basic Analytics Dashboard",
            "Single User Account",
        ],
    },
    {
        id: "pro",
        name: "Professional",
        price: "99",
        isPopular: true,
        features: [
            "Advanced Financial Reports",
            "Unlimited Transactions",
            "24/7 Priority Support",
            "Advanced Analytics",
            "Multi-User Access",
            "Invoice Generation",
            "Tax Calculator",
        ],
    },
    {
        id: "enterprise",
        name: "Enterprise",
        price: "299",
        isPopular: false,
        features: [
            "Custom Financial Solutions",
            "Dedicated Account Manager",
            "API Access",
            "White-label Options",
            "Custom Integration",
            "Advanced Security Features",
            "Unlimited Everything",
        ],
    },
];

//products
const products = [
    {
        title: "Smart Budgeting",
        description:
            "Take control of your finances with our intelligent budgeting system that adapts to your spending patterns.",
        icon: Wallet,
        features: [
            "Automated expense categorization",
            "Custom budget templates",
            "Real-time spending alerts",
            "Monthly financial reports",
        ],
        link: "/budgeting",
    },
    {
        title: "Investment Analytics",
        description:
            "Make informed investment decisions with our comprehensive analytics and portfolio management tools.",
        icon: LineChart,
        features: [
            "Portfolio performance tracking",
            "Market trend analysis",
            "Risk assessment tools",
            "Investment recommendations",
        ],
        link: "/investments",
    },
    {
        title: "Secure Banking",
        description:
            "Experience seamless and secure banking integration with real-time transaction monitoring.",
        icon: Shield,
        features: [
            "Bank account integration",
            "Secure transactions",
            "Fraud detection",
            "24/7 monitoring",
        ],
        link: "/banking",
    },
    {
        title: "Expense Tracking",
        description:
            "Track every penny with our advanced expense monitoring and categorization system.",
        icon: CreditCard,
        features: [
            "Receipt scanning",
            "Automatic categorization",
            "Expense reports",
            "Tax preparation",
        ],
        link: "/expenses",
    },
    {
        title: "Financial Planning",
        description:
            "Plan your future with our comprehensive financial planning and goal-setting tools.",
        icon: Trophy,
        features: [
            "Retirement planning",
            "Goal tracking",
            "Savings projections",
            "Wealth management",
        ],
        link: "/planning",
    },
    {
        title: "Group Finance",
        description:
            "Manage shared expenses and group finances with ease using our collaborative tools.",
        icon: Users,
        features: [
            "Shared budgets",
            "Bill splitting",
            "Group expense tracking",
            "Payment reminders",
        ],
        link: "/group-finance",
    },
];

//services
const services = [
    {
        title: "AI Financial Insights",
        description: "Leverage cutting-edge AI to gain deep insights into your financial patterns and potential investment opportunities.",
        icon: Bot,
        features: [
            "Predictive financial analysis",
            "Machine learning recommendations",
            "Risk assessment algorithms",
            "Personalized financial strategies"
        ]
    },
    {
        title: "Real-time Portfolio Tracking",
        description: "Monitor your investments with precision and get instant updates on market changes and portfolio performance.",
        icon: Activity,
        features: [
            "Live market data",
            "Performance visualization",
            "Asset allocation tracking",
            "Instant notifications"
        ]
    },
    {
        title: "Financial Security",
        description: "Advanced security protocols to ensure your financial data and transactions are protected at all times.",
        icon: ShieldCheck,
        features: [
            "End-to-end encryption",
            "Multi-factor authentication",
            "Fraud detection system",
            "Regular security audits"
        ]
    },
    {
        title: "Tax Optimization",
        description: "Intelligent tax planning tools to help you minimize tax liabilities and maximize financial efficiency.",
        icon: Calculator,
        features: [
            "Tax strategy recommendations",
            "Deduction identification",
            "Investment tax optimization",
            "Annual tax planning"
        ]
    }
];
</script>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
@keyframes cardClick {
    0% {
        transform: scale(1);
    }
    40% {
        transform: scale(0.95);
    }
    80% {
        transform: scale(1.02);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes ripple {
    0% {
        box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
    }
    100% {
        box-shadow: 0 0 0 20px rgba(59, 130, 246, 0);
    }
}

@keyframes shake {
    0%,
    100% {
        transform: translateX(0);
    }
    25% {
        transform: translateX(-2px);
    }
    75% {
        transform: translateX(2px);
    }
}

@keyframes floatIcon {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

@keyframes glowBorder {
    0%,
    100% {
        border-color: rgba(59, 130, 246, 0.5);
    }
    50% {
        border-color: rgba(59, 130, 246, 0.8);
    }
}

.card-click {
    animation: cardClick 0.4s ease-out, ripple 0.8s ease-out;
}

.feature-shake {
    animation: shake 0.4s ease-in-out;
}

html {
    scroll-behavior: smooth;
}
</style>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Navbar -->
        <nav
            class="fixed top-0 w-full z-50 bg-white/90 dark:bg-gray-800/90 shadow backdrop-blur-sm"
        >
            <div class="container mx-auto px-4 py-4">
                <div class="flex justify-between items-center">
                    <!-- Logo with fade animation -->
                    <div
                        class="flex items-center justify-center text-xl font-bold text-gray-800 dark:text-gray-200 opacity-0 animate-[fadeIn_0.5s_ease-in_forwards]"
                    >
                        <a
                            href="#home"
                            @click.prevent="scrollToSection('#home')"
                            class="hover:opacity-75 transition-opacity duration-300 flex items-center"
                        >
                            <img
                                src="/images/Finance.svg"
                                class="h-8 me-3"
                                alt="logo"
                            />
                            MONEYWISE
                        </a>
                    </div>

                    <!-- Navigation Links with slide animation -->
                    <div class="flex-1 flex justify-center space-x-6">
                        <a
                            v-for="(item, index) in navItems"
                            :key="item.href"
                            :href="item.href"
                            @click.prevent="scrollToSection(item.href)"
                            @mouseenter="hoveredItem = item.href"
                            @mouseleave="hoveredItem = null"
                            class="relative font-semibold py-2 transition-all duration-300 opacity-0"
                            :style="{
                                animation: `slideDown 0.5s ease-out ${
                                    index * 0.1
                                }s forwards`,
                            }"
                            :class="[
                                activeSection === item.href.replace('#', '')
                                    ? 'text-blue-600 dark:text-blue-400'
                                    : 'text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white',
                            ]"
                        >
                            {{ item.label }}
                            <div
                                class="absolute bottom-0 left-0 h-0.5 bg-blue-600 dark:bg-blue-400 transition-all duration-300"
                                :class="[
                                    hoveredItem === item.href ||
                                    activeSection === item.href.replace('#', '')
                                        ? 'w-full'
                                        : 'w-0',
                                ]"
                            />
                        </a>
                    </div>

                    <!-- Auth Buttons with fade animation -->
                    <div
                        class="ml-auto flex space-x-4 opacity-0 animate-[fadeIn_0.5s_ease-in_0.5s_forwards]"
                    >
                        <template v-if="!isLoggedIn">
                            <Link
                                v-if="canLogin"
                                href="/login"
                                class="px-4 py-2 rounded-full bg-cyan-500 text-white border-2 border-transparent hover:bg-transparent hover:text-cyan-500 hover:border-cyan-500 transition-all duration-300 transform hover:scale-105"
                            >
                                Log In
                            </Link>
                            <Link
                                v-if="canRegister"
                                href="/register"
                                class="px-4 py-2 rounded-full border-2 border-cyan-500 text-cyan-500 hover:text-white hover:bg-cyan-500 transition-all duration-300 transform hover:scale-105"
                            >
                                Sign Up
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <!-- Hero Section -->
            <section
                id="home"
                class="pt-20 bg-gradient-to-r from-blue-600 to-cyan-600 text-white min-h-screen flex items-center"
            >
                <div class="container mx-auto px-4 py-20">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between"
                    >
                        <div
                            class="md:w-1/2 mb-10 md:mb-0 opacity-0 animate-[slideInLeft_1s_ease-out_forwards]"
                        >
                            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                                Smart Financial Solutions for Your Future
                            </h1>
                            <p class="text-xl mb-8">
                                Advanced analytics and expert insights to grow
                                your wealth
                            </p>
                            <a
                                href="#products"
                                @click.prevent="scrollToSection('#products')"
                                class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition-colors inline-block"
                            >
                                Get Started
                            </a>
                        </div>
                        <div
                            class="md:w-1/2 h-[300px] bg-white/10 rounded-lg p-4 opacity-0 animate-[slideInRight_1s_ease-out_forwards]"
                        >
                            <div
                                class="h-full w-full flex items-center justify-center"
                            >
                                <BarChart class="w-16 h-16 text-white" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section
        id="products"
        class="py-20 bg-white dark:bg-gray-800 min-h-screen flex items-center"
    >
        <div class="container mx-auto px-4">
            <h2
                class="text-3xl font-bold text-center mb-12 dark:text-white opacity-0 animate-[fadeIn_1s_ease-out_forwards]"
            >
                Our Financial Solutions
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="(product, index) in products"
                    :key="index"
                    class="rounded-lg border bg-white dark:bg-gray-700 shadow-sm hover:shadow-lg transition-all duration-500 p-6 opacity-0 hover:border-blue-500 group"
                    :style="{
                        animation: `slideUp 0.5s ease-out ${index * 0.2}s forwards`,
                        animationFillMode: 'forwards',
                    }"
                >
                    <div class="flex flex-col space-y-4">
                        <div class="group-hover:animate-[floatIcon_2s_ease-in-out_infinite]">
                            <component
                                :is="product.icon"
                                class="h-12 w-12 text-blue-600 transition-transform duration-300 group-hover:scale-110"
                            />
                        </div>
                        <h3
                            class="text-xl font-semibold dark:text-white group-hover:text-blue-600 transition-colors duration-300"
                        >
                            {{ product.title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ product.description }}
                        </p>
                        <div class="mt-4 flex-grow">
                            <ul class="space-y-2">
                                <li
                                    v-for="(feature, featureIndex) in product.features"
                                    :key="featureIndex"
                                    class="flex items-center text-sm text-gray-600 dark:text-gray-300 group-hover:transform group-hover:translate-x-2 transition-transform duration-300"
                                    :style="{
                                        transitionDelay: `${featureIndex * 100}ms`,
                                    }"
                                >
                                    <Check
                                        class="h-4 w-4 text-green-500 mr-2 group-hover:text-blue-500 transition-colors duration-300"
                                    />
                                    {{ feature }}
                                </li>
                            </ul>
                        </div>
                        <Link
                            :href="product.link"
                            class="mt-6 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-300 hover:scale-105 group-hover:animate-[glowBorder_2s_ease-in-out_infinite]"
                        >
                            Learn More
                            <ArrowRight
                                class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-300"
                            />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
            </section>

            <!-- Services Section -->
            <section 
        id="services"
        class="py-20 bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center"
    >
        <div class="container mx-auto px-4">
            <h2 
                class="text-3xl font-bold text-center mb-12 dark:text-white opacity-0 animate-[fadeIn_1s_ease-out_forwards]"
            >
                Our Services
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div 
                    v-for="(service, index) in services"
                    :key="service.title || index"
                    class="rounded-lg border bg-white dark:bg-gray-700 shadow-sm hover:shadow-lg transition-all duration-500 p-6 opacity-0 hover:border-blue-500 group"
                    :style="{
                        animation: `slideUp 0.5s ease-out ${index * 0.2}s forwards`,
                        animationFillMode: 'forwards'
                    }"
                >
                    <div class="flex flex-col space-y-4">
                        <div class="group-hover:animate-[floatIcon_2s_ease-in-out_infinite]">
                            <!-- Dynamically import Lucide icons -->
                            <component
                                :is="import(`lucide-vue-next/${service.icon}`)"
                                class="h-12 w-12 text-blue-600 transition-transform duration-300 group-hover:scale-110"
                            />
                        </div>
                        <h3 
                            class="text-xl font-semibold dark:text-white group-hover:text-blue-600 transition-colors duration-300"
                        >
                            {{ service.title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ service.description }}
                        </p>
                        <div class="mt-4 flex-grow">
                            <ul class="space-y-2">
                                <li
                                    v-for="(feature, featureIndex) in service.features"
                                    :key="featureIndex"
                                    class="flex items-center text-sm text-gray-600 dark:text-gray-300 group-hover:transform group-hover:translate-x-2 transition-transform duration-300"
                                    :style="{
                                        transitionDelay: `${featureIndex * 100}ms`
                                    }"
                                >
                                    <Check 
                                        class="h-4 w-4 text-green-500 mr-2 group-hover:text-blue-500 transition-colors duration-300"
                                    />
                                    {{ feature }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            <!-- Pricing Section -->
            <section
                id="pricing"
                class="py-20 bg-white dark:bg-gray-800 min-h-screen flex items-center"
            >
                <div class="container mx-auto px-4">
                    <h2
                        class="text-3xl font-bold text-center mb-12 dark:text-white opacity-0 animate-[fadeIn_1s_ease-out_forwards]"
                    >
                        Pricing Plans
                    </h2>
                    <div
                        class="flex flex-col lg:flex-row gap-8 justify-center items-stretch"
                    >
                        <div
                            v-for="(plan, index) in plans"
                            :key="plan.name"
                            class="flex-1 min-w-[300px] max-w-[400px] opacity-0 cursor-pointer relative overflow-hidden"
                            :style="{
                                animation: `slideUp 0.5s ease-out ${
                                    index * 0.2
                                }s forwards`,
                            }"
                            :class="[
                                'bg-white dark:bg-gray-900 rounded-lg shadow-lg p-8',
                                'transform transition-all duration-300',
                                selectedPlan === plan.id
                                    ? 'scale-105 ring-2 ring-blue-500'
                                    : 'hover:scale-105',
                                plan.isPopular
                                    ? 'border-2 border-blue-500'
                                    : 'border border-gray-200',
                                selectedPlan === plan.id && isAnimating
                                    ? 'card-click'
                                    : '',
                            ]"
                            @click="handleCardClick(plan.id)"
                        >
                            <!-- Popular badge dengan animasi -->
                            <div
                                v-if="plan.isPopular"
                                class="bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full inline-block mb-4 transition-all duration-300"
                                :class="{
                                    'scale-110': selectedPlan === plan.id,
                                }"
                            >
                                Most Popular
                            </div>

                            <!-- Plan name dengan animasi -->
                            <h3
                                class="text-2xl font-bold mb-4 dark:text-white transition-all duration-300"
                                :class="{
                                    'text-blue-500 transform translate-y-[-2px]':
                                        selectedPlan === plan.id,
                                }"
                            >
                                {{ plan.name }}
                            </h3>

                            <!-- Price dengan animasi -->
                            <div
                                class="mb-6 transition-all duration-300"
                                :class="{
                                    'text-blue-500 transform scale-110':
                                        selectedPlan === plan.id,
                                }"
                            >
                                <span class="text-4xl font-bold dark:text-white"
                                    >${{ plan.price }}</span
                                >
                                <span class="text-gray-500 dark:text-gray-400"
                                    >/month</span
                                >
                            </div>

                            <!-- Features list dengan animasi -->
                            <ul class="mb-8 space-y-4">
                                <li
                                    v-for="(
                                        feature, featureIndex
                                    ) in plan.features"
                                    :key="featureIndex"
                                    class="flex items-center text-gray-600 dark:text-gray-300 transition-all duration-300"
                                    :class="{
                                        'transform translate-x-2':
                                            selectedPlan === plan.id,
                                        'feature-shake':
                                            selectedPlan === plan.id &&
                                            isAnimating,
                                    }"
                                    :style="{
                                        transitionDelay: `${
                                            featureIndex * 50
                                        }ms`,
                                    }"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 mr-2 transition-colors duration-300"
                                        :class="{
                                            'text-blue-500':
                                                selectedPlan === plan.id,
                                            'text-green-500':
                                                selectedPlan !== plan.id,
                                        }"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            d="M22 11.08V12a10 10 0 1 1-5.93-9.14"
                                        ></path>
                                        <polyline
                                            points="22 4 12 14.01 9 11.01"
                                        ></polyline>
                                    </svg>
                                    {{ feature }}
                                </li>
                            </ul>

                            <!-- Button dengan animasi lebih dinamis -->
                            <button
                                :class="[
                                    'w-full py-3 px-6 rounded-lg font-semibold transition-all duration-300 mt-auto relative overflow-hidden',
                                    selectedPlan === plan.id
                                        ? 'bg-blue-500 text-white transform scale-105 shadow-lg'
                                        : plan.isPopular
                                        ? 'bg-blue-500 text-white hover:bg-blue-600'
                                        : 'bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700',
                                ]"
                            >
                                <span
                                    class="relative z-10 transition-transform duration-300"
                                    :class="{
                                        'transform scale-110':
                                            selectedPlan === plan.id,
                                    }"
                                >
                                    {{
                                        selectedPlan === plan.id
                                            ? "Selected Plan"
                                            : "Get Started"
                                    }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <section
                class="py-20 bg-white dark:bg-gray-900 flex items-center"
                id="about"
            >
                <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                    <div class="md:flex md:justify-between">
                        <div class="mb-6 md:mb-0">
                            <a class="flex items-center">
                                <img
                                    src="/images/Finance.svg"
                                    class="h-8 me-3"
                                    alt="Logo"
                                />
                                <span
                                    class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
                                    >MONEYWISE</span
                                >
                            </a>
                        </div>
                        <div
                            class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3"
                            >
                            <!--<div>
                                <h2
                                    class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white"
                                >
                                    Resources
                                </h2>
                                <ul
                                    class="text-gray-500 dark:text-gray-400 font-medium"
                                >
                                    <li class="mb-4">
                                        <a
                                            href="https://flowbite.com/"
                                            class="hover:underline"
                                            >Flowbite</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            href="https://tailwindcss.com/"
                                            class="hover:underline"
                                            >Tailwind CSS</a
                                        >
                                    </li>
                                </ul>
                            </div> -->
                            <div> 
                                <h2
                                    class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white"
                                >
                                    Follow us
                                </h2>
                                <ul
                                    class="text-gray-500 dark:text-gray-400 font-medium"
                                >
                                    <li class="mb-4">
                                        <a
                                            href="https://github.com/Aghony"
                                            class="hover:underline"
                                            >Github</a
                                        >
                                    </li>
                                    <li class="mb-4">
                                        <a
                                            href="https://discord.gg/4eeurUVvTy"
                                            class="hover:underline"
                                            >Discord</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            href="https://discord.gg/4eeurUVvTy"
                                            class="hover:underline"
                                            >Linkedin</a
                                        >
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h2
                                    class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white"
                                >
                                    Legal
                                </h2>
                                <ul
                                    class="text-gray-500 dark:text-gray-400 font-medium"
                                >
                                    <li class="mb-4">
                                        <a href="#" class="hover:underline"
                                            >Privacy Policy</a
                                        >
                                    </li>
                                    <li>
                                        <a href="#" class="hover:underline"
                                            >Terms &amp; Conditions</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr
                        class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8"
                    />
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <span
                            class="text-sm text-gray-500 sm:text-center dark:text-gray-400"
                            >© 2024
                            <a
                                href="https://flowbite.com/"
                                class="hover:underline"
                                >AghonyCoders™</a
                            >. All Rights Reserved.
                        </span>
                        <div class="flex mt-4 sm:justify-center sm:mt-0">
                            <a
                                href="#"
                                class="text-gray-500 hover:text-gray-900 dark:hover:text-white"
                            >
                                <svg
                                    class="w-4 h-4"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 8 19"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="sr-only">Facebook page</span>
                            </a>
                            <a
                                href="#"
                                class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5"
                            >
                                <svg
                                    class="w-4 h-4"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 21 16"
                                >
                                    <path
                                        d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"
                                    />
                                </svg>
                                <span class="sr-only">Discord community</span>
                            </a>
                            <a
                                href="#"
                                class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5"
                            >
                                <svg
                                    class="w-4 h-4"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 20 17"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="sr-only">Twitter page</span>
                            </a>
                            <a
                                href="#"
                                class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5"
                            >
                                <svg
                                    class="w-4 h-4"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="sr-only">GitHub account</span>
                            </a>
                            <a
                                href="#"
                                class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5"
                            >
                                <svg
                                    class="w-4 h-4"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="sr-only">Dribbble account</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </footer>
    </div>
</template>
