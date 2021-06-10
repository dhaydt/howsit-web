<template>
    <div class="notify">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        notif
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <div class="list-group-item" v-for="item in notification">
                                {{ item }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                notification: [],
            }
        },

        mounted() {
            var x = this;

            Echo.private('global-notif')
            .listen('SendGlobalNotification', (e) => {
                console.log(e.message.replace('{name}', e.name))
            });
        }
    }
</script>

<style lang="scss" scoped>

</style>
