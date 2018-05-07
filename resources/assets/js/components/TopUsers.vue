<template v-if="topUsers.length">
    <div>
        <!-- <h4>Top Users</h4> -->

        <ul class="list-group">
            <li v-for="user in topUsers" :key="user.username" class="list-group-item">
                <a :href="'/@' + user.username">{{ user.name }}</a>
                <span class="badge">{{ user.votes }}</span>
            </li>
        </ul>

        <a class="btn btn-primary btn-block" href="/snippets/create"><span class="glyphicon glyphicon-pencil"></span>Create Snippet</a>
    </div>
</template>

<script>
    import axios from 'axios';
    import { EventBus } from '../event-bus.js';

    export default {
        props: ['initialTopUsers'],

        data() {
            return {
                topUsers: this.initialTopUsers
            }
        },

        created() {
            EventBus.$on('update-top-users', () => {
                axios.get('/top-users')
                    .then(({data}) => {
                        this.topUsers = data.topUsers;
                    });
            });
        }
    }
</script>
