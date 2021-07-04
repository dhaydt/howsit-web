<template>
    <div class="notify">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a
                class="nav-link drop"
                id="dropdown05"
                data-bs-toggle="dropdown"
                href="#"
            >
                <i class="fas fa-concierge-bell"></i>
                <!-- <span class="d-sm-none">Notification</span> -->
                <span
                    class="badge badge-warning navbar-badge mb-4"
                    style="z-index: 2; background-color: red; margin-left: -9px"
                    >{{ unreads.length }}</span
                >
            </a>
            <div
                class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end dropdown-menu-sm-end"
                aria-expanded="false"
                aria-labelledby="dropdown05"
            >
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>

                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"
                    >See All Notifications</a
                >
            </div>
        </li>
    </div>
</template>

<script>
export default {
    props: ["unreads", "userid"]

    // mounted() {
    //     console.log('id', this.userid);
    //     Echo.private("App.Models.User." + this.userid).notification(notification => {
    //         console.log('notif', notification);
    //     });
    // }
};
</script>

<style lang="scss" scoped></style>
