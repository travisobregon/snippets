<template>
    <div class="favourite">
        <input type="hidden" name="snippet_id" :value="snippetId">

        <button @click="favourite" class="glyphicon glyphicon-heart" :class="{ favourited }" name="vote_btn"></button>
        
        <span class="vote-counter">{{ count }}</span>
    </div>
</template>

<script>
    import axios from 'axios';
    import { EventBus } from '../event-bus.js';    

    export default {
        props: ['snippetId', 'initialCount', 'initialFavourited'],

        data() {
            return {
                count: this.initialCount,
                favourited: this.initialFavourited
            }
        },

        methods: {
            favourite() {
                axios.post(`/votes/${this.snippetId}`)
                    .then(({data}) => {
                        this.count = data.count;
                        this.favourited = data.favourited;

                        EventBus.$emit('update-top-users');
                    });
            }
        }
    }
</script>

<style>
    .favourite {
        display: inline-block;
    }

    button.glyphicon.glyphicon-heart {
        background: none;
        border: none;
        outline: none;
    }

    button.glyphicon.glyphicon-heart:hover {
        color: crimson;
        cursor: pointer;
    }

    button.glyphicon.glyphicon-heart.favourited {
        color: crimson;
    }

    .vote-counter {
        margin-right: 1rem;
    }
</style>
