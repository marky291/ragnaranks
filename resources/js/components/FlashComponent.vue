<template>
    <transition name="fade" mode="out-in">
        <div class="alert alert-success alert-flash" role="alert" v-if="visibility">
            <strong>Success!</strong> {{ body }}
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['message'],

        data: function () {
            return {
                body: "",
                type: "",
                visibility: false
            }
        },
        created: function() {
            if (this.message) {
                this.flash(this.message);
            }

            Event.$on('flash', message => this.flash(message));
        },

        methods: {
            flash(message) {
                this.body = message;
                this.visibility = true;
                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.visibility = false;
                    clearTimeout();
                }, 3000);
            }
        }
    }
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
        z-index: 99;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>