<template>
    <div class="composer">
        <textarea v-model="message" @keydown.enter="send" placeholder="Message..." class="text-type inner-shadow"></textarea>

        <div class="paper" @click="send"><i class="fas fa-paper-plane"></i></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: '',
            };
        },

        methods: {
            send(e) {
                e.preventDefault();

                if (this.message == '') {
                    return;
                }

                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>

<style lang="scss" scoped>

.composer {
    display: flex;
    background: #ebecf0;
}
.composer textarea {
    width: 100%;
    margin: 10px;
    resize: none;
    border: 1px solid lightgray;
    padding: 6px;
}

.text-type {
    border-radius: 10px 0 10px 10px;
}

.composer .paper {

    height: 50px;
    width: 50px;
    /* border: solid 1px #000; */
    margin: 25px 10px 0px 2px;
    font-size: 30px;
    border-radius: 10px;
    text-align: center;
    color: #595e59;
    cursor: pointer;
    transition: all 0.7s ease-in;
}
</style>
