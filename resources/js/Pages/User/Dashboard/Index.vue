<template>
    <Head>
        <title>
            {{ $page.props.setting.app_name ?? "Atur Setting Terlebih Dahulu" }}
            - Dashboard
        </title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div
                v-if="$page.props.setting.purchase_type != 1"
                class="row row-cols-1 row-cols-md-2 row-cols-xl-4"
                v-for="(totalDataInCategory, index) in totalDataInCategories"
                :key="index"
            >
                <div>
                    <Link
                        :href="`/user/exam-groups/${totalDataInCategory.id}/lesson-categories`"
                        class="menu-clicked"
                    >
                        <div class="col">
                            <div
                                class="card radius-10 border-start border-0 border-3 border-danger bg-danger bg-gradient"
                            >
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">
                                                Try Out
                                                {{ totalDataInCategory.name }}
                                            </p>
                                            <!-- <p class="mb-0 text-white">Try Out CPNS & PPPK</p> -->
                                            <h6 class="my-1 text-white">
                                                {{
                                                    totalDataInCategory.exam_group_count
                                                }}
                                                Try Out
                                            </h6>
                                        </div>
                                        <div
                                            class="text-danger ms-auto font-35"
                                        >
                                            <i
                                                class="bx bx-file"
                                                style="color: white"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>

                <!-- <div>
                    <Link
                        :href="`/user/categories/${totalDataInCategory.id}/lesson-categories`"
                        class="menu-clicked"
                    >
                        <div class="col">
                            <div
                                class="card radius-10 border-start border-0 border-3 border-primary bg-primary bg-gradient"
                            >
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">
                                                Latihan Soal
                                                {{ totalDataInCategory.name }}
                                            </p>
                                          <p class="mb-0 text-white">Latihan Soal CPNS & PPPK</p> 
                                            <h6 class="my-1 text-white">
                                                {{
                                                    totalDataInCategory.exam_count
                                                }}
                                                Soal
                                            </h6>
                                        </div>
                                        <div
                                            class="text-primary ms-auto font-35"
                                        >
                                            <i
                                                class="bx bx-file"
                                                style="color: white"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>

                <div>
                    <Link href="/user/modules" class="menu-clicked">
                        <div class="col">
                            <div
                                class="card radius-10 border-start border-0 border-3 border-warning bg-warning bg-gradient"
                            >
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">Modul {{ totalDataInCategory.name }}</p> 
                                            <p class="mb-0 text-white">
                                                Modul CPNS & PPPK
                                            </p>
                                            <h6 class="my-1 text-white">
                                                {{
                                                    totalDataInCategory.module_count
                                                }}
                                                Modul
                                            </h6>
                                        </div>
                                        <div
                                            class="text-warning ms-auto font-35"
                                        >
                                            <i
                                                class="bx bx-book"
                                                style="color: white"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>

                <div>
                    <Link href="/user/video-modules" class="menu-clicked">
                        <div class="col">
                            <div
                                class="card radius-10 border-start border-0 border-3 border-success bg-success bg-gradient"
                            >
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-white">
                                                Video Belajar
                                                {{ totalDataInCategory.name }}
                                            </p>
                                             <p class="mb-0 text-white">Video Belajar CPNS & PPPK</p> 
                                            <h6 class="my-1 text-white">{{ totalDataInCategory.video_module_count }}</h6>
                                            <h6 class="my-1 text-white">
                                                8 Video
                                            </h6>
                                        </div>
                                        <div
                                            class="text-success ms-auto font-35"
                                        >
                                            <i
                                                class="bx bx-video"
                                                style="color: white"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div> -->
            </div>

            <!-- <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4" v-if="transactions && $page.props.auth.user.member_type == 2">
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Transaksi Pending</p>
                                        <h4 class="my-1">{{ totalTransactionPending }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class="bx bxs-wallet"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Transaksi Dibayar</p>
                                        <h4 class="my-1">{{ totalTransactionPaid }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-success text-success ms-auto"><i class="bx bxs-wallet"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Transaksi Failed</p>
                                        <h4 class="my-1">{{ totalTransactionFailed }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class="bx bxs-wallet"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Transaksi Selesai</p>
                                        <h4 class="my-1">{{ totalTransactionDone }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-primary text-primary ms-auto"><i class="bx bxs-wallet"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div> -->

            <div
                class="card radius-10 border-start border-0 border-3 border-success"
            >
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-3">Pemberitahuan</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Perihal</th>
                                    <!-- <th>Lihat Pemberitahuan</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!announcementSummaries.length">
                                    <td colspan="7" align="center">
                                        Data Pemberitahuan kosong
                                    </td>
                                </tr>
                                <tr
                                    v-for="(
                                        announcementSummary, index
                                    ) in announcementSummaries"
                                    :key="index"
                                >
                                    <td>{{ ++index }}</td>
                                    <!-- <td>{{ announcementSummary.title }}</td> -->
                                    <td>
                                        <Link
                                            :href="`/user/announcements/${announcementSummary.id}`"
                                            class="ms-2"
                                            >{{
                                                announcementSummary.title
                                            }}</Link
                                        >
                                    </td>
                                    <!-- <td>
                                        <div class="d-flex order-actions">
                                            <Link :href="`/user/announcements/${announcementSummary.id}`" class="ms-2"><i class='bx bx-grid-alt'></i></Link>
                                        </div>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div
                class="card radius-10 border-start border-0 border-3 border-danger"
                v-if="transactions && $page.props.auth.user.member_type == 2"
            ></div>
            <!-- Section: Pricing table -->
            <div class="pricing-table mt-4">
                <div v-if="$page.props.session && $page.props.session.error" class="alert alert-danger border-0">
                    {{ $page.props.session.error }}
                </div>
                <div class="row row-cols-1 row-cols-lg-3">
                    <div class="col" v-for="(voucher, index) in vouchers" :key="index">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-header bg-secondary py-3" v-if="voucher.category && voucher.category.name == 'POLRI'">
                                <h5 class="text-white text-center"><s>Rp.{{ formatPrice(voucher.price_before_discount) }}</s> <span class="badge bg-danger">{{ formatPrice((voucher.price_before_discount - voucher.price_after_discount) / voucher.price_before_discount * 100)}}%</span></h5>
                                <h6 class="card-price text-white text-center">Rp.{{ formatPrice(voucher.price_after_discount) }}<span class="term">/{{voucher.active_period}} {{ voucher.period_type == 'day' ? 'Hari' : 'Bulan' }}</span></h6>
                            </div>
                            <div class="card-header bg-success py-3" v-else-if="voucher.category && voucher.category.name == 'TNI'">
                                <h5 class="text-white text-center"><s>Rp.{{ formatPrice(voucher.price_before_discount) }}</s> <span class="badge bg-danger">{{ formatPrice((voucher.price_before_discount - voucher.price_after_discount) / voucher.price_before_discount * 100)}}%</span></h5>
                                <h6 class="card-price text-white text-center">Rp.{{ formatPrice(voucher.price_after_discount) }}<span class="term">/{{voucher.active_period}} {{ voucher.period_type == 'day' ? 'Hari' : 'Bulan' }}</span></h6>
                            </div>
                            <div class="card-header bg-primary py-3" v-else-if="voucher.category && voucher.category.name == 'Kedinasan'">
                                <h5 class="text-white text-center"><s>Rp.{{ formatPrice(voucher.price_before_discount) }}</s> <span class="badge bg-warning text-dark">{{ formatPrice((voucher.price_before_discount - voucher.price_after_discount) / voucher.price_before_discount * 100)}}%</span></h5>
                                <h6 class="card-price text-white text-center">Rp.{{ formatPrice(voucher.price_after_discount) }}<span class="term">/{{voucher.active_period}} {{ voucher.period_type == 'day' ? 'Hari' : 'Bulan' }}</span></h6>
                            </div>
                            <div class="card-header bg-danger py-3" v-else-if="voucher.category && voucher.category.name == 'CPNS'">
                                <h5 class="text-white text-center"><s>Rp.{{ formatPrice(voucher.price_before_discount) }}</s> <span class="badge bg-warning text-dark">{{ formatPrice((voucher.price_before_discount - voucher.price_after_discount) / voucher.price_before_discount * 100)}}%</span></h5>
                                <h6 class="card-price text-white text-center">Rp.{{ formatPrice(voucher.price_after_discount) }}<span class="term">/{{voucher.active_period}} {{ voucher.period_type == 'day' ? 'Hari' : 'Bulan' }}</span></h6>
                            </div>
                            <div class="card-header bg-danger py-3" v-else>
                                <h5 class="text-white text-center"><s>Rp.{{ formatPrice(voucher.price_before_discount) }}</s> <span class="badge bg-warning text-dark">{{ formatPrice((voucher.price_before_discount - voucher.price_after_discount) / voucher.price_before_discount * 100)}}%</span></h5>
                                <h6 class="card-price text-white text-center">Rp.{{ formatPrice(voucher.price_after_discount) }}<span class="term">/{{voucher.active_period}} {{ voucher.period_type == 'day' ? 'Hari' : 'Bulan' }}</span></h6>
                            </div>
                            <div class="card-body">
                                <h6 class="text-center">{{ voucher.name }}</h6>
                                <hr>
                                <div class="text-center" style="min-height: 30px;">
                                    <div v-if="voucher.member_categories">
                                        <h6>
                                            <div v-for="(member, index) in voucher.member_categories" :key="index" style="display: inline;">
                                                <span class="badge bg-success m-1">{{ member }}</span>
                                            </div>
                                        </h6>
                                    </div>
                                    <div v-else>
                                        <h6><span class="badge bg-success m-1">Akses Untuk Seluruh Tipe Member</span></h6>
                                    </div>
                                </div>
                                <hr>
                                <div v-html="voucher.description" style="min-height:175px;"></div>
                                <hr>
                                <div v-if="voucher.user_limit && voucher.user_limit > voucher.voucher_selected_transacation_count">
                                    <h6 class="text-center">Tersisa {{ voucher.user_limit - voucher.voucher_selected_transacation_count }} kuota dari {{ voucher.user_limit }}</h6>
                                    <hr>
                                </div>
                                <div class="d-grid">
                                    <Link :href="`/user/vouchers/${voucher.id}/buy`" class="btn btn-outline-primary px-5 radius-30">Pilih Paket</Link>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
//import layout admin
import LayoutUser from "../../../Layouts/Layout.vue";

// import Link
import { Link } from "@inertiajs/inertia-vue3";

// import Head from Inertia
import { Head } from "@inertiajs/inertia-vue3";

export default {
    // layout
    layout: LayoutUser,
    // register components
    components: {
        Head,
        Link,
    },
    // props
    props: {
        totalTransactionPending: Object,
        totalTransactionPaid: Object,
        totalTransactionDone: Object,
        totalTransactionFailed: Object,
        transactions: Object,
        gradeSummaries: Object,
        announcementSummaries: Object,
        totalDataInCategories: Object,
        vouchers: Array,
    },
    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed().replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
    },
};
</script>
