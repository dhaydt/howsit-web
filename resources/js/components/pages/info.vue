<template>
    <v-app class="info">
        <v-row>
            <v-container>
                <v-row>
                    <v-card>
                        <v-row>
                            <v-col class="col-md-8">
                                <v-img
                                    height="350px"
                                    width="100%"
                                    class="rounded wall-img"
                                    style="overflow: visible;"
                                    src="https://cdn.pixabay.com/photo/2020/07/12/07/47/bee-5396362_1280.jpg"
                                >
                                    <v-row>
                                        <v-col align-self="end">
                                            <v-card-title
                                                class="white--text mt-8"
                                                style="justify-content: center;"
                                            >
                                                <v-avatar
                                                    size="180"
                                                    style="border: 5px solid"
                                                >
                                                    <img
                                                        alt="user"
                                                        :src="
                                                            'images/profile/' +
                                                                users.profile_image"
                                                    />
                                                </v-avatar>
                                            </v-card-title>
                                        </v-col>
                                    </v-row>
                                </v-img>
                                <v-card-title
                                    style="width: fit-content; margin: 16px 0 12px 0; font-size: 32px; font-weight: 700; text-transform: capitalize;"
                                    class="mx-auto"
                                >
                                    {{ users.name }}
                                </v-card-title>
                                <v-divider class="mb-5"></v-divider>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-row>
            </v-container>
        </v-row>
        <Profile
            :users="users"
            :saldo="saldo"
            style="margin-top: 20px;"
        ></Profile>
    </v-app>
</template>

<script>
import axios from "axios";
import Profile from "../profile/profile";
export default {
    props: {
        users: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            saldos: [],
            saldo: ""
        };
    },

    mounted() {
        axios.get("/info/saldo").then(response => {
            this.saldo = response.data[0];
            // console.log('1', this.saldo.saldo)
        });
        // console.log('2', this.users)
    },

    components: {
        Profile
    }
};
</script>

<style lang="scss" scoped>
.info {
    font-family: "Nunito", sans-serif !important;
    font-size: 15px;
    .row {
        .container {
            margin: 50px 0 0 0;
            width: 100%;
            max-width: 100%;

            .row {
                justify-content: space-around;

                .v-card {
                    width: 100%;
                    background: linear-gradient(
                        180deg,
                        rgba(154, 154, 154, 1) 13%,
                        rgba(255, 255, 255, 1) 51%
                    );

                    .row {
                        justify-content: center;

                        .col {
                            .v-image {
                                .row {
                                    margin-top: 40px;
                                    height: 100%;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>
