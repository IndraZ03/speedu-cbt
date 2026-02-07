<template>
    <div class="wrapper">
        <!-- MathJax Script -->
        <div v-if="false"><!-- SSR placeholder --></div>
        <slot name="mathjax-script">
            <script
                type="text/javascript"
                id="mathjax-script"
                src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.9/MathJax.js?config=TeX-AMS_HTML"
            ></script>
        </slot>
        <!-- content -->
        <slot />

        <Footer />
    </div>
</template>

<script>
// import header
import Header from "../Components/LayoutUser/Header.vue";
// import footer
import Footer from "../Components/LayoutUser/Footer.vue";

export default {
    // register components
    components: {
        Header,
        // Footer
    },
};
</script>
