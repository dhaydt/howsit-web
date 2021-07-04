<template>
    <div>
        <v-row justify="center" style="background-color: #f0f2f5;">
            <v-col class="col-md-12">
                <v-container class="mt-0">
                    <v-card>
                        <v-tabs background-color="primary" grow dark>
                            <!-- tab header -->
                            <v-tab>
                                Balance
                            </v-tab>
                            <v-tab>
                                Profile
                            </v-tab>

                            <!-- tab item -->
                            <v-tab-item class="balance">
                                <v-card flat>
                                    <v-tabs vertical>
                                        <v-tab class="tab-ver-header m-2" left>
                                            <v-icon left
                                                >fas fa-balance-scale</v-icon
                                            >
                                            Howsit Balance
                                        </v-tab>
                                        <v-tab class="tab-ver-header m-2">
                                            <v-icon left
                                                >fas fa-hand-holding-usd</v-icon
                                            >
                                            Loans
                                        </v-tab>
                                        <v-tab class="tab-ver-header m-2">
                                            <v-icon left>fas fa-donate</v-icon>
                                            Shares in Howsit
                                        </v-tab>
                                        <v-tab class="tab-ver-header m-2">
                                            <v-icon left>fas fa-wallet</v-icon>
                                            Add Wallet
                                        </v-tab>

                                        <v-tab-item class="howsitBalance">
                                            <!-- howsit balance -->
                                            <v-card flat>
                                                <v-tabs
                                                    background-color="white"
                                                    color="deep-purple accent-4"
                                                    right
                                                >
                                                    <v-tab class="tab-ver-sub"
                                                        >Balance</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >Transfer to Bank</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >Make a Payment</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >Land money to
                                                        borrowers</v-tab
                                                    >

                                                    <v-tab-item class="balance">
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <v-card>
                                                                        <v-card-subtitle>
                                                                            Balance
                                                                        </v-card-subtitle>
                                                                        <v-card-title
                                                                            class="justify-content-center d-flex fw-bold"
                                                                        >
                                                                            <span>
                                                                                USD
                                                                                {{
                                                                                    saldo
                                                                                        ? saldo.saldo
                                                                                        : "0"
                                                                                }}
                                                                            </span>
                                                                        </v-card-title>
                                                                    </v-card>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>
                                                    <v-tab-item
                                                        class="transfer"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        transfer
                                                                        bank
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>

                                                    <v-tab-item class="payment">
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        make a
                                                                        payment
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>

                                                    <v-tab-item
                                                        class="landMoney"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        land
                                                                        money to
                                                                        borower
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>
                                                </v-tabs>
                                            </v-card>
                                        </v-tab-item>

                                        <v-tab-item class="loans">
                                            <v-card flat>
                                                <v-tabs
                                                    background-color="white"
                                                    color="deep-purple accent-4"
                                                    right
                                                >
                                                    <v-tab class="tab-ver-sub"
                                                        >Total Loans</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >List of
                                                        borrowers</v-tab
                                                    >
                                                    <!-- tab loans item -->
                                                    <v-tab-item
                                                        class="totalLoans"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        total
                                                                        loans
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>
                                                    <v-tab-item
                                                        class="listBorrowers"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        list
                                                                        borower
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>
                                                </v-tabs>
                                            </v-card>
                                        </v-tab-item>

                                        <v-tab-item class="shares">
                                            <v-card flat>
                                                <v-tabs
                                                    background-color="white"
                                                    color="deep-purple accent-4"
                                                    right
                                                >
                                                    <v-tab class="tab-ver-sub"
                                                        >My Shares</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >Total Shares</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >Security Shares</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >Loan Shares</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >% of Howsit</v-tab
                                                    >

                                                    <v-tab-item
                                                        class="myShares"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        my
                                                                        shares
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>

                                                    <v-tab-item
                                                        class="totalShares"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        total
                                                                        shares
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>

                                                    <v-tab-item
                                                        class="securShares"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        secure
                                                                        shares
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>

                                                    <v-tab-item
                                                        class="loanShares"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        Loan
                                                                        shares
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>

                                                    <v-tab-item
                                                        class="persenHowsit"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        % of
                                                                        howsit
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>
                                                </v-tabs>
                                            </v-card>
                                        </v-tab-item>

                                        <v-tab-item class="addWallet">
                                            <v-card flat>
                                                <v-tabs
                                                    background-color="white"
                                                    color="deep-purple accent-4"
                                                    right
                                                >
                                                    <v-tab class="tab-ver-sub"
                                                        >Balance</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >Transfer to Bank</v-tab
                                                    >
                                                    <v-tab class="tab-ver-sub"
                                                        >Transfer to Howsit
                                                        Account</v-tab
                                                    >
                                                    <!-- subtab addwallet -->
                                                    <v-tab-item
                                                        class="walletBalance"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <v-card>
                                                                        <v-expansion-panels
                                                                            accordion
                                                                        >
                                                                            <v-expansion-panel>
                                                                                <v-expansion-panel-header
                                                                                    >Balance</v-expansion-panel-header
                                                                                >
                                                                                <v-expansion-panel-content class="text-center">
                                                                                    <label for="" >USD 50</label>
                                                                                </v-expansion-panel-content>
                                                                            </v-expansion-panel>
                                                                            <v-expansion-panel>
                                                                                <v-expansion-panel-header
                                                                                    >Advertising</v-expansion-panel-header
                                                                                >
                                                                                <v-expansion-panel-content class="text-center">
                                                                                    Opt into Advertising in the Howsit App and earn rewards and free data
                                                                                </v-expansion-panel-content>
                                                                            </v-expansion-panel>
                                                                            <v-expansion-panel>
                                                                                <v-expansion-panel-header
                                                                                    >Rewards</v-expansion-panel-header
                                                                                >
                                                                                <v-expansion-panel-content class="text-center">
                                                                                    Free data from advertiser is our way of giving back to users, so everyone can enjoy Howsit worldwide
                                                                                </v-expansion-panel-content>
                                                                            </v-expansion-panel>
                                                                        </v-expansion-panels>
                                                                    </v-card>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>

                                                    <v-tab-item
                                                        class="walletTransferBank"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        Transfer
                                                                        to Bank
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>

                                                    <v-tab-item
                                                        class="walletTransferAccount"
                                                    >
                                                        <v-container fluid>
                                                            <v-row>
                                                                <v-col
                                                                    cols="12"
                                                                    md="12"
                                                                >
                                                                    <p
                                                                        class="text-center"
                                                                    >
                                                                        Transfer
                                                                        to
                                                                        howsit
                                                                        Account
                                                                    </p>
                                                                </v-col>
                                                            </v-row>
                                                        </v-container>
                                                    </v-tab-item>
                                                </v-tabs>
                                            </v-card>
                                        </v-tab-item>
                                    </v-tabs>
                                </v-card>
                            </v-tab-item>
                            <v-tab-item class="profile">
                                <v-row>
                                    <v-col>
                                        <v-card>
                                            <v-container>
                                                <v-list>
                                                    <v-list-item-group
                                                        color="primary"
                                                    >
                                                        <v-list-item>
                                                            <v-list-item-icon>
                                                                <v-icon
                                                                    >mdi-account</v-icon
                                                                >
                                                            </v-list-item-icon>
                                                            <v-list-item-content>
                                                                <v-list-item-title
                                                                    style="text-transform: capitalize; font-family:inherit;"
                                                                    >{{
                                                                        users.name
                                                                    }}</v-list-item-title
                                                                >
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-icon>
                                                                <v-icon
                                                                    >mdi-phone</v-icon
                                                                >
                                                            </v-list-item-icon>
                                                            <v-list-item-content>
                                                                <v-list-item-title
                                                                    class="d-flex flex-row justify-content-between"
                                                                >
                                                                    <p
                                                                        v-if="
                                                                            users.phone
                                                                        "
                                                                        class="mb-0"
                                                                    >
                                                                        {{
                                                                            users.phone
                                                                        }}
                                                                    </p>
                                                                    <a
                                                                        v-else
                                                                        href="/profile"
                                                                        >Add
                                                                        number</a
                                                                    >
                                                                    <v-list-item-subtitle
                                                                        class="text-right"
                                                                        v-if="
                                                                            users.isVerified
                                                                        "
                                                                    >
                                                                        <v-badge
                                                                            color="primary"
                                                                            icon="mdi-check-bold"
                                                                            inline
                                                                        ></v-badge>
                                                                    </v-list-item-subtitle>
                                                                    <a
                                                                        href="profile/phone"
                                                                        class="text-right ms-auto"
                                                                        v-else
                                                                        >Verify
                                                                        your
                                                                        Phone
                                                                    </a>
                                                                </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-icon>
                                                                <v-icon
                                                                    >mdi-email</v-icon
                                                                >
                                                            </v-list-item-icon>
                                                            <v-list-item-content>
                                                                <v-list-item-title
                                                                    class="d-flex flex-row justify-content-between"
                                                                    >{{
                                                                        users.email
                                                                    }}
                                                                    <v-list-item-subtitle
                                                                        class="text-right"
                                                                        v-if="
                                                                            users.email_verified_at
                                                                        "
                                                                    >
                                                                        <v-badge
                                                                            color="primary"
                                                                            icon="mdi-check-bold"
                                                                            inline
                                                                        ></v-badge>
                                                                    </v-list-item-subtitle>
                                                                    <a
                                                                        href="email/verify"
                                                                        class="text-right"
                                                                        v-else
                                                                        >Verify
                                                                    </a></v-list-item-title
                                                                >
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item
                                                            class="justify-content-end"
                                                        >
                                                            <a href="/profile">
                                                                <v-btn>
                                                                    <v-icon
                                                                        color="primary"
                                                                        >mdi-notebook-edit</v-icon
                                                                    >
                                                                    <span
                                                                        >Edit
                                                                        profile</span
                                                                    >
                                                                </v-btn>
                                                            </a>
                                                        </v-list-item>
                                                    </v-list-item-group>
                                                </v-list>
                                            </v-container>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </v-tab-item>
                        </v-tabs>
                    </v-card>
                </v-container>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import moment from "moment";
import Vue from "vue";

export default {
    props: {
        users: {
            name: Object,
            required: true
        },

        saldo: ""
    },
    data() {
        return {
            addPhone: `<a href="/profile">Add phone number</a>`,
            item: {
                divider: true,
                inset: true
            }
        };
    },

    mounted() {
        // console.log()
        Vue.filter("formatDate", function(value) {
            if (value) {
                return moment(String(value)).format("DD/MM/YYYY | hh:mm");
            }
        });
    }
};
</script>

<style lang="scss" scoped>
.tab-ver-header {
    text-transform: capitalize;
    justify-content: left;
    letter-spacing: 0;
    font-weight: 700;
    .v-icon {
        font-size: 18px;
    }
}

.tab-ver-sub {
    text-transform: capitalize;
    letter-spacing: 0;
    font-weight: 600;
}
</style>
